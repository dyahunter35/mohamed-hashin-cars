<?php

return [
    'navigation' => [
        'group' => 'Spare Parts Management',
        'label' => 'Spare Part',
        'plural_label' => 'Spare Parts',
        'model_label' => 'Spare Part',
    ],
    'breadcrumbs' => [
        'index' => 'Spare Parts',
        'create' => 'Add Spare Part',
        'edit' => 'Edit Spare Part',
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
            'placeholder' => 'Enter spare part name',
        ],
        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'Enter slug',
        ],
        'description' => [
            'label' => 'Description',
            'placeholder' => 'Enter spare part description',
        ],
        'price' => [
            'label' => 'Price',
            'placeholder' => 'Enter price',
        ],
        'old_price' => [
            'label' => 'Compare Price',
            'placeholder' => 'Enter compare price',
        ],
        'cost' => [
            'label' => 'Item Cost',
            'placeholder' => 'Enter item cost',
            'helper' => 'Customers will not see this price.',
        ],
        'brand' => [
            'label' => 'Brand',
            'placeholder' => 'Enter brand',
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
            'placeholder' => 'Enter safety stock',
            'helper' => 'Safety stock is the minimum level that alerts you when the product is about to run out.',
        ],
        'backorder' => [
            'label' => 'This product is returnable',
        ],
        'requires_shipping' => [
            'label' => 'This product requires shipping',
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
            'old_price' => 'Compare Price',
            'price' => 'Price',
            'cost' => 'Item Cost',
            'qty' => 'Quantity',
            'security_stock' => 'Safety Stock',
            'is_visible' => 'Visibility',
            'featured' => 'Featured',
            'backorder' => 'Pre-order',
            'requires_shipping' => 'Requires Shipping',
            'published_at' => 'Publish Date',
        ],
    ],
    'actions' => [
        'report' => [
            'label' => 'All Branches Report'
        ],
        'branch_report' => [
            'label' => 'This Branch Report'
        ],
        'print' => [
            'label' => 'Print Report',
        ],
        'refresh' => [
            'label' => 'Refresh Quantities',
        ],
        'delete' => [
            'notification' => 'Hey, don’t be mean, leave some records for others to play with!',
        ],
    ],
    'reports' => [
        'sales_by_condition' => [
            'label' => 'Sales by Condition Report',
            'model_label' => 'Sales by Condition Report',
            'navigation' => [
                'group' => 'Reports',
                'label' => 'Sales by Condition Report',
                'plural_label' => 'Sales by Condition Reports',
            ],
        ],
        'sales_and_payments' => [
            'label' => 'Sales and Collections Report',
            'model_label' => 'Sales and Collections Report',
            'navigation' => [
                'group' => 'Reports',
                'label' => 'Sales and Collections Report',
                'plural_label' => 'Sales and Collections Reports',
            ],
            'filters' => [
                'payment_status' => [
                    'label' => 'Payment Status',
                    'options' => [
                        'all' => 'All',
                        'paid' => 'Fully Paid',
                        'debt' => 'Debt (Remaining)',
                    ],
                ],
            ],
        ],
    ],
];
