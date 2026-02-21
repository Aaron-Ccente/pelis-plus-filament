<?php

namespace App\Filament\Resources\Stars\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('movie.title')
                    ->label('Película'),
                TextColumn::make('user.name')
                    ->label('Usuario'),
                TextColumn::make('movie_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_number')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ]);
    }
}
