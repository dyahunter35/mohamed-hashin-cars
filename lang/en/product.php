<?php

return [

    'navigation' => [
        'group' => 'Spare Parts Management',
        'label' => 'Product',
        'plural_label' => 'Products',
        'model_label' => 'Product',
    ],

    'breadcrumbs' => [
        'index' => 'Products',
        'create' => 'Create Product',
        'edit' => 'Edit Product',
    ],

    'sections' => [
        'images' => [
            'label' => 'Images',
        ],
        'pricing' => [
            'label' => 'Pricing',
        ],
        'inventory' => [
            'label' => 'Inventory',
        ],
        'shipping' => [
            'label' => 'Shipping',
        ],
        'status' => [
            'label' => 'Status',
        ],
        'associations' => [
            'label' => 'Associations',
        ],
    ],

    'fields' => [

        'name' => [
            'label' => 'Name',
            'placeholder' => 'Enter product name',
        ],

        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'Enter slug',
        ],

        'description' => [
            'label' => 'Description',
            'placeholder' => 'Enter product description',
        ],

        'price' => [
            'label' => 'Price',
            'placeholder' => 'Enter price',
        ],

        'old_price' => [
            'label' => 'Compare-at Price',
            'placeholder' => 'Enter comparison price',
        ],

        'cost' => [
            'label' => 'Cost per Item',
            'placeholder' => 'Enter product cost',
            'helper' => 'This price will not be visible to customers.',
        ],

        'sku' => [
            'label' => 'SKU (Stock Keeping Unit)',
            'placeholder' => 'Enter SKU',
        ],

        'barcode' => [
            'label' => 'Barcode (ISBN, UPC, GTIN, etc.)',
            'placeholder' => 'Enter barcode',
        ],

        'qty' => [
            'label' => 'Quantity',
            'placeholder' => 'Enter quantity',
        ],

        'security_stock' => [
            'label' => 'Safety Stock',
            'placeholder' => 'Enter safety stock level',
            'helper' => 'Safety stock is the minimum quantity that triggers a low-stock alert.',
        ],

        'backorder' => [
            'label' => 'Allow Backorders',
        ],

        'requires_shipping' => [
            'label' => 'Requires Shipping',
        ],

        'is_visible' => [
            'label' => 'Visible',
            'helper' => 'This product will be hidden from all sales channels.',
        ],

        'published_at' => [
            'label' => 'Availability Date',
        ],

        'branch' => [
            'label' => 'Branch',
            'placeholder' => 'Select branches',
        ],

        'category' => [
            'label' => 'Category',
            'placeholder' => 'Select a category',
        ],
    ],

    'columns' => [

        'image' => [
            'label' => 'Image',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'category' => [
            'label' => 'Category',
        ],

        'visibility' => [
            'label' => 'Visibility',
        ],

        'price' => [
            'label' => 'Price',
        ],

        'sku' => [
            'label' => 'SKU',
        ],

        'quantity' => [
            'label' => 'This Branch',
        ],

        'all_branches_quantity' => [
            'label' => 'All Branches',
        ],

        'branch' => [
            'label' => 'Branches',
        ],

        'security_stock' => [
            'label' => 'Safety Stock',
        ],

        'publish_date' => [
            'label' => 'Publish Date',
        ],
    ],

    'filters' => [

        'constraints' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'sku' => 'SKU (Stock Keeping Unit)',
            'barcode' => 'Barcode (ISBN, UPC, GTIN, etc.)',
            'description' => 'Description',
            'old_price' => 'Compare-at Price',
            'price' => 'Price',
            'cost' => 'Cost per Item',
            'qty' => 'Quantity',
            'security_stock' => 'Safety Stock',
            'is_visible' => 'Visibility',
            'featured' => 'Featured',
            'backorder' => 'Backorder',
            'requires_shipping' => 'Requires Shipping',
            'published_at' => 'Publish Date',
        ],
    ],

    'actions' => [

        'report' => [
            'label' => 'All Branches Report',
        ],

        'branch_report' => [
            'label' => 'This Branch Report',
        ],

        'brand' => [
            'label' => 'Brand',
            'placeholder' => 'Select a brand',
        ],

        'print' => [
            'label' => 'Print Report',
        ],

        'refresh' => [
            'label' => 'Refresh Quantities',
        ],

        'delete' => [
            'notification' => 'Easy there! Leave some records for others to manage 😉',
        ],
    ],

];
