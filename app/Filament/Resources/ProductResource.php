<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Master Data';

public static function getNavigationSort(): ?int
{
    return 1;
}


    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Card
            Forms\Components\Card::make()
                ->schema([

                    Forms\Components\TextInput::make('title')
                        ->label('Product Title')
                        ->placeholder('Enter Product Title')
                        ->required(),

                    // Image
                    Forms\Components\FileUpload::make('image')
                        ->label('Product Image')
                        ->placeholder('Upload Image')
                        ->required(),

                    // Name
                    Forms\Components\TextInput::make('name')
                        ->label('Product Name')
                        ->placeholder('Enter Product Name')
                        ->required(),

                    // Description
                    Forms\Components\Textarea::make('description')
                        ->label('Product Description')
                        ->placeholder('Enter product description')
                        ->required()
                        ->maxLength(500),

                    // Price
                    Forms\Components\TextInput::make('price')
                        ->label('Price')
                        ->placeholder('Enter product price')
                        ->numeric()
                        ->required(),

                    // Category (Relation)
                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->placeholder('Select a category')
                        ->required(),
                       Forms\Components\TextInput::make('weight')
                        ->label('Weight (Kg)')
                        ->numeric()
                        ->placeholder('e.g. 0.5')
                        ->required(),

                ])
        ]);
}


public static function table(Table $table): Table
{
    return $table
        ->columns([

            // Image (Circular)
            Tables\Columns\ImageColumn::make('image')
                ->label('Product Image')
                ->circular(),

            // Name (Searchable)
            Tables\Columns\TextColumn::make('name')
                ->label('Product Name')
                ->searchable(),

            // Description
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->limit(50),  // Membatasi tampilan deskripsi

            // Price
            Tables\Columns\TextColumn::make('price')
                ->label('Price')
                ->money('IDR', true),  // Format uang dengan simbol IDR

            // Category (Relationship)
            Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->sortable(),
        ])
        ->filters([
            // Filter by Category
            Tables\Filters\SelectFilter::make('category')
                ->label('Filter by Category')
                ->relationship('category', 'name'),
        ])
        ->actions([
            // Edit Action
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                // Delete Bulk Action
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
