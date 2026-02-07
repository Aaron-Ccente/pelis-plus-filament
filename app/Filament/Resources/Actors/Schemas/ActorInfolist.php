<?php

namespace App\Filament\Resources\Actors\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActorInfolist
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
                TextEntry::make('name'),
                ImageEntry::make('image_actor'),
                TextEntry::make('biography')
                    ->columnSpanFull(),
                TextEntry::make('date_of_birth')
                    ->date()
                    ->placeholder('-'),
            ]);
    }
}
