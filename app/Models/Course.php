<?php

namespace App\Models;

use App\Services\Geocoder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start',
        'end',
        'color',
        'latitude',
        'longitude',
        'parent_course_id',
        'is_recurring',
        'recurrence_type',
        'recurrence_days',
        'recurrence_end',
        'recurrence_excluded_at',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'is_recurring' => 'boolean',
        'recurrence_days' => 'array',
        'recurrence_end' => 'date',
        'recurrence_excluded_at' => 'datetime',
    ];

    public function animators(): BelongsToMany
    {
        return $this->belongsToMany(Animator::class, 'animator_course', 'course_id', 'animator_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Course::class, 'parent_course_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'parent_course_id');
    }

    public function isRecurring(): bool
    {
        return $this->is_recurring;
    }

    public function recurrenceDays(): Collection
    {
        return collect($this->recurrence_days ?? []);
    }

    public function getOccurrencesBetween(Carbon $from, Carbon $to): Collection
    {
        if (! $this->isRecurring()) {
            return collect([
                ['start' => $this->start, 'end' => $this->end],
            ]);
        }

        $occurrences = collect();
        $current = $this->start->copy();

        $recurrenceEnd = $this->recurrence_end
            ? Carbon::parse($this->recurrence_end)->endOfDay()
            : $to->copy()->endOfDay();

        $to = $to->copy()->endOfDay();

        while ($current->lte($to) && $current->lte($recurrenceEnd)) {
            if ($current->lt($this->start)) {
                $current->addDay();
                continue;
            }

            $dayOfWeek = strtolower($current->englishDayOfWeek);

            $match = false;

            switch ($this->recurrence_type) {
                case 'daily':
                    $match = true;
                    break;
                case 'weekly':
                    $match = $this->recurrenceDays()->contains($dayOfWeek);
                    break;
                case 'all_week':
                    $match = in_array($dayOfWeek, ['monday','tuesday','wednesday','thursday','friday']);
                    break;
            }

            if ($match) {
                $occurrences->push([
                    'start' => $current->copy(),
                    'end' => $current->copy()->addMinutes($this->start->diffInMinutes($this->end)),
                ]);
            }

            $current->addDay();
        }

        return $occurrences;
    }

    public function scopeOccurringBetween($query, Carbon $from, Carbon $to)
    {
        $query->where(function ($q) use ($from, $to) {
            $q->where('is_recurring', false)
                ->where('start', '<=', $to)
                ->where('end', '>=', $from);
        })->orWhere(function ($q) use ($from, $to) {
            $q->where('is_recurring', true)
                ->where('start', '<=', $to)
                ->where(function ($q2) use ($from) {
                    $q2->whereNull('recurrence_end')
                        ->orWhere('recurrence_end', '>=', $from);
                });
        });
    }

    protected static function booted(): void
    {
        static::saved(function (Course $course) {
            if ($course->isDirty('location') || ($course->location && (!$course->latitude || !$course->longitude))) {
                dispatch(function () use ($course) {
                    $geocoder = app(Geocoder::class);
                    $coords = $geocoder->geocode($course->location);

                    if ($coords) {
                        $course->updateQuietly([
                            'latitude' => $coords['lat'],
                            'longitude' => $coords['lon'],
                        ]);
                    }
                });
            }
        });
    }
}
