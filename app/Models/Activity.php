<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'category',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'capacity' => 'integer',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}