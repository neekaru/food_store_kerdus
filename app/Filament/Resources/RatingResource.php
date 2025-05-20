<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\TransactionDetail;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\RatingResource\Pages;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating as RatingField;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Content';

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
                            Select::make('customer_id')
                                ->options(function (): array {
                                    return Customer::all()->pluck('name', 'id')->all();
                                })
                                ->label('Customer')
                                ->searchable()
                                ->required(),
                            Select::make('product_id')
                                ->options(function (): array {
                                    return Product::all()->pluck('title', 'id')->all();
                                })
                                ->label('Product')
                                ->searchable()
                                ->required(),
                            Select::make('transaction_detail_id')
                                ->options(function (): array {
                                        return TransactionDetail::all()->pluck('id', 'id')->all();
                                    })
                                ->label('Transaction Detail')
                                    ->searchable()
                                    ->required(),
                        ]),
                    RatingField::make('rating')
                        ->label('Rating')
                        ->stars(10)  // Set maximum stars to 10
                        ->allowZero() // Allow 0 stars rating
                        ->color('warning') // Use warning color (yellow/gold)
                        ->required(),
                    Textarea::make('review')
                        ->label('Review')
                        ->required()
                        ->rows(3)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product.title')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),
                RatingColumn::make('rating')
                    ->label('Rating')
                    ->stars(10)
                    ->color('warning'),
                TextColumn::make('review')
                    ->label('Review')
                    ->limit(50),
                TextColumn::make('created_at')
                    // ->dateTime('d M Y H.i')
                    ->formatStateUsing(fn (string $state): string => \Carbon\Carbon::parse($state)->locale('id')->format('d M Y H.i'))
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
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
