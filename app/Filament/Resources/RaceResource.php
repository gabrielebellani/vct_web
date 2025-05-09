<?php

namespace App\Filament\Resources;

use App\Constants\RaceAges;
use App\Constants\RaceClasses;
use App\Constants\RaceType;
use App\Filament\Resources\RaceResource\Pages;
use App\Filament\Resources\RaceResource\RelationManagers;
use App\Models\Race;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RaceResource extends Resource
{
    protected static ?string $model = Race::class;
    protected static ?string $navigationLabel = 'Gare';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


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
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('classes'),
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('main_type'),
                Tables\Columns\TextColumn::make('sub_type'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListRaces::route('/'),
            'create' => Pages\CreateRace::route('/create'),
            'edit' => Pages\EditRace::route('/{record}/edit'),
        ];
    }
}
