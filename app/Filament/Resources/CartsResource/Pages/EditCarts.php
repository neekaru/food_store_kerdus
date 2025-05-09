<?php

namespace App\Filament\Resources\CartsResource\Pages;

use App\Filament\Resources\CartsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarts extends EditRecord
{
    protected static string $resource = CartsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
