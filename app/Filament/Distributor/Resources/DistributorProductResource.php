<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\DistributorProductResource\Pages;
use App\Filament\Distributor\Resources\DistributorProductResource\RelationManagers;
use App\Models\DistributorProduct;
use App\Models\ManifactureProduct;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
// use Filament\Actions\Action;
use Filament\Forms;
use Filament\Tables\Actions\Action as Action;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class DistributorProductResource extends Resource
{
    protected static ?string $model = DistributorProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';
    protected static ?string $modelLabel = 'Send Product';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('distributor_id')
                    ->default(Auth::user()->id)
                    ->readOnly()
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->options(function () {
                        $distributor = Auth::guard('distributor')->user();
                        return \App\Models\ManifactureProduct::where('distributor_id', $distributor->id)
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
                Forms\Components\Select::make('retailer_id')
                    ->relationship('retailer', 'name', function ($query) {
                        return $query->where('distributor_id', Auth::guard('distributor')->user()->id);
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('distributor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('retailer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                ->searchable()
                    ->sortable()
                    ->default('pending')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
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
                // Action::make('Print')
                //     ->icon('heroicon-o-printer')
                //     ->modalSubmitActionLabel('Print')
                //     ->modalContent(fn(DistributorProduct $distributorProduct): View => view('filament.distributor.qrcode', compact('distributorProduct'))),
                Action::make('Print')
                    ->icon('heroicon-o-printer')
                    ->modalSubmitActionLabel('Print')
                    ->modalContent(fn(DistributorProduct $distributorProduct): View => view('filament.distributor.qrcode', compact('distributorProduct'))),
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
            'view' => Pages\ViewDistributorProduct::route('/{record}'),
            'edit' => Pages\EditDistributorProduct::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('distributor_id', Auth::guard('distributor')->user()->id);
        return parent::getEloquentQuery()->where('retailer_id', Auth::guard('distributor')->user()->retailer_id);
        return parent::getEloquentQuery()->where('product_id', Auth::guard('distributor')->user()->product_id);
    }
}
