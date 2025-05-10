<?php

namespace App\Filament\Resources;

use App\Constants\RaceAges;
use App\Constants\RaceClasses;
use App\Constants\RaceType;
use App\Filament\Resources\RaceResource\Pages;
use App\Helpers\BlogPostsRacesHelper;
use App\Models\Race;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RaceResource extends Resource
{
    protected static ?string $model = Race::class;
    protected static ?string $navigationLabel = 'Gare';

    protected static ?string $navigationIcon = 'lucide-bike';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Descrizione')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->label('Data')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Luogo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('class')
                    ->label('Classe')
                    ->options(RaceClasses::getLabeledClasses())
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('age')
                    ->label('Categorie')
                    ->options(RaceAges::getLabeledAges())
                    ->native(false)
                    ->multiple()
                    ->required(),
                Forms\Components\Select::make('main_type')
                    ->label('Disciplina')
                    ->options(RaceType::getLabeledMainTypes())
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('sub_type')
                    ->label('Specialità')
                    ->options(RaceType::getLabeledSubTypes())
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Data')
                    ->date('d F Y')
                    ->icon(fn($state): string => Carbon::parse($state)->isNowOrFuture() ? 'lucide-calendar-clock' : 'lucide-history')
                    ->iconColor(fn($state): string => Carbon::parse($state)->isNowOrFuture() ? 'info' : 'gray')
                    ->color(fn($state): string => Carbon::parse($state)->isNowOrFuture() ? 'info' : 'gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Luogo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class')
                    ->label('Classe')
                    ->formatStateUsing(fn(string $state): string => RaceClasses::getLabel($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')
                    ->label('Categoria')
                    ->formatStateUsing(fn(string $state): string => RaceAges::getLabelFromString($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('main_type')
                    ->formatStateUsing(fn(string $state): string => RaceType::getLabel($state))
                    ->label('Disciplina'),
                Tables\Columns\TextColumn::make('sub_type')
                    ->formatStateUsing(fn(string $state): string => RaceType::getLabel($state))
                    ->label('Specialità'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->disabled(fn (?Collection $records): bool => !is_null($records) && !BlogPostsRacesHelper::racesHavePosts($records)),
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
            'index' => Pages\ListRaces::route('/'),
            'create' => Pages\CreateRace::route('/create'),
            'edit' => Pages\EditRace::route('/{record}/edit'),
        ];
    }

    public static function canDelete(Model $record): bool
    {
        return !BlogPostsRacesHelper::raceHasPosts($record->id);
    }
}
