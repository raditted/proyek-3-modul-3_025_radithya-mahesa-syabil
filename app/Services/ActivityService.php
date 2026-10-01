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
