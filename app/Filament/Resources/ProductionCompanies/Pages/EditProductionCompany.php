<?php

namespace App\Filament\Resources\ProductionCompanies\Pages;

use App\Filament\Resources\ProductionCompanies\ProductionCompanyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductionCompany extends EditRecord
{
    protected static string $resource = ProductionCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
