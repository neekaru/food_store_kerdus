<?php

namespace App\Filament\Resources\CartsResource\Pages;

use App\Filament\Resources\CartsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCarts extends CreateRecord
{
    protected static string $resource = CartsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
