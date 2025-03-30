<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\DistributorOrderResource\Pages;
use App\Filament\Distributor\Resources\DistributorOrderResource\RelationManagers;
use App\Models\DistributorOrder;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DistributorOrderResource extends Resource
{
    protected static ?string $model = DistributorOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $modelLabel = 'My Order';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('shipment_date')
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'cod' => 'Cash on Delivery',
                        'online' => 'Online Payment',
                    ])
                    ->live()
                    ->afterStateUpdated(fn(Select $component) => $component
                        ->getContainer()
                        ->getComponent('dynamicTypeFields')
                        ->getChildComponentContainer()
                        ->fill()),
                Grid::make(2)->schema(fn(Get $get): array => match ($get('payment_method')) {
                    'online' => [
                        Forms\Components\FileUpload::make('payment_screenshot')
                            ->image()
                            ->required()
                            ->default(null),
                    ],
                    default => [],
                })
                    ->key('dynamicTypeFields')
                    ,

                Forms\Components\TextInput::make('distributor_id')
                    ->default(Auth::user()->id)
                    ->readOnly()
                    ->required(),
                Forms\Components\TextInput::make('manufacturer_id')
                    ->default(Auth::user()->manufacturer_id)
                    ->readOnly()
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name', function ($query) {
                        return $query->where('manufacturer_id', Auth::user()->manufacturer_id);
                    })
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
                Tables\Columns\TextColumn::make('payment_method')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('payment_screenshot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('distributor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('manufacturer.name')
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
            'index' => Pages\ListDistributorOrders::route('/'),
            'create' => Pages\CreateDistributorOrder::route('/create'),
            'edit' => Pages\EditDistributorOrder::route('/{record}/edit'),
        ];
    }
}
