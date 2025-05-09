<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;
    protected static ?string $title = 'Crea nuovo articolo';
}
