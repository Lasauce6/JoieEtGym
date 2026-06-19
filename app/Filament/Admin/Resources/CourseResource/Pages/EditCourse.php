<?php

namespace App\Filament\Admin\Resources\CourseResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use App\Filament\Admin\Resources\CourseResource;
use App\Models\Course;
use Exception;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    public string $updateScope = 'this';

    protected function beforeSave(): void
    {
        $data = $this->form->getState();

        $this->updateScope = $data['update_scope'] ?? 'this';
    }

    protected function afterSave(): void
    {
        if ($this->updateScope !== 'future') {
            return;
        }

        $this->record->refresh();

        $updateData = [
            'title' => $this->record->title,
            'description' => $this->record->description,
            'location' => $this->record->location,
            'latitude' => $this->record->latitude,
            'longitude' => $this->record->longitude,
            'color' => $this->record->color,
        ];

        $animatorIds = $this->record->animators->pluck('id');

        $futureCoursesQuery = null;
        $record = $this->record;

        if ($record->parent_course_id) {
            $futureCoursesQuery = Course::query()
                ->where('parent_course_id', $record->parent_course_id)
                ->where('start', '>', $record->start);
        } elseif ($record->is_recurring) {
            $futureCoursesQuery = Course::query()
                ->where('parent_course_id', $record->id)
                ->where('start', '>', $record->start);
        }

        if ($futureCoursesQuery) {
            $futureCoursesQuery->chunk(50, function ($courses) use ($updateData, $animatorIds) {
                foreach ($courses as $course) {
                    $course->update($updateData);

                    $course->animators()->sync($animatorIds);
                }
            });

            Notification::make()
                ->title('Série mise à jour')
                ->body('Les modifications ont été appliquées aux cours suivants.')
                ->success()
                ->send();
        }
    }


    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Supprimer')
                ->modalHeading('Options de suppression')
                ->modalDescription('Ce cours fait partie d\'une série. Que souhaitez-vous faire ?')
                ->schema([
                    Radio::make('delete_option')
                        ->label('Étendue de la suppression')
                        ->options([
                            'this' => 'Uniquement ce cours',
                            'future' => 'Ce cours et tous les cours suivants',
                            'all' => 'Toute la série (tous les cours passés et futurs)',
                        ])
                        ->default('this')
                        ->required(),
                ])
                ->action(function (array $data, Course $record) {
                    $option = $data['delete_option'];

                    if ($option === 'this') {
                        $record->delete();
                        Notification::make()->title('Cours supprimé')->success()->send();
                    }
                    elseif ($option === 'future') {
                        if ($record->parent_course_id) {
                            Course::where('parent_course_id', $record->parent_course_id)
                                ->where('start', '>=', $record->start)
                                ->delete();
                            $record->delete();
                        } else {
                            Course::where('parent_course_id', $record->id)->delete();
                            $record->delete();
                        }
                        Notification::make()->title('Cours supprimés avec les suivants')->success()->send();
                    }
                    elseif ($option === 'all') {
                        if ($record->parent_course_id) {
                            $parent = Course::find($record->parent_course_id);
                            if ($parent) {
                                Course::where('parent_course_id', $parent->id)->delete();
                                $parent->delete();
                            }
                        } else {
                            Course::where('parent_course_id', $record->id)->delete();
                            $record->delete();
                        }
                        Notification::make()->title('Toute la série a été supprimée')->success()->send();
                    }

                    $this->redirect($this->getResource()::getUrl('index'));
                }),

            Action::make('detach')
                ->label('Détacher de la série')
                ->icon('heroicon-o-link-slash')
                ->color('warning')
                ->visible(fn () => $this->record->parent_course_id !== null)
                ->requiresConfirmation()
                ->modalDescription('Ce cours deviendra indépendant. Les modifications sur la série d\'origine ne l\'affecteront plus.')
                ->action(function (Course $record) {
                    $record->update([
                        'parent_course_id' => null,
                        'is_recurring' => false,
                        'recurrence_type' => null,
                        'recurrence_days' => null,
                        'recurrence_end' => null,
                    ]);
                    Notification::make()->title('Cours détaché avec succès')->success()->send();
                }),
        ];
    }
}
