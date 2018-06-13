<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'copyright' => 'Copyright',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'receivables' => [
            'filter'     =>  'Filter Account Receivable',
            'management' =>  'Account Receivable Report',

            'table' =>  [
                'sales_invoice' =>  'Sales Invoice',
                'user'          =>  'Issuer',
                'customer'      =>  'Customer',
                'amount'        =>  'Amount Paid',
                'collection'    =>  'Date Paid',
                'created_at'    =>  'Date Created',
                'updated_at'    =>  'Date Updated',
                'deleted_at'    =>  'Date Deleted',
                'total'         =>  'Receivable total|Receivables total'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'code'          =>  'Expense Code',
                        'user'          =>  'Issuer',
                        'cause'         =>  'Cause',
                        'requested_by'  =>  'Issued to',
                        'amount'        =>  'Amount',
                        'created_at'    =>  'Date Created',
                        'updated_at'    =>  'Date Updated',
                        'deleted_at'    =>  'Date Deleted',
                    ]
                ]
            ],

            'show'  =>  'Expense :expense',
            'view'  =>  ':expense'
        ],

        'expenses' => [
            'view'       =>  'View Expenses',
            'list'       =>  'List of Expenses',
            'create'     =>  'Create Expense',
            'deleted'    =>  'Deleted Expenses',
            'management' =>  'Expense Management',

            'table' =>  [
                'code'          =>  'Expense Code',
                'user'          =>  'Issuer',
                'requested_by'  =>  'Issued to',
                'cause'         =>  'Cause',
                'amount'        =>  'Amount',
                'created_at'    =>  'Date Created',
                'deleted_at'    =>  'Date Deleted',
                'updated_at'     =>  'Date Updated',
                'total'         =>  'Expense total|Expenses total'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'code'          =>  'Expense Code',
                        'user'          =>  'Issuer',
                        'cause'         =>  'Cause',
                        'requested_by'  =>  'Issued to',
                        'amount'        =>  'Amount',
                        'created_at'    =>  'Date Created',
                        'updated_at'    =>  'Date Updated',
                        'deleted_at'    =>  'Date Deleted',
                    ]
                ]
            ],

            'show'  =>  'Expense :expense',
            'view'  =>  ':expense'
        ],

        'carts' => [
            'management'    =>  'Item Cart',
            'supplier'      =>  'Supplier',

            'table' =>  [
                'id'            =>  'Cart ID',
                'item'          =>  'Item Name',
                'quantity'      =>  'Quantity',
                'supplier'      =>  'Supplier Name',
                'status'        =>  'Status',
                'date_ordered'  =>  'Date Ordered'
            ]
        ],

        'transactions'  =>  [
            'edit'      =>  'Edit :transaction',
            'list'      =>  'Transaction\'s List',
            'view'      =>  'View :transaction',
            'deleted'   =>  'Deleted Transactions',

            'management'    =>  'Transaction Management',

            'table' =>  [
                'id'                =>  'Transaction ID',
                'user'              =>  'Issuer',
                'status'            =>  'Status',
                'created_at'        =>  'Date Issued',
                'updated_at'        =>  'Date Updated',
                'deleted_at'        =>  'Date Deleted',
                'total'             =>  'transaction total|transactions total'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'id'                =>  'Transaction ID',
                        'user'              =>  'Issuer',
                        'quantity'          =>  'Quantity',
                        'total_price'       =>  'Total Price',
                        'status'            =>  'Status',
                        'created_at'        =>  'Date Created',
                        'updated_at'        =>  'Date Updated',
                        'deleted_at'        =>  'Date Deleted',
                    ]
                ]
            ],

            'show'  =>  'Show :transaction',

            'item_transaction'  =>  [
                'quantity'          =>  'Quantity',
                'total_price'       =>  'Total Price',
            ],
        ],

        'customers'  =>  [
            'create'    =>  'Create Customer',
            'edit'      =>  'Edit :customer',
            'list'      =>  'Customer\'s List',
            'view'      =>  'View :customer',
            'deleted'   =>  'Deleted Customers',
            'order'     =>  'Customer Order',

            'management'    =>  'Customer Management',

            'table' =>  [
                'id'                =>  'ID',
                'name'              =>  'Customer Name',
                'email'             =>  'E-mail',
                'contact_number'    =>  'Contact Number',
                'address'           =>  'Address',
                'discount'          =>  'Discount',
                'credit_limit'      =>  'Credit Limit',
                'created_at'        =>  'Date Created',
                'updated_at'        =>  'Date Updated',
                'deleted_at'        =>  'Date Deleted',
                'total'             =>  'customer total|customers total'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'id'                =>  'ID',
                        'name'              =>  'Customer Name',
                        'email'             =>  'E-mail',
                        'contact_number'    =>  'Contact Number',
                        'address'           =>  'Address',
                        'discount'          =>  'Discount',
                        'credit_limit'      =>  'Credit Limit',
                        'created_at'        =>  'Date Created',
                        'updated_at'        =>  'Date Updated',
                        'deleted_at'        =>  'Date Deleted',
                    ]
                ]
            ],

            'show'  =>  'Show :customer'
        ],

        'items'  =>  [
            'create'    =>  'Create Item',
            'edit'      =>  'Edit :item',
            'list'      =>  'Item\'s List',
            'view'      =>  'View :item',
            'deleted'   =>  'Deleted Items',

            'management'    =>  'Item Management',

            'table' =>  [
                'id'                    =>  'ID',
                'name'                  =>  'Product Name',
                'supplier'              =>  'Supplier',
                'selling_price'         =>  'Selling Price',
                'buying_price'          =>  'Buying Price',
                'initial_weight_type'   =>  'Initial Weight Type',
                'initial_weight'        =>  'Initial Weight',
                'final_weight_type'     =>  'Final Weight Type',
                'final_weight'          =>  'Final Weight',
                'quantity'              =>  'Quantity',
                'stocks'                =>  'Stocks',
                'critical_stocks_level' =>  'Critical Stocks Level',
                'total_price'           =>  'Total Price',
                'created_at'            =>  'Date Created',
                'updated_at'            =>  'Date Updated',
                'deleted_at'            =>  'Date Deleted',
                'total'                 =>  'item total|items total',
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'id'                    =>  'ID',
                        'name'                  =>  'Product Name',
                        'supplier'              =>  'Supplier',
                        'selling_price'         =>  'Selling Price',
                        'buying_price'          =>  'Buying Price',
                        'initial_weight'        =>  'Initial Weight',
                        'initial_weight_type'   =>  'Initial Weight Type',
                        'final_weight'          =>  'Final Weight',
                        'final_weight_type'     =>  'Final Weight Type',
                        'stocks'                =>  'Stocks',
                        'critical_stocks_level' =>  'Critical Stocks Level',
                        'created_at'            =>  'Date Created',
                        'updated_at'            =>  'Date Updated',
                        'deleted_at'            =>  'Date Deleted',
                        'total'                 =>  'item total|items total',
                    ]
                ]
            ],

            'show'  =>  ':item'
        ],

        'suppliers'  =>  [
            'create'    =>  'Create Supplier',
            'edit'      =>  'Edit :supplier',
            'list'      =>  'Supplier\'s List',
            'view'      =>  'View :supplier',
            'deleted'   =>  'Deleted Suppliers',
            'cart'      =>  'Cart',

            'management'    =>  'Supplier Management',

            'table' =>  [
                'id'                        =>  'ID',
                'name'                      =>  'Company Name',
                'contact_person_first_name' =>  'First Name',
                'contact_person_last_name'  =>  'Last Name',
                'contact_person_full_name'  =>  'Full Name',
                'mobile_number'             =>  'Mobile Number',
                'telephone_number'          =>  'Telephone Number',
                'email'                     =>  'E-mail',
                'address'                   =>  'Address',
                'created_at'                =>  'Date Created',
                'updated_at'                =>  'Date Updated',
                'deleted_at'                =>  'Date Deleted',
                'total'                     =>  'supplier total|suppliers total',
                'queues'                    =>  'Ordered Items on Queue'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview',
                    'products'  =>  'Supplier Products',
                    'cart'      =>  'Product Cart',
                    'transaction'   =>  'Transaction Records',
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'name'                      =>  'Company Name',
                        'contact_person_first_name' =>  'Contact Person First Name',
                        'contact_person_last_name'  =>  'Contact Person Last Name',
                        'email'                     =>  'E-mail',
                        'address'                   =>  'Address',
                        'mobile_number'             =>  'Mobile Number',
                        'telephone_number'          =>  'Telephone Number',
                        'created_at'                =>  'Date Created',
                        'updated_at'                =>  'Date Updated',
                        'deleted_at'                =>  'Date Deleted'
                    ]
                ]
            ],

            'show'  =>  ':supplier'
        ],

        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'roles'          => 'Roles',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'update_password_button'           => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
