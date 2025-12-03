<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Modules\Game\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationLabel = 'Juegos';

    protected static ?string $modelLabel = 'Juego';

    protected static ?string $pluralModelLabel = 'Juegos';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Principal')
                    ->schema([
                        Forms\Components\TextInput::make('title.es')
                            ->label('Título (Español)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => 
                                $set('slug', Str::slug($state))
                            ),
                        Forms\Components\TextInput::make('title.en')
                            ->label('Título (Inglés)')
                            ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'physics' => 'Física',
                                'math' => 'Matemáticas',
                                'biology' => 'Biología',
                                'chemistry' => 'Química',
                            ])
                            ->required(),
                        Forms\Components\Select::make('difficulty')
                            ->label('Dificultad')
                            ->options([
                                'easy' => 'Fácil',
                                'medium' => 'Medio',
                                'hard' => 'Difícil',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('game_file')
                            ->label('Archivo del Juego')
                            ->helperText('Nombre del archivo del juego (sin extensión)')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Descripción')
                    ->schema([
                        Forms\Components\Textarea::make('description.es')
                            ->label('Descripción (Español)')
                            ->required()
                            ->rows(3),
                        Forms\Components\Textarea::make('description.en')
                            ->label('Descripción (Inglés)')
                            ->required()
                            ->rows(3),
                    ]),

                Forms\Components\Section::make('Instrucciones')
                    ->schema([
                        Forms\Components\Textarea::make('instructions.es')
                            ->label('Instrucciones (Español)')
                            ->rows(5),
                        Forms\Components\Textarea::make('instructions.en')
                            ->label('Instrucciones (Inglés)')
                            ->rows(5),
                    ]),

                Forms\Components\Section::make('Objetivos de Aprendizaje')
                    ->schema([
                        Forms\Components\TagsInput::make('learning_objectives.es')
                            ->label('Objetivos (Español)')
                            ->placeholder('Presiona Enter para agregar'),
                        Forms\Components\TagsInput::make('learning_objectives.en')
                            ->label('Objetivos (Inglés)')
                            ->placeholder('Presiona Enter para agregar'),
                    ]),

                Forms\Components\Section::make('Configuración')
                    ->schema([
                        Forms\Components\TextInput::make('estimated_time')
                            ->label('Tiempo Estimado (minutos)')
                            ->numeric()
                            ->default(10),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Destacado')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title.es')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'physics' => 'Física',
                        'math' => 'Matemáticas',
                        'biology' => 'Biología',
                        'chemistry' => 'Química',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'physics',
                        'success' => 'biology',
                        'warning' => 'chemistry',
                        'danger' => 'math',
                    ]),
                Tables\Columns\BadgeColumn::make('difficulty')
                    ->label('Dificultad')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'easy' => 'Fácil',
                        'medium' => 'Medio',
                        'hard' => 'Difícil',
                        default => $state,
                    })
                    ->colors([
                        'success' => 'easy',
                        'warning' => 'medium',
                        'danger' => 'hard',
                    ]),
                Tables\Columns\TextColumn::make('play_count')
                    ->label('Jugado')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'physics' => 'Física',
                        'math' => 'Matemáticas',
                        'biology' => 'Biología',
                        'chemistry' => 'Química',
                    ]),
                Tables\Filters\SelectFilter::make('difficulty')
                    ->label('Dificultad')
                    ->options([
                        'easy' => 'Fácil',
                        'medium' => 'Medio',
                        'hard' => 'Difícil',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Activo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}