<?php

namespace App\Filament\Resources\Themes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ThemesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('campania_id')
                    ->label('Campaña')
                    ->searchable(),

                ColorColumn::make('data.primary_color')
                    ->label('Color primario')
                    ->alignCenter(),

                ColorColumn::make('data.secondary_color')
                    ->label('Color secundario')
                    ->alignCenter(),

                ColorColumn::make('data.success_color')
                    ->label('Color éxito')
                    ->alignCenter(),

                ColorColumn::make('data.warning_color')
                    ->label('Color advertencia')
                    ->alignCenter(),

                ColorColumn::make('data.danger_color')
                    ->label('Color peligro')
                    ->alignCenter(),

                ColorColumn::make('data.info_color')
                    ->label('Color informativo')
                    ->alignCenter(),

                ColorColumn::make('data.background_color')
                    ->label('Color de fondo')
                    ->alignCenter(),

                ColorColumn::make('data.text_color')
                    ->label('Color de texto')
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}