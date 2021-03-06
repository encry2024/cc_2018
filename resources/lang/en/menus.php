<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'expenses'  =>  [
            'title'     =>  'Expense',
            'all'       =>  'Expenses',
            'main'      =>  'Expense',
            'create'    =>  'Create Expense',
            'edit'      =>  'Edit Expense',
            'deleted'   =>  'Deleted Expenses',
        ],

        'carts'  =>  [
            'title'     =>  'Item Cart',

            'all'       =>  'Item Cart',
            'main'      =>  'Cart'
        ],

        'transactions'  =>  [
            'title'     =>  'Transaction Management',

            'all'       =>  'All Transactions',
            'create'    =>  'Create Transaction',
            'edit'      =>  'Edit Transaction',
            'deleted'   =>  'Deleted Transactions',
            'main'      =>  'Transactions'
        ],

        'customers'  =>  [
            'title'     =>  'Customer Management',

            'all'       =>  'All Customers',
            'create'    =>  'Create Customer',
            'edit'      =>  'Edit Customer',
            'deleted'   =>  'Deleted Customers',
            'main'      =>  'Customers'
        ],

        'items'  =>  [
            'title'     =>  'Item Management',

            'all'       =>  'All Items',
            'create'    =>  'Create Item',
            'edit'      =>  'Edit Item',
            'deleted'   =>  'Deleted Items',
            'main'      =>  'Items'
        ],

        'suppliers'  =>  [
            'title' =>  'Supplier Management',

            'all'       =>  'All Suppliers',
            'create'    =>  'Create Supplier',
            'edit'      =>  'Edit Supplier',
            'deleted'   =>  'Deleted Suppliers',
            'main'      =>  'Suppliers'
        ],

        'access' => [
            'title' => 'Access Management',

            'roles' => [
                'all'        => 'All Roles',
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'All Users',
                'change-password' => 'Change Password',
                'create'          => 'Create User',
                'deactivated'     => 'Deactivated Users',
                'deleted'         => 'Deleted Users',
                'edit'            => 'Edit User',
                'main'            => 'Users',
                'view'            => 'View User',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' =>  'Dashboard',
            'supplier'  =>  'Suppliers',
            'item'      =>  'Items',
            'customer'  =>  'Customers',
            'transaction'   =>  'Transactions',
            'general'   =>  'General',
            'system'    =>  'System',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fr'    => 'French',
            'he'    => 'Hebrew',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'no'    => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
        ],
    ],
];
