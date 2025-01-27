<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label(__('lang.name'))->required(),
                Forms\Components\TextInput::make('email')->label(__('lang.email'))->required()->email()->unique(User::class,'email',ignoreRecord:true),
                Forms\Components\TextInput::make('password')
                ->password()
                ->label(__('lang.password'))
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')->confirmed(),
                Forms\Components\TextInput::make('password_confirmation')->password()
                ->label(__('lang.confirm_password'))
                ->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\Select::make('roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->label(__('lang.roles'))
                ->preload()
                ->columnSpanFull()
                ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('lang.name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label(__('lang.email'))->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('roles.name')->label(__('lang.roles'))
                ->colors([
                    'success' => 'المدير', // Set color for 'admin' role
                    'info' => 'موظف', // Set color for 'customer' role
                ])
                ->icons([
                    'heroicon-o-shield-check' => 'المدير', // Icon for 'admin' role
                    'heroicon-m-user-circle' => 'موظف', // Icon for 'customer' role
                ]),
                Tables\Columns\TextColumn::make('created_at')->label(__('lang.craeted_at'))->date()->searchable()->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                ->relationship('roles','name'),
                
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('lang.users');
    }
    public static function getModelLabel(): string
    {
        return __('lang.users');
    }
    public static function getPluralModelLabel(): string
    {
        return __('lang.clients'); // Plural label
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-shield::filament-shield.nav.group');
    }
}
