<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopResource\Pages;
use App\Filament\Resources\ShopResource\RelationManagers;
use App\Models\Shop;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength('255')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->maxLength('255')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\TextColumn::make('location')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                        ->searchable()
                        ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemRelationManager::class,
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShops::route('/'),
            'view' => Pages\ViewShop::route('/{record}'),
        //  'create' => Pages\CreateShop::route('/create'),
        //  'edit' => Pages\EditShop::route('/{record}/edit'),
        ];
    }    
}
