<?php

namespace App\Filament\Resources\ProductionCompanies\Pages;

use App\Filament\Resources\ProductionCompanies\ProductionCompanyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductionCompany extends CreateRecord
{
    protected static string $resource = ProductionCompanyResource::class;
}
