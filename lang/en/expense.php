<?php

// to english
return [
    'model_label' => 'Expense',
    'plural_model_label' => 'Expenses',
    'navigation_label' => 'Expenses',
    'navigation_group' => 'Financial Management',
    'fields' => [
        'type' =>
            [
                'label' => 'Type',
                'options' => [
                    'food' => 'Food',
                    'salary' => 'Salary',
                    'rent' => 'Rent',
                    'utility' => 'Utility',
                    'other' => 'Other',
                ],
            ],

        'description' => ['label' => 'Description'],
        'amount' => ['label' => 'Amount'],
        'date' => ['label' => 'Date'],
        'created_at' => ['label' => 'Created At'],
    ],

    'reports' => [
        'total_sales' => 'Total Sales',
        'total_expenses' => 'Total Expenses',
        'net_profit' => 'Net Profit',
        'sales_description' => 'Total Completed Sales',
        'expenses_description' => 'Total Expenses',
        'profit_description' => 'Sales - Expenses',
    ],
];
