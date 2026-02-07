<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Schema;

class MovieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 🎬 Datos de la película
                TextInput::make('title')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                DatePicker::make('release_year')
                    ->required(),

                TextInput::make('photo_url')
                    ->url()
                    ->required(),

                TextInput::make('background_url')
                    ->url()
                    ->required(),

                TextInput::make('trailer_url')
                    ->url()
                    ->required(),

            Repeater::make('actors')
                ->schema([
                    Select::make('actor_id')
                        ->label('Actor')
                        ->searchable()
                        ->required()
                        ->options(fn () => \App\Models\Actor::query()
                            ->orderBy('name')
                            ->limit(value: 20) 
                            ->pluck('name', 'id')) 
                        ->createOptionForm([
                            TextInput::make('name')->required(),
                            TextInput::make('image_actor')->required(),
                            Textarea::make('biography')->required(),
                            DatePicker::make('date_of_birth')->nullable(),
                        ]),
                    TextInput::make('character_name')->required(),
                ]),

                CheckboxList::make('genres')
                    ->relationship('genres', 'name')
                    ->columns(3),

                Select::make('production_companies')
                    ->relationship('productionCompanies', 'name')
                    ->multiple()
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                    ]),
            ]);
    }
}
