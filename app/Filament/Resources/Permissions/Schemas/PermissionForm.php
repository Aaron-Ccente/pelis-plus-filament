<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('display_name')
                    ->label('Nombre referencial')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Permiso')
                    ->required()
                    ->maxLength(255),
                TextInput::make('guard_name')
                    ->default('web')
            ]);
    }
}
