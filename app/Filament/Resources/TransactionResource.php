<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\Customer;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Mask;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Support\Contracts\HasLabel;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\TransactionResource\Pages;

// for Enum Stuff Kinda

enum Status: string implements HasLabel
{
    case Pending = 'pending';
    case Success = 'success';
    case Expired = 'expired';
    case Failed = 'failed';

    public function getLabel(): ?string
    {
        return match ($this) {
            Status::Pending => 'Pending',
            Status::Success => 'Success',
            Status::Expired => 'Expired',
            Status::Failed => 'Failed',
        };
    }
    
    public function getColor(): string
    {
        return match ($this) {
            Status::Pending => 'warning',  // Warna kuning 
            Status::Success => 'success',  // Warna hijau
            Status::Expired => 'secondary', // Warna abu-abu
            Status::Failed => 'danger',   // Warna merah
        };
    }
};

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Shopping';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                // Customer
                                Select::make('customer_id')
                                    ->options(function (): array {
                                        return Customer::all()->pluck('name', 'id')->all();
                                    })
                                    ->label('Customer')
                                    ->searchable()
                                    ->required(),

                                // Provinsi
                                Select::make('province_id')
                                    ->options(function (): array {
                                        return Province::all()->pluck('name', 'id')->all();
                                    })
                                    ->label('Provinsi')
                                    ->searchable()
                                    ->required(),

                                // City
                                Select::make('city_id')
                                    ->options(function (): array {
                                        return City::all()->pluck('name', 'id')->all();
                                    })
                                    ->label('City')
                                    ->searchable()
                                    ->required(),
                            ]),

                        TextInput::make('invoice')
                            ->label('Masukkan Invoice Anda')
                            ->placeholder('Contoh : INV-001')
                            ->required(),

                        Textarea::make('address')
                            ->label('Alamat')
                            ->placeholder('Masukkan Alamat Anda')
                            ->required()
                            ->rows(2),

                        TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Select::make('status')
                            ->label('Status Transaksi')
                            ->options(Status::class)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice')
                    ->label('Invoice')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
