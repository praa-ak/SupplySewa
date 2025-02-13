<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\RetailerOrderResource\Pages;
use App\Filament\Distributor\Resources\RetailerOrderResource\RelationManagers;
use App\Models\RetailerOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RetailerOrderResource extends Resource
{
    protected static ?string $model = RetailerOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('shipment_date')
                    ->required(),
                Forms\Components\TextInput::make('payment_method')
                    ->required(),
                Forms\Components\TextInput::make('payment_screenshot')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('retailer_id')
                    ->relationship('retailer', 'name')
                    ->required(),
                Forms\Components\Select::make('distributor_id')
                    ->relationship('distributor', 'name')
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship('manifactureProduct', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\ImageColumn::make('payment_screenshot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('retailer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('distributor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListRetailerOrders::route('/'),
            'create' => Pages\CreateRetailerOrder::route('/create'),
            'edit' => Pages\EditRetailerOrder::route('/{record}/edit'),
        ];
    }
}
