<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FestivalWinnerResource\Pages;
use App\Models\FestivalWinner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FestivalWinnerResource extends Resource
{
    protected static ?string $model = FestivalWinner::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Festival Winners';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Student Information')
                    ->schema([
                        Forms\Components\TextInput::make('student_name.es')
                            ->label('Student Name (Spanish)')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('student_name.en')
                            ->label('Student Name (English)')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->directory('festival-winners')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('school')
                            ->label('School/Campus')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('state')
                            ->label('State')
                            ->maxLength(100),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Project Information')
                    ->schema([
                        Forms\Components\TextInput::make('project_title.es')
                            ->label('Project Title (Spanish)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('project_title.en')
                            ->label('Project Title (English)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('project_description.es')
                            ->label('Project Description (Spanish)')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('project_description.en')
                            ->label('Project Description (English)')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->required()
                            ->options([
                                'physics' => 'Physics',
                                'biology' => 'Biology',
                                'technology' => 'Technology',
                                'chemistry' => 'Chemistry',
                                'mathematics' => 'Mathematics',
                            ]),
                        
                        Forms\Components\Select::make('award_level')
                            ->label('Award Level')
                            ->required()
                            ->options([
                                'first_place' => 'First Place',
                                'second_place' => 'Second Place',
                                'third_place' => 'Third Place',
                                'honorable_mention' => 'Honorable Mention',
                            ]),
                        
                        Forms\Components\TextInput::make('year')
                            ->label('Year')
                            ->required()
                            ->numeric()
                            ->default(2025)
                            ->minValue(2020)
                            ->maxValue(2030),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                        
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),
                
                Tables\Columns\TextColumn::make('student_name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['es'] ?? $state['en'] ?? '') : $state),
                
                Tables\Columns\TextColumn::make('school')
                    ->label('School')
                    ->searchable()
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->colors([
                        'primary' => 'physics',
                        'success' => 'biology',
                        'warning' => 'technology',
                        'danger' => 'chemistry',
                        'info' => 'mathematics',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                
                Tables\Columns\TextColumn::make('award_level')
                    ->label('Award')
                    ->badge()
                    ->colors([
                        'warning' => 'first_place',
                        'secondary' => 'second_place',
                        'danger' => 'third_place',
                        'info' => 'honorable_mention',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'first_place' => '🥇 First',
                        'second_place' => '🥈 Second',
                        'third_place' => '🥉 Third',
                        'honorable_mention' => '🎖️ Mention',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->options([
                        2025 => '2025',
                        2024 => '2024',
                        2023 => '2023',
                    ]),
                
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'physics' => 'Physics',
                        'biology' => 'Biology',
                        'technology' => 'Technology',
                        'chemistry' => 'Chemistry',
                        'mathematics' => 'Mathematics',
                    ]),
                
                Tables\Filters\SelectFilter::make('award_level')
                    ->options([
                        'first_place' => 'First Place',
                        'second_place' => 'Second Place',
                        'third_place' => 'Third Place',
                        'honorable_mention' => 'Honorable Mention',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
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
            ->defaultSort('year', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFestivalWinners::route('/'),
            'create' => Pages\CreateFestivalWinner::route('/create'),
            'edit' => Pages\EditFestivalWinner::route('/{record}/edit'),
        ];
    }
}