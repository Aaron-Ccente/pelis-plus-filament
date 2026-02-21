<?php

namespace App\Filament\Resources\Stars;

use App\Filament\Resources\Stars\Pages\CreateStar;
use App\Filament\Resources\Stars\Pages\EditStar;
use App\Filament\Resources\Stars\Pages\ListStars;
use App\Filament\Resources\Stars\Schemas\StarForm;
use App\Filament\Resources\Stars\Tables\StarsTable;
use App\Models\Star;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StarResource extends Resource
{
    protected static ?string $model = Star::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Star';


    public static function table(Table $table): Table
    {
        return StarsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStars::route('/'),
            // 'create' => CreateStar::route('/create'),
            // 'edit' => EditStar::route('/{record}/edit'),
        ];
    }
}
