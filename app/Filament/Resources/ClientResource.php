<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')->label(__('lang.name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->label(__('lang.phone'))
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('national_id')->label(__('lang.national_id'))
                    ->maxLength(255),

                Forms\Components\TextInput::make('address')->label(__('lang.address'))
                    ->maxLength(255),
                
                Forms\Components\FileUpload::make('national_id_photo')->label(__('lang.national_id_photo'))->directory('form-attachments')->columnSpanFull()->image()->imageEditor(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('national_id_photo')->label(__('lang.national_id_photo'))->defaultImageUrl('default.png')->circular(),
                Tables\Columns\TextColumn::make('name')->label(__('lang.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(__('lang.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('national_id')->label(__('lang.national_id'))
                    ->searchable(),
                   
                Tables\Columns\TextColumn::make('address')->label(__('lang.address'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('lang.craeted_at'))
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('lang.clients'); // Navigation label
    }

    public static function getModelLabel(): string
    {
        return __('lang.clients'); // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return __('lang.clients'); // Plural label
    }
    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
