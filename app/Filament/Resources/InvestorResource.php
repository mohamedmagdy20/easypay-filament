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
                Forms\Components\TextInput::make('name')->label(__('lang.name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->label(__('lang.phone'))
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('capital')->label(__('lang.capital'))
                    ->numeric(),
                Forms\Components\TextInput::make('total_benefits')->label(__('lang.total_benefit'))
                    ->numeric(),
                Forms\Components\TextInput::make('note')->label(__('lang.note'))
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('lang.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(__('lang.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')->label(__('lang.capital'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_benefits')->label(__('lang.total_benefit'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')->label(__('lang.note'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('lang.craeted_at'))
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
        return __('lang.investors'); // Navigation label
    }

    public static function getModelLabel(): string
    {
        return __('lang.investors'); // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return __('lang.investors'); // Plural label
    }
    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
    
}
