<?php

namespace Tests\Unit;

use App\Models\Course;
use Carbon\Carbon;
use Tests\TestCase;

class CourseOccurrencesTest extends TestCase
{
    public function test_weekly_occurrences_are_expanded_for_selected_days(): void
    {
        $course = new Course([
            'start' => Carbon::parse('2026-06-01 10:00:00'),
            'end' => Carbon::parse('2026-06-01 11:00:00'),
            'is_recurring' => true,
            'recurrence_type' => 'weekly',
            'recurrence_days' => ['monday', 'wednesday'],
            'recurrence_end' => Carbon::parse('2026-06-07'),
        ]);

        $occurrences = $course->getOccurrencesBetween(
            Carbon::parse('2026-06-01 00:00:00'),
            Carbon::parse('2026-06-07 23:59:59'),
        );

        $this->assertCount(2, $occurrences);
        $this->assertSame('2026-06-01 10:00:00', $occurrences[0]['start']->format('Y-m-d H:i:s'));
        $this->assertSame('2026-06-03 10:00:00', $occurrences[1]['start']->format('Y-m-d H:i:s'));
    }

    public function test_non_recurring_course_returns_single_occurrence(): void
    {
        $course = new Course([
            'start' => Carbon::parse('2026-06-02 18:30:00'),
            'end' => Carbon::parse('2026-06-02 19:30:00'),
            'is_recurring' => false,
        ]);

        $occurrences = $course->getOccurrencesBetween(
            Carbon::parse('2026-06-01 00:00:00'),
            Carbon::parse('2026-06-30 23:59:59'),
        );

        $this->assertCount(1, $occurrences);
        $this->assertSame('2026-06-02 18:30:00', $occurrences[0]['start']->format('Y-m-d H:i:s'));
        $this->assertSame('2026-06-02 19:30:00', $occurrences[0]['end']->format('Y-m-d H:i:s'));
    }
}
