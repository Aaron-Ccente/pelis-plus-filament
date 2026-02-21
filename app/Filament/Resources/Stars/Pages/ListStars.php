<?php

namespace App\Filament\Resources\Stars\Pages;

use App\Filament\Resources\Stars\StarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStars extends ListRecords
{
    protected static string $resource = StarResource::class;
}
