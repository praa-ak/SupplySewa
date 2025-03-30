<?php

namespace App\Filament\Retailer\Resources;

use App\Filament\Retailer\Resources\DistributorProductResource\Pages;
use App\Filament\Retailer\Resources\DistributorProductResource\RelationManagers;
use App\Models\DistributorProduct;
use App\Models\ManifactureProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DistributorProductResource extends Resource
{
    protected static ?string $model = DistributorProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Receive Product';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('retailer_id')
                ->default(Auth::guard('retailer')->user()->id)
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

                ->live(debounce: 2000)
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    if ($state) {
                        $product = ManifactureProduct::find($state);
                        $set('qty', null); // Reset qty to prevent invalid selections
                        $set('qty', $product ? $product->stock : null); // Set the max quantity dynamically
                    }
                })
                ->preload()
                ->label('Select Product')
                ->required(),
            Forms\Components\TextInput::make('qty')
                ->required()
                ->numeric()
                ->maxValue(fn(callable $get) => $get('qty')), // Dynamically get max_qty set above,
            Forms\Components\Hidden::make('qty'),
            Forms\Components\TextInput::make('qr_code')
                ->maxLength(255),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->default('pending')
                ->label('Status'),
            Forms\Components\Select::make('distributor_id')
                ->relationship('distributor', 'name', function ($query) {
                    return $query->where('id', Auth::guard('retailer')->user()->distributor_id);
                })
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(self::getEloquentQuery()->where('status', 'approved'))
            ->columns([
                Tables\Columns\TextColumn::make('distributor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qr_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('retailer.name')
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
            'index' => Pages\ListDistributorProducts::route('/'),
            'create' => Pages\CreateDistributorProduct::route('/create'),
            'edit' => Pages\EditDistributorProduct::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('retailer_id', Auth::guard('retailer')->user()->id);
        return parent::getEloquentQuery()->where('distributor_id', Auth::guard('retailer')->user()->distributor_id);
        return parent::getEloquentQuery()->where('product_id', Auth::guard('retailer')->user()->distributor_id);

    }
}
