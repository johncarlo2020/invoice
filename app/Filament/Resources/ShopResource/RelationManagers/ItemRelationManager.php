<?php

namespace App\Filament\Resources\ShopResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemRelationManager extends RelationManager
{
    protected static string $relationship = 'Item';

    protected static ?string $recordTitleAttribute = 'shop_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                            ->maxLength(255)
                            ->required(),
                Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080'),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
