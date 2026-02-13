<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\ProductQty;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Services\InventoryService;
use App\Enums\ItemCondition;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    // get Header widget
    protected function getHeaderWidgets(): array
    {
        return [
            ProductQty::class,
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // dd($data);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [


            Action::make('moveToUsed')
                ->label('نقل للمستعمل')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->modalHeading('تحويل كمية من الجديد إلى المستعمل')
                ->modalSubmitActionLabel('إتمام عملية التحويل')
                ->form([
                        TextInput::make('quantity')
                            ->label('الكمية')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Textarea::make('notes')
                            ->label('السبب / ملاحظات')
                            ->placeholder('مثلاً: تلف الكرتونة الأصلية')
                            ->required(),
                    ])
                // لاحظ حقن InventoryService هنا
                ->action(function ($record, array $data, InventoryService $inventoryService) {
                    $branch = Filament::getTenant(); // الفرع الحالي
                    $user = auth()->user();

                    try {
                        // تنفيذ العملية بالكامل داخل Transaction لضمان الذرية (Atomicity)
                        DB::transaction(function () use ($record, $branch, $data, $user, $inventoryService) {

                            // 1. خصم من المخزون الجديد
                            $inventoryService->deductStockForBranch(
                                product: $record,
                                branch: $branch,
                                quantity: $data['quantity'],
                                condition: ItemCondition::New ,
                                notes: "تحويل إلى مستعمل: " . $data['notes'],
                                causer: $user
                            );

                            // 2. إضافة إلى المخزون المستعمل
                            $inventoryService->addStockForBranch(
                                product: $record,
                                branch: $branch,
                                quantity: $data['quantity'],
                                condition: ItemCondition::Used,
                                notes: "محول من الجديد: " . $data['notes'],
                                causer: $user
                            );
                        });

                        Notification::make()
                            ->title('تم التحويل بنجاح')
                            ->success()
                            ->body("تم نقل {$data['quantity']} قطعة إلى المخزون المستعمل بنجاح.")
                            ->send();

                    } catch (\Exception $e) {
                        // في حال فشل الخصم (مثلاً الكمية غير كافية) سيتم إمساك الخطأ هنا
                        Notification::make()
                            ->title('فشل في عملية التحويل')
                            ->danger()
                            ->body($e->getMessage())
                            ->persistent()
                            ->send();
                    }
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
