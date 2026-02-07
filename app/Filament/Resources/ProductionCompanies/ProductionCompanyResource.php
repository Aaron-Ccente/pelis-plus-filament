<?php

namespace App\Filament\Resources\ProductionCompanies;

use App\Filament\Resources\ProductionCompanies\Pages\CreateProductionCompany;
use App\Filament\Resources\ProductionCompanies\Pages\EditProductionCompany;
use App\Filament\Resources\ProductionCompanies\Pages\ListProductionCompanies;
use App\Filament\Resources\ProductionCompanies\Schemas\ProductionCompanyForm;
use App\Filament\Resources\ProductionCompanies\Tables\ProductionCompaniesTable;
use App\Models\Production_company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductionCompanyResource extends Resource
{
    protected static ?string $model = Production_company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductionCompanyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductionCompaniesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductionCompanies::route('/'),
            'create' => CreateProductionCompany::route('/create'),
            'edit' => EditProductionCompany::route('/{record}/edit'),
        ];
    }
}
