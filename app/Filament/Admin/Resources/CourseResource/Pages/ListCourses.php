<?php

namespace App\Filament\Admin\Resources\CourseResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\CourseResource;
use App\Filament\Admin\Widgets\CourseCalendarWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CourseCalendarWidget::class,
        ];
    }
}
