<?php

namespace App\Filament\Manufacturer\Resources;

use App\Filament\Manufacturer\Resources\ManifactureProductResource\Pages;
use App\Filament\Manufacturer\Resources\ManifactureProductResource\RelationManagers;
use App\Models\ManifactureProduct;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action as Action;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\options;

class ManifactureProductResource extends Resource
{
    protected static ?string $model = ManifactureProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';
    protected static ?string $modelLabel = 'Send Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('manufacturer_id')
                    ->default(Auth::user()->id)
                    ->readOnly()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name', function ($query) {
                        return $query->where('manufacturer_id', Auth::user()->id);
                    })
                    ->searchable()
                    ->live(debounce: 2000)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state) {
                            $product = Product::find($state);
                            $set('qty', null); // Reset qty to prevent invalid selections
                            $set('qty', $product ? $product->stock : null); // Set the max quantity dynamically
                        }
                    })
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->maxValue(fn(callable $get) => $get('qty')) // Dynamically get max_qty set above
                    ->extraAttributes(['placeholder' => 'Enter quantity']) // Optional: Add a placeholder
                    ->label('Quantity'),

                // Hidden field to hold max_qty for the selected product
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
                        return $query->where('manufacturer_id', Auth::user()->id);
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('manufacturer_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('distributor.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
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
                Action::make('Print')
                    ->icon('heroicon-o-printer')
                    ->modalSubmitActionLabel('Print')
                    ->modalContent(fn(ManifactureProduct $manifactureProduct): View => view('filament.manufacture.qr_code', compact('manifactureProduct'))),

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
            'create' => Pages\CreateManifactureProduct::route('/create'),
            'view' => Pages\ViewManifactureProduct::route('/{record}'),
            'edit' => Pages\EditManifactureProduct::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('manufacturer_id', Auth::guard('manufacturer')->user()->id);
        return parent::getEloquentQuery()->where('distributor_id', Auth::guard('manufacturer')->user()->distributor_id);
    }
}
