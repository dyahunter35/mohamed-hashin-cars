<?php
return [
    'navigation' => [
        'group' => 'إدارة الاسبيرات',
        'label' => 'صنف الاسبير',
        'plural_label' => 'صنف الاسبير',
        'model_label' => 'صنف الاسبير',
    ],
    'breadcrumbs' => [
        'index' => 'صنف الاسبير',
        'create' => 'إضافة تصنيف',
        'edit' => 'تعديل تصنيف',
    ],
    'fields' => [
        'name' => [
            'label' => 'الاسم',
            'placeholder' => 'أدخل اسم صنف الاسبير',
        ],
        'slug' => [
            'label' => 'الرابط المختصر',
            'placeholder' => 'يتم إنشاؤه تلقائياً من الاسم',
        ],
        'parent_id' => [
            'label' => 'صنف الاسبير',
            'placeholder' => 'اختر صنف الاسبير',
        ],
        'is_visible' => [
            'label' => 'مرئي للعملاء',
            'placeholder' => '',
        ],
        'description' => [
            'label' => 'الوصف',
            'placeholder' => 'أدخل وصف صنف الاسبير',
        ],
        'created_at' => [
            'label' => 'تاريخ الإنشاء',
            'placeholder' => '',
        ],
        'updated_at' => [
            'label' => 'آخر تعديل',
            'placeholder' => '',
        ],
    ],
    'widgets' => [
        'stats' => [
            'label' => 'إحصائيات التصنيفات',
            'count' => 'إجمالي التصنيفات',
            'visible' => 'التصنيفات المرئية',
            'hidden' => 'التصنيفات المخفية',
        ],
    ],
];
