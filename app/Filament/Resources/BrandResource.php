<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('brand.navigation.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('brand.navigation.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('brand.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('brand.navigation.group');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\Section::make(__('brand.sections.basic_information.label'))
                        ->schema([

                                Forms\Components\TextInput::make('name')
                                    ->label(__('brand.fields.name.label'))
                                    ->placeholder(__('brand.fields.name.placeholder'))
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label(__('brand.fields.slug.label'))
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Brand::class, 'slug', ignoreRecord: true),
                            ])
                        ->columns(2)
                        ->columnSpan(2)
                    ,

                    Forms\Components\Section::make(__('brand.sections.images.label'))
                        ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('brand-image')
                                    ->hiddenLabel(),
                            ])
                        ->columnSpan(1)
                        ->collapsible(),
                ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('name')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('slug')
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
