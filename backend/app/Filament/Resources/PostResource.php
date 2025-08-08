<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        // Left Column (2/3 width)
                        Section::make()
                            ->schema([
                                TextInput::make('title')->required()->live()->afterStateUpdated(function ($state, callable $set) {
                                    $set('slug', Str::slug($state));
                                }),
                                RichEditor::make('content')->required()->extraAttributes([
                                    'style' => 'height: 50vh;',
                                ]),

                            ])
                            ->columnSpan(2),

                        // Right Sidebar (1/3 width)
                        Grid::make(1)
                            ->schema([
                                Section::make('Post Options')
                                    ->schema([
                                        TextInput::make('slug')->dehydrated(),
                                        FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('posts')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->previewable()
                                            ->imagePreviewHeight('200')
                                            ->preserveFilenames(),
                                        Select::make('user_id')
                                            ->label('Author')
                                            ->relationship('user', 'name'),
                                        Select::make('tags')
                                            ->relationship('tags', 'name')
                                            ->multiple()->preload(5),
                                        Select::make('category_id')
                                            ->relationship('category', 'name')
                                            ->nullable(),
                                        Select::make('status')
                                            ->options([
                                                'draft' => 'Draft',
                                                'publish' => 'Publish',
                                                'archived' => 'Archived',
                                            ])
                                            ->default('draft')
                                            ->required(),

                                    ]),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title')->searchable()->limit(50)->tooltip(fn($record) => $record->title),
                TextColumn::make('user.name')->label('Author'),
                TextColumn::make('category.name')->label('Category'),
                // TextColumn::make('tags.name')->label('Tags'),
                TextColumn::make('comments_count')->label('Comments'),
                TextColumn::make('created_at')->date()->label('Date')->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('comments')
            ->with(['user', 'category', 'tags'])
            ->withoutGlobalScopes([SoftDeletingScope::class]);
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}