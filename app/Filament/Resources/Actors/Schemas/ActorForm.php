<?php

namespace App\Filament\Resources\Actors\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ActorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('image_actor')
                    ->image()
                    ->required(),
                Textarea::make('biography')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('date_of_birth'),
            ]);
    }
}
