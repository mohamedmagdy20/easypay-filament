<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)->label(__('lang.name')),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->label(__('lang.phone'))
                    ->maxLength(255),
                Forms\Components\Textarea::make('note')
                    ->maxLength(65535)
                    ->label(__('lang.note'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('lang.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(_('phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('lang.craeted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'view' => Pages\ViewSupplier::route('/{record}'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }


    public static function getNavigationLabel(): string
    {
        return __('lang.suppliers'); // Navigation label
    }

    public static function getModelLabel(): string
    {
        return __('lang.supplier'); // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return __('lang.suppliers'); // Plural label
    }
    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
    
}
