<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\ManifactureProductResource\Pages;
use App\Filament\Distributor\Resources\ManifactureProductResource\RelationManagers;
use App\Models\ManifactureProduct;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Contracts\View\View;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ManifactureProductResource extends Resource
{
    use HasWizard;
    protected static ?string $model = ManifactureProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square';
    protected static ?string $modelLabel = 'Receive Product';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
                Forms\Components\TextInput::make('distributor_id')
                    ->default(Auth::guard('distributor')->user()->id)
                    ->readonly()
                    ->required(),

                Forms\Components\TextInput::make('id')
                    ->required()
                    ->default(Auth::guard('distributor')->user()->manifacutre_product_id)
                    ->label('Transaction ID')
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function (Set $set, ?string $state){
                        if ($state){
                            $transaction = ManifactureProduct::find($state);
                            $set('product_id', $transaction->product_id );
                            $set('qty', $transaction->qty );
                            $set('manufacturer_id', $transaction->manufacturer_id );
                        }
                    })
                    ->maxLength(255),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name', function ($query) {
                        return $query->where('manufacturer_id', Auth::user()->manufacturer_id);
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->live(debounce: 2000)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('stock', $state))
                    ->label('Quantity'),
                // Forms\Components\TextInput::make('stock')
                //     ->required()
                //     ->numeric()
                //     ->readOnly()
                //     ->label('Stock'),
                Forms\Components\TextInput::make('manufacturer_id')
                ->default(Auth::user()->manufacturer_id)
                ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->label('Status'),
            ]);



    }


    public static function table(Table $table): Table
    {
        return $table
            ->query(self::getEloquentQuery()->where('status', 'approved'))
            ->columns([
                Tables\Columns\TextColumn::make('distributor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('manufacturer.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()

                    -> searchable(),
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
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListManifactureProducts::route('/'),
            'product_entry' => Pages\CreateManifactureProduct::route('/create'),
            'view' => Pages\ViewManifactureProduct::route('/{record}'),
            'edit' => Pages\EditManifactureProduct::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('distributor_id', Auth::guard('distributor')->user()->id);

    }
}
