<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Course;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CourseCalendarWidget extends FullCalendarWidget
{
    public string|null|Model $model = Course::class;
    protected static bool $isDiscovered = false;


    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridWeek,timeGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
            'slotMinTime' => '07:00:00',
            'slotMaxTime' => '22:00:00',

            'selectable' => false,
            'editable' => false,
        ];
    }

    public function fetchEvents(array $info): array
    {
        $from = Carbon::parse($info['start']);
        $to = Carbon::parse($info['end']);

        $courses = Course::query()
            ->with('animators')
            ->occurringBetween($from, $to)
            ->get();

        $events = [];

        foreach ($courses as $course) {

            if ($course->parent_course_id) {
                $events[] = EventData::make()
                    ->id($course->id)
                    ->title($course->title)
                    ->start($course->start)
                    ->end($course->end)
                    ->backgroundColor($course->color)
                    ->url(route('filament.admin.resources.courses.edit', ['record' => $course]))
                    ->toArray();

                continue;
            }

            if ($course->is_recurring && $course->recurrence_end) {
                $events[] = EventData::make()
                    ->id($course->id)
                    ->title($course->title)
                    ->start($course->start)
                    ->end($course->end)
                    ->backgroundColor($course->color)
                    ->url(route('filament.admin.resources.courses.edit', ['record' => $course]))
                    ->toArray();
            }
            else {
                $occurrences = $course->getOccurrencesBetween($from, $to);
                foreach ($occurrences as $occurrence) {
                    $events[] = EventData::make()
                        ->id($course->id)
                        ->title($course->title)
                        ->start($occurrence['start'])
                        ->end($occurrence['end'])
                        ->backgroundColor($course->color)
                        ->url(route('filament.admin.resources.courses.edit', ['record' => $course]))
                        ->toArray();
                }
            }
        }

        return $events;
    }

    public function getFormSchema(): array
    {
        return [];
    }

    protected function headerActions(): array
    {
        return [];
    }

    protected function modalActions(): array
    {
        return [];
    }

    protected function viewAction(): Action
    {
        return ViewAction::make()->disabled();
    }
}
