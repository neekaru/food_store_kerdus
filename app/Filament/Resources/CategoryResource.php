<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Product Catalog';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

public static function form(Form $form): Form
{
    return $form
        ->schema([
            //card
            Forms\Components\Card::make()
            ->schema([

                //image
                Forms\Components\FileUpload::make('image')
                  ->label('Category Image')
                  ->placeholder('Category Image')
                  ->required(),

                //name
                Forms\Components\TextInput::make('name')
                  ->label('Category Name')
                  ->placeholder('Category Name')
                  ->required(),

        ])
    ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')->circular(),
            Tables\Columns\TextColumn::make('name')->searchable(),
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
