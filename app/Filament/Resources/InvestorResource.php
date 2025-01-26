<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestorResource\Pages;
use App\Filament\Resources\InvestorResource\RelationManagers;
use App\Models\Investor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestorResource extends Resource
{
    protected static ?string $model = Investor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('capital')
                    ->numeric(),
                Forms\Components\TextInput::make('total_benefits')
                    ->numeric(),
                Forms\Components\TextInput::make('note')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_benefits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->searchable(),
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
            'index' => Pages\ListInvestors::route('/'),
            'create' => Pages\CreateInvestor::route('/create'),
            'view' => Pages\ViewInvestor::route('/{record}'),
            'edit' => Pages\EditInvestor::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationLabel(): string
    {
        return __('lang.investors');
    }
    public static function getModelLabel(): string
    {
        return __('lang.investors');
    }
    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
    
}
