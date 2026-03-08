<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('roles.name')
                        ->default('Sin Rol asignado')
                        ->label('Rol')
                        ->badge()
                        ->separator(', '),
                TextColumn::make('permissions.name')
                        ->label('Permisos')
                        ->badge()
                        ->separator(', ')
                        ->visible(fn () => auth()->user()->hasRole('admin') || auth()->user()->can('ver.permisos'))
            ])
            ->filters([
                //
            ])
            ->recordActions([
                    EditAction::make()
                        ->visible(fn () => auth()->user()?->can('editar.usuarios')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
