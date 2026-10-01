<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    public function create(array $data): Activity
    {
        return Activity::create($data);
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
}