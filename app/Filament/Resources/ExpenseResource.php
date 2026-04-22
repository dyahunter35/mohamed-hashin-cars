<?php

namespace App\Filament\Resources;

use App\Enums\ExpenseType;
use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    public static function getModelLabel(): string
    {
        return __('expense.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('expense.plural_model_label');
    }

    protected static ?string $navigationLabel = 'المنصرفات';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'الإدارة المالية';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Section::make('')
                    ->columns(2)
                    ->columnSpan(2)
                    ->schema([

                        Forms\Components\ToggleButtons::make('type')
                            ->options(ExpenseType::class)
                            ->required()
                            ->inline()
                            ->columnSpan(2)
                            ->default(ExpenseType::Other)
                            ->label(__('expense.fields.type.label')),

                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->label(__('expense.fields.description.label')),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('SDG')
                            ->label(__('expense.fields.amount.label')),
                        Forms\Components\DatePicker::make('date')
                            ->required()
                            ->default(now())
                            ->label(__('expense.fields.date.label')),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->label(__('expense.fields.description')),
                Tables\Columns\TextColumn::make('amount')
                    ->money('SDG')
                    ->sortable()
                    ->label(__('expense.fields.amount')),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label(__('expense.fields.date')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('expense.fields.created_at')),
            ])
            ->filters([
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('من'),
                        Forms\Components\DatePicker::make('until')->label('إلى'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })->label(__('expense.fields.date')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
