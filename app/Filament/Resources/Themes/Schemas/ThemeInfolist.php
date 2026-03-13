<?php

namespace App\Filament\Resources\Themes\Schemas;

use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ThemeInfolist
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

                TextEntry::make('user_id')
                    ->placeholder('-'),

                ColorEntry::make('data.primary_color')
                    ->label('Color primario'),

                ColorEntry::make('data.secondary_color')
                    ->label('Color secundario'),

                ColorEntry::make('data.success_color')
                    ->label('Color éxito'),

                ColorEntry::make('data.warning_color')
                    ->label('Color advertencia'),

                ColorEntry::make('data.danger_color')
                    ->label('Color peligro'),

                ColorEntry::make('data.info_color')
                    ->label('Color informativo'),

                ColorEntry::make('data.background_color')
                    ->label('Color fondo'),

                ColorEntry::make('data.text_color')
                    ->label('Color texto'),
            ]);
    }
}