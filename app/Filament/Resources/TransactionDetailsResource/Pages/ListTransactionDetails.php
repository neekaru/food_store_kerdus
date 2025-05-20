<?php

namespace App\Filament\Resources\TransactionDetailsResource\Pages;

use App\Filament\Resources\TransactionDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionDetails extends ListRecords
{
    protected static string $resource = TransactionDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
