<?php

namespace App\Filament\Admin\Resources\CourseResource\Pages;

use App\Filament\Admin\Resources\CourseResource;
use App\Models\Course;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    protected function afterCreate(): void
    {
        /** @var Course $record */
        $record = $this->record;

        if ($record->is_recurring && $record->recurrence_end) {
            $this->createRecurringOccurrences($record);
        }
    }

    protected function createRecurringOccurrences(Course $master): void
    {
        $from = $master->start->copy();
        $to = Carbon::parse($master->recurrence_end)->endOfDay();

        $occurrences = $master->getOccurrencesBetween($from, $to);

        $animatorIds = $master->animators->pluck('id');

        $occurrences->skip(1)->each(function (array $occurrence) use ($master, $animatorIds) {

            $child = Course::create([
                'title' => $master->title,
                'description' => $master->description,
                'location' => $master->location,
                'color' => $master->color,
                'latitude' => $master->latitude,
                'longitude' => $master->longitude,
                'start' => $occurrence['start'],
                'end' => $occurrence['end'],
                'is_recurring' => false,
                'recurrence_type' => $master->recurrence_type,
                'recurrence_days' => $master->recurrence_days,
                'recurrence_end' => $master->recurrence_end,
                'parent_course_id' => $master->id,
            ]);

            if ($animatorIds->isNotEmpty()) {
                $child->animators()->attach($animatorIds);
            }
        });
    }
}
