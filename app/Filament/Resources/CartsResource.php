<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartsResource\Pages;
use App\Models\Cart;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CartsResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';


    protected static ?string $navigationGroup = 'Master Data';


    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Select::make('customer_id')
                        ->options(function (): array {
                            return Customer::all()->pluck('name', 'id')->all();
                        })
                        ->label('Customer')
                        ->searchable()
                        ->required(),

                    Forms\Components\Select::make('product_id')
                        ->relationship('product', 'title')
                        ->label('Product')
                        ->searchable()
                        ->required(),

                    Forms\Components\TextInput::make('qty')
                        ->label('Quantity')
                        ->numeric()
                        ->minValue(1)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->label('Quantity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCarts::route('/create'),
            'edit' => Pages\EditCarts::route('/{record}/edit'),
        ];
    }
}
