<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use App\Models\Shop;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('shop_id')
                            ->label('Shop')
                            ->options(shop::all()->pluck('name', 'id'))
                            ->searchable(),
                Forms\Components\TextInput::make('name')
                            ->maxLength(255)
                            ->required(),
                Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')->columnSpan('full'),
                Forms\Components\RichEditor::make('description')->columnSpan('full'),
                Forms\Components\Fieldset::make('Label')
                    ->schema([
                        Forms\Components\TextInput::make('quantity')
                        ->numeric()
                        ->maxLength(255)
                        ->required(),
                Forms\Components\TextInput::make('unit')
                        ->maxLength(255)
                        ->required(),
                Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->maxLength(255)
                        ->required(),
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('quantity')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\TextColumn::make('price')
                        ->searchable()
                        ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            //'create' => Pages\CreateItem::route('/create'),
            //'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }    
}
