<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FunFactResource\Pages;
use App\Modules\FunFact\Models\FunFact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FunFactResource extends Resource
{
    protected static ?string $model = FunFact::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    
    protected static ?string $navigationLabel = 'Fun Facts';
    
    protected static ?string $navigationGroup = 'Content';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\Tabs::make('Translations')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('Spanish')
                                    ->schema([
                                        Forms\Components\TextInput::make('title.es')
                                            ->label('Title (Spanish)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('content.es')
                                            ->label('Content (Spanish)')
                                            ->required()
                                            ->rows(4)
                                            ->maxLength(500),
                                    ]),
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\TextInput::make('title.en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('content.en')
                                            ->label('Content (English)')
                                            ->required()
                                            ->rows(4)
                                            ->maxLength(500),
                                    ]),
                            ])->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->directory('fun-facts')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->getStateUsing(fn ($record) => $record->getTranslation('title', 'es')),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only')
                    ->native(false),
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
            ->defaultSort('sort_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFunFacts::route('/'),
            'create' => Pages\CreateFunFact::route('/create'),
            'edit' => Pages\EditFunFact::route('/{record}/edit'),
        ];
    }
}