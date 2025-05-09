<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
    protected static ?string $navigationLabel = 'Articoli';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titolo')
                    ->required(),
                Forms\Components\RichEditor::make('body')
                    ->label('Contenuto')
                    ->fileAttachmentsDisk(env('FILESYSTEM_DISK'))
                    ->fileAttachmentsDirectory('blog_attachments')
                    ->required()
                    ->visible(),
                Forms\Components\Toggle::make('draft')
                    ->label('Bozza'),
                FileUpload::make('cover')
                    ->directory('blog_covers')
                    ->disk(env('FILESYSTEM_DISK'))
                    ->preserveFilenames()
                    ->required()
                    ->label('Immagine di copertina')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Titolo'),
                Tables\Columns\TextColumn::make('draft')->label('Stato')
                    ->formatStateUsing(fn(string $state): string => $state ? 'Bozza' : 'Pubblicato'),
                Tables\Columns\TextColumn::make('created_at')->label('Data di creazione')->dateTime('d F Y - H:i'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Autore')
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('races')
                    ->label('Gare')
                    ->formatStateUsing(fn($state): string => dump('he')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('title')
                            ->label('Titolo'),
                        Forms\Components\View::make('filament.components.blog-post-html')
                            ->label('Contenuto')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('draft')
                            ->label('Bozza'),
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->disabled(fn(?Collection $records): bool => $records && ($records->count() !== $records->where('created_by', auth()->user()->id)->count())
                        ),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BlogPostResource\Widgets\CreateBlogPost::class
        ];
    }

}
