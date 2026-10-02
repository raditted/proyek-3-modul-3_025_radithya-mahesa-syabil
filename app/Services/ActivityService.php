<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    private const TRANSITIONS = [
        'Planned' => ['Planned', 'Ongoing'],
        'Ongoing' => ['Ongoing', 'Done'],
        'Done' => ['Done'],
        'draft' => ['draft', 'published'],
        'published' => ['published', 'completed'],
        'completed' => ['completed'],
    ];

    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        $nextStatus = $data['status'] ?? $activity->status;
        $this->ensureValidTransition($activity->status, $nextStatus);
        $activity->update($data);

        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan draft yang dapat dipublikasikan.',
            ]);
        }

        if (! $activity->category_id || ! $activity->code || ! $activity->title || ! $activity->start_at || ! $activity->end_at) {
            throw ValidationException::withMessages([
                'status' => 'Kegiatan tidak dapat dipublikasikan karena data belum lengkap.',
            ]);
        }

        $activity->update(['status' => 'published']);

        return $activity;
    }

    public function registerParticipant(Activity $activity, array $data): Registration
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'activity' => 'Pendaftaran hanya terbuka untuk kegiatan berstatus published.',
            ]);
        }

        if ($activity->start_at && $activity->start_at->isPast()) {
            throw ValidationException::withMessages([
                'activity' => 'Pendaftaran ditolak karena kegiatan sudah dimulai atau lewat.',
            ]);
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw ValidationException::withMessages([
                'capacity' => 'Pendaftaran ditolak karena kapasitas peserta sudah penuh.',
            ]);
        }

        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create($data);
            $activity->increment('registered_count');

            return $registration;
        });
    }

    private function ensureValidTransition(string $current, string $next): void
    {
        $allowed = self::TRANSITIONS[$current] ?? [];

        if (! in_array($next, $allowed, true)) {
            throw new DomainException("Transisi status {$current} ke {$next} tidak diizinkan.");
        }
    }
}
