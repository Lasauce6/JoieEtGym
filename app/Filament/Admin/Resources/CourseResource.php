<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CourseResource\Pages;
use App\Models\Course;
use App\Services\Geocoder;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\Actions as FormActions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Planning';
    protected static ?string $modelLabel = 'Cours';
    protected static ?string $pluralModelLabel = 'Cours';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titre du cours')
                                    ->required()
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Section::make('Planification')
                                    ->schema([
                                        Forms\Components\DateTimePicker::make('start')
                                            ->label('Début')
                                            ->required()
                                            ->seconds(false)
                                            ->live(),

                                        Forms\Components\DateTimePicker::make('end')
                                            ->label('Fin')
                                            ->required()
                                            ->seconds(false)
                                            ->after('start'),

                                        Forms\Components\Select::make('color')
                                            ->label('Couleur')
                                            ->options([
                                                '#F97316' => 'Orange',
                                                '#22C55E' => 'Vert',
                                                '#EAB308' => 'Jaune',
                                                '#3B82F6' => 'Bleu',
                                                '#EF4444' => 'Rouge',
                                                '#8B5CF6' => 'Violet',
                                                '#EC4899' => 'Rose',
                                                '#6B7280' => 'Gris',
                                            ])
                                            ->default('#F97316')
                                            ->required(),
                                    ])->columns(3),

                                Section::make('Lieu & Géocodage')
                                    ->schema([
                                        Forms\Components\TextInput::make('location')
                                            ->label('Adresse')
                                            ->placeholder('Ex: 10 Rue de la Paix, Paris')
                                            ->live(debounce: 1000)
                                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                                if (filled($state)) {
                                                    $geocoder = app(Geocoder::class);
                                                    $coords = $geocoder->geocode($state);

                                                    if ($coords) {
                                                        $set('latitude', $coords['lat']);
                                                        $set('longitude', $coords['lon']);
                                                    }
                                                }
                                            }),

                                        FormActions::make([
                                            Action::make('geocode_now')
                                                ->label('Géocoder cette adresse')
                                                ->action(function (Get $get, Set $set) {
                                                    $address = $get('location');

                                                    if (filled($address)) {
                                                        $geocoder = app(Geocoder::class);
                                                        $coords = $geocoder->geocode($address);
                                                        if ($coords) {
                                                            $set('latitude', $coords['lat']);
                                                            $set('longitude', $coords['lon']);
                                                        }
                                                    }
                                                }),
                                        ]),

                                        Grid::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('latitude')
                                                    ->label('Latitude')
                                                    ->numeric()
                                                    ->readOnly()
                                                    ->helperText('Rempli automatiquement'),
                                                Forms\Components\TextInput::make('longitude')
                                                    ->label('Longitude')
                                                    ->numeric()
                                                    ->readOnly()
                                                    ->helperText('Rempli automatiquement'),
                                            ]),
                                    ]),

                                Section::make('Récurrence')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_recurring')
                                            ->label('Cours récurrent')
                                            ->live()
                                            ->helperText('Activer pour générer une série de cours.'),

                                        Forms\Components\Select::make('recurrence_type')
                                            ->label('Type de récurrence')
                                            ->options([
                                                'daily' => 'Tous les jours',
                                                'weekly' => 'Chaque semaine',
                                                'all_week' => 'Toute la semaine (lun–ven)',
                                            ])
                                            ->default('weekly')
                                            ->live()
                                            ->visible(fn (Get $get) => $get('is_recurring')),

                                        Forms\Components\CheckboxList::make('recurrence_days')
                                            ->label('Jours de la semaine')
                                            ->options([
                                                'monday' => 'Lundi',
                                                'tuesday' => 'Mardi',
                                                'wednesday' => 'Mercredi',
                                                'thursday' => 'Jeudi',
                                                'friday' => 'Vendredi',
                                                'saturday' => 'Samedi',
                                                'sunday' => 'Dimanche',
                                            ])
                                            ->columns()
                                            ->visible(fn (Get $get) => $get('is_recurring') && $get('recurrence_type') === 'weekly'),

                                        Forms\Components\DatePicker::make('recurrence_end')
                                            ->label('Date de fin de récurrence')
                                            ->visible(fn (Get $get) => $get('is_recurring')),
                                    ]),

                                Section::make('Modification')
                                    ->schema([
                                        Forms\Components\Radio::make('update_scope')
                                            ->label('Appliquer les modifications')
                                            ->options([
                                                'this' => 'Uniquement à ce cours',
                                                'future' => 'À ce cours et aux suivants',
                                            ])
                                            ->default('this')
                                            ->visible(fn ($record) => $record && ($record->parent_course_id || ($record->is_recurring && $record->children()->exists())))
                                            ->columnSpanFull()
                                            ->helperText('Attention : les modifications de date/heure ne s\'appliqueront qu\'à ce cours.'),
                                    ])
                                    ->visible(fn ($record) => $record && ($record->parent_course_id || ($record->is_recurring && $record->children()->exists()))),
                            ])->columnSpan(2),

                        Section::make('Animateurs')
                            ->schema([
                                Forms\Components\Select::make('animators')
                                    ->label('Animateurs assignés')
                                    ->relationship('animators', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')->required(),
                                        Forms\Components\FileUpload::make('photo')->image(),
                                    ])
                                    ->columnSpanFull(),
                            ])->columnSpan(1),
                    ]),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('animators.name')
                    ->label('Animateurs')
                    ->badge()
                    ->limitList(2),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lieu')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('upcoming')
                    ->label('Cours à venir')
                    ->query(fn ($query) => $query->where('start', '>=', now())),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('delete')
                    ->label('Supprimer')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Options de suppression')
                    ->modalDescription(function (Course $record) {
                        if ($record->parent_course_id || ($record->is_recurring && $record->children()->exists())) {
                            return 'Ce cours fait partie d\'une série. Que souhaitez-vous faire ?';
                        }
                        return 'Êtes-vous sûr de vouloir supprimer ce cours ?';
                    })
                    ->form([
                        Radio::make('delete_option')
                            ->label('Étendue de la suppression')
                            ->options([
                                'this' => 'Uniquement ce cours',
                                'future' => 'Ce cours et tous les cours suivants',
                                'all' => 'Toute la série (tous les cours passés et futurs)',
                            ])
                            ->default('this')
                            ->required()
                            ->visible(fn (Course $record) => $record->parent_course_id || ($record->is_recurring && $record->children()->exists())),
                    ])
                    ->action(function (Course $record, array $data) {
                        $option = $data['delete_option'] ?? 'this';

                        if ($option === 'this') {
                            $record->delete();
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
                        }

                        Notification::make()
                            ->title('Suppression effectuée')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
