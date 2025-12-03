<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Modules\Article\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Artículos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Contenido')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Español')
                            ->schema([
                                Forms\Components\TextInput::make('title.es')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, callable $set, $get) {
                                        if (empty($get('slug'))) {
                                            $set('slug', \Illuminate\Support\Str::slug($state));
                                        }
                                    }),
                                
                                Forms\Components\Textarea::make('excerpt.es')
                                    ->label('Resumen')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(500),
                                
                                Forms\Components\RichEditor::make('body.es')
                                    ->label('Contenido')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('articles'),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('excerpt.en')
                                    ->label('Excerpt')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(500),
                                
                                Forms\Components\RichEditor::make('body.en')
                                    ->label('Content')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('articles'),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Configuración')
                            ->schema([
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Se genera automáticamente del título'),
                                
                                Forms\Components\Select::make('status')
                                    ->label('Estado')
                                    ->options([
                                        'draft' => 'Borrador',
                                        'published' => 'Publicado',
                                        'scheduled' => 'Programado',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Artículo destacado')
                                    ->default(false)
                                    ->helperText('Aparecerá en la página principal'),
                                
                                Forms\Components\TextInput::make('reading_time')
                                    ->label('Tiempo de lectura (minutos)')
                                    ->numeric()
                                    ->default(5)
                                    ->minValue(1)
                                    ->maxValue(60),
                                
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Fecha de publicación')
                                    ->default(now())
                                    ->required(),
                                
                                Forms\Components\DateTimePicker::make('scheduled_at')
                                    ->label('Programar publicación')
                                    ->helperText('Opcional: programar para publicar en el futuro'),
                                
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Imagen destacada')
                                    ->image()
                                    ->directory('articles')
                                    ->maxSize(2048)
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                        
                        Forms\Components\Tabs\Tab::make('Relaciones')
                            ->schema([
                                Forms\Components\Select::make('categories')
                                    ->label('Categorías')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->columnSpanFull(),
                                
                                Forms\Components\Select::make('tags')
                                    ->label('Etiquetas')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->columnSpanFull(),
                                
                                Forms\Components\Select::make('created_by')
                                    ->label('Autor/Creador')
                                    ->relationship('creator', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->default(auth()->id()),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['es'] ?? 'Sin título') : $state)
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Estado')
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                        'warning' => 'scheduled',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'draft' => 'Borrador',
                        'published' => 'Publicado',
                        'scheduled' => 'Programado',
                        default => $state,
                    }),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star'),
                
                Tables\Columns\TextColumn::make('reading_time')
                    ->label('Lectura')
                    ->formatStateUsing(fn ($state) => $state . ' min')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publicado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'draft' => 'Borrador',
                        'published' => 'Publicado',
                        'scheduled' => 'Programado',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Destacado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo destacados')
                    ->falseLabel('No destacados'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}