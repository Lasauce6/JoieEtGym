<?php

namespace App\Filament\Admin\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\CourseResource\Pages\ListCourses;
use App\Filament\Admin\Resources\CourseResource\Pages\CreateCourse;
use App\Filament\Admin\Resources\CourseResource\Pages\EditCourse;
use App\Filament\Admin\Resources\CourseResource\Pages;
use App\Models\Course;
use App\Services\Geocoder;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';
    protected static string | \UnitEnum | null $navigationGroup = 'Planning';
    protected static ?string $modelLabel = 'Cours';
    protected static ?string $pluralModelLabel = 'Cours';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre du cours')
                                    ->required()
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Section::make('Planification')
                                    ->schema([
                                        DateTimePicker::make('start')
                                            ->label('Début')
                                            ->required()
                                            ->seconds(false)
                                            ->live(),

                                        DateTimePicker::make('end')
                                            ->label('Fin')
                                            ->required()
                                            ->seconds(false)
                                            ->after('start'),

                                        Select::make('color')
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
                                        TextInput::make('location')
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

                                        Actions::make([
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
                                                TextInput::make('latitude')
                                                    ->label('Latitude')
                                                    ->numeric()
                                                    ->readOnly()
                                                    ->helperText('Rempli automatiquement'),
                                                TextInput::make('longitude')
                                                    ->label('Longitude')
                                                    ->numeric()
                                                    ->readOnly()
                                                    ->helperText('Rempli automatiquement'),
                                            ]),
                                    ]),

                                Section::make('Récurrence')
                                    ->schema([
                                        Toggle::make('is_recurring')
                                            ->label('Cours récurrent')
                                            ->live()
                                            ->helperText('Activer pour générer une série de cours.'),

                                        Select::make('recurrence_type')
                                            ->label('Type de récurrence')
                                            ->options([
                                                'daily' => 'Tous les jours',
                                                'weekly' => 'Chaque semaine',
                                                'all_week' => 'Toute la semaine (lun–ven)',
                                            ])
                                            ->default('weekly')
                                            ->live()
                                            ->visible(fn (Get $get) => $get('is_recurring')),

                                        CheckboxList::make('recurrence_days')
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

                                        DatePicker::make('recurrence_end')
                                            ->label('Date de fin de récurrence')
                                            ->visible(fn (Get $get) => $get('is_recurring')),
                                    ]),

                                Section::make('Modification')
                                    ->schema([
                                        Radio::make('update_scope')
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
                                Select::make('animators')
                                    ->label('Animateurs assignés')
                                    ->relationship('animators', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')->required(),
                                        FileUpload::make('photo')->image(),
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
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('animators.name')
                    ->label('Animateurs')
                    ->badge()
                    ->limitList(2),

                TextColumn::make('location')
                    ->label('Lieu')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('upcoming')
                    ->label('Cours à venir')
                    ->query(fn ($query) => $query->where('start', '>=', now())),
            ])
            ->recordActions([
                EditAction::make(),

                Action::make('delete')
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
                    ->schema([
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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'edit' => EditCourse::route('/{record}/edit'),
        ];
    }
}
