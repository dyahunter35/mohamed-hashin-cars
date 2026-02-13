<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    'navigation' => [
        'group' => 'Spare Parts Management',
        'label' => 'Brand',
        'plural_label' => 'Brands',
        'model_label' => 'Brand',
    ],

    /*
    |--------------------------------------------------------------------------
    | Breadcrumbs
    |--------------------------------------------------------------------------
    */

    'breadcrumbs' => [
        'index' => 'Brands',
        'create' => 'Create Brand',
        'edit' => 'Edit Brand',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sections
    |--------------------------------------------------------------------------
    */

    'sections' => [
        'basic_information' => [
            'label' => 'Basic Information',
        ],

        'images' => [
            'label' => 'Images',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Fields
    |--------------------------------------------------------------------------
    */

    'fields' => [

        'name' => [
            'label' => 'Name',
            'placeholder' => 'Enter brand name',
        ],

        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'Enter slug',
        ],

        'logo' => [
            'label' => 'Brand Logo',
        ],

        'is_active' => [
            'label' => 'Active',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    'actions' => [
        'create' => 'Create Brand',
        'edit' => 'Edit',
        'delete' => 'Delete',
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'created' => 'Brand created successfully.',
        'updated' => 'Brand updated successfully.',
        'deleted' => 'Brand deleted successfully.',
    ],

];
