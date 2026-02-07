<?php

namespace App\Filament\Resources\ProductionCompanies\Pages;

use App\Filament\Resources\ProductionCompanies\ProductionCompanyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductionCompanies extends ListRecords
{
    protected static string $resource = ProductionCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
