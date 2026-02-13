<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    'navigation' => [
        'group' => 'Spare Parts Management',
        'label' => 'Category',
        'plural_label' => 'Categories',
        'model_label' => 'Category',
    ],

    /*
    |--------------------------------------------------------------------------
    | Breadcrumbs
    |--------------------------------------------------------------------------
    */

    'breadcrumbs' => [
        'index' => 'Categories',
        'create' => 'Create Category',
        'edit' => 'Edit Category',
    ],

    /*
    |--------------------------------------------------------------------------
    | Fields
    |--------------------------------------------------------------------------
    */

    'fields' => [

        'name' => [
            'label' => 'Name',
            'placeholder' => 'Enter category name',
        ],

        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'Automatically generated from name',
        ],

        'parent_id' => [
            'label' => 'Parent Category',
            'placeholder' => 'Select parent category',
        ],

        'is_visible' => [
            'label' => 'Visible to Customers',
            'placeholder' => '',
        ],

        'description' => [
            'label' => 'Description',
            'placeholder' => 'Enter category description',
        ],

        'created_at' => [
            'label' => 'Created At',
            'placeholder' => '',
        ],

        'updated_at' => [
            'label' => 'Last Updated',
            'placeholder' => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    */

    'widgets' => [
        'stats' => [
            'label' => 'Category Statistics',
            'count' => 'Total Categories',
            'visible' => 'Visible Categories',
            'hidden' => 'Hidden Categories',
        ],
    ],

];
