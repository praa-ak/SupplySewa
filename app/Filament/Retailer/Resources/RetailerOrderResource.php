<?php

namespace App\Filament\Retailer\Resources;

use App\Filament\Retailer\Resources\RetailerOrderResource\Pages;
use App\Filament\Retailer\Resources\RetailerOrderResource\RelationManagers;
use App\Models\RetailerOrder;
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

class RetailerOrderResource extends Resource
{
    protected static ?string $model = RetailerOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
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
                Grid::make()->schema(fn(Get $get): array => match ($get('payment_method')) {
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
                Forms\Components\TextInput::make('retailer_id')
                    ->default(Auth::user()->id)
                    ->readOnly()
                    ->required(),
                Forms\Components\TextInput::make('distributor_id')
                    ->default(Auth::user()->distributor_id)
                    ->readOnly()
                    ->required(),
                Forms\Components\Select::make('product_id')
                ->options(function () {
                    $distributor = Auth::guard('retailer')->user()->distributor_id;
                    return \App\Models\ManifactureProduct::where('distributor_id', $distributor)
                        ->with('product') // Ensure the related product is loaded
                        ->get()
                        ->pluck('product.name', 'product.id'); // Key: product_id, Value: product name
                })
                    ->label('Product')
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
