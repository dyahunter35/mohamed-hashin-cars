<?php

return [
    'model_label' => 'منصرف',
    'plural_model_label' => 'المنصرفات',
    'navigation_label' => 'المنصرفات',
    'navigation_group' => 'الإدارة المالية',
    'fields' => [
        'type' => [
            'label' => 'النوع',
            'options' => [
                'food' => 'طعام',
                'salary' => 'راتب',
                'rent' => 'إيجار',
                'utility' => 'خدمات',
                'other' => 'أخرى',
            ],
        ],
        'description' => ['label' => 'الوصف'],
        'amount' => ['label' => 'المبلغ'],
        'date' => ['label' => 'التاريخ'],
        'created_at' => ['label' => 'تاريخ الإضافة'],
    ],

    'reports' => [
        'total_sales' => 'إجمالي المبيعات',
        'total_expenses' => 'إجمالي المنصرفات',
        'net_profit' => 'صافي الأرباح',
        'sales_description' => 'مجموع المبيعات المكتملة',
        'expenses_description' => 'مجموع كافة المنصرفات',
        'profit_description' => 'المبيعات - المنصرفات',
    ],
];
