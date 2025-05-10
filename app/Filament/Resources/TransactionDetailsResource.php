<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionDetailsResource\Pages;
use App\Filament\Resources\TransactionDetailsResource\RelationManagers;
use App\Models\TransactionDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionDetailsResource extends Resource
{
    protected static ?string $model = TransactionDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shopping';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Card Layout
            Forms\Components\Card::make()
                ->schema([

                    // Transaction ID (Auto-fill atau Manual)
                    Forms\Components\TextInput::make('transaction_id')
                        ->label('Transaction ID')
                        ->placeholder('Masukkan ID Transaksi')
                        ->required(),

                    // Product ID (Dropdown dari Database)
                    Forms\Components\Select::make('product_id')
                        ->label('Product ID')
                        ->placeholder('Pilih Produk')
                        ->options(function () {
                            return \App\Models\Product::pluck('name', 'id');
                        })
                        ->searchable()
                        ->required(),

                    // Quantity (Input Angka)
                    Forms\Components\TextInput::make('quantity')
                        ->label('Quantity')
                        ->placeholder('Masukkan Jumlah')
                        ->numeric()
                        ->minValue(1)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (\Closure $set, $state) => 
                            $set('total_price', $state * 50000) // Contoh harga satuan
                        ),

                    // Harga Total (Auto-calculate)
                    Forms\Components\TextInput::make('total_price')
                        ->label('Harga Total')
                        ->prefix('Rp')
                        ->placeholder('Harga Total')
                        ->disabled()
                        ->required(),

                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('transaction_id')
                    ->label('ID Transaksi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_id')
                    ->label('ID Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah barang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Harga Total')
                    ->money('IDR',divideBy:true)
                    ->searchable()
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
            'index' => Pages\ListTransactionDetails::route('/'),
            'create' => Pages\CreateTransactionDetails::route('/create'),
            'edit' => Pages\EditTransactionDetails::route('/{record}/edit'),
        ];
    }
}
