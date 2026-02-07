<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MovieInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('release_year')
                    ->date(),
                TextEntry::make('photo_url'),
                TextEntry::make('background_url'),
                TextEntry::make('trailer_url'),
            ]);
    }
}
