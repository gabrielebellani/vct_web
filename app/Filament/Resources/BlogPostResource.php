<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

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
                    ->formatStateUsing(fn (string $state): string => $state ? 'Bozza' : 'Pubblicato'),
                Tables\Columns\TextColumn::make('created_at')->label('Data di creazione')->dateTime('d F Y - H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
