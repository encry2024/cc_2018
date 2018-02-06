<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'transactions' =>  [
            'created'   =>  'Transaction \':transaction\' was successfully created.',
            'deleted'   =>  'Transaction \':transaction\' was successfully deleted.',
            'updated'   =>  'Transaction \':transaction\' was successfully updated',
            'restored'  =>  'Transaction \':transaction\' was successfully restored.',
            'deleted_permanently'   =>  'Transaction \':transaction\' was successfully deleted permanently.',
        ],

        'customers' =>  [
            'created'   =>  'Customer \':customer\' was successfully created.',
            'deleted'   =>  'Customer \':customer\' was successfully deleted.',
            'updated'   =>  'Customer \':customer\' was successfully updated',
            'restored'  =>  'Customer \':customer\' was successfully restored.',
            'deleted_permanently'   =>  'Customer \':customer\' was successfully deleted permanently.',
        ],

        'items' =>  [
            'created'   =>  'Item \':item\' was successfully created.',
            'deleted'   =>  'Item \':item\' was successfully deleted.',
            'updated'   =>  'Item \':item\' was successfully updated',
            'restored'  =>  'Item \':item\' was successfully restored.',
            'deleted_permanently'   =>  'Item \':item\' was successfully deleted permanently.',
        ],

        'suppliers' =>  [
            'created'   =>  'Supplier \':supplier\' was successfully created.',
            'deleted'   =>  'Supplier \':supplier\' was successfully deleted.',
            'updated'   =>  'Supplier \':supplier\' was successfully updated',
            'restored'  =>  'Supplier \':supplier\' was successfully restored.',
            'deleted_permanently'   =>  'Supplier \':supplier\' was successfully deleted permanently.',
        ],

        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email'  => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed'              => 'The user was successfully confirmed.',
            'created'             => 'The user was successfully created.',
            'deleted'             => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored'            => 'The user was successfully restored.',
            'session_cleared'      => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated'             => 'The user was successfully updated.',
            'updated_password'    => "The user's password was successfully updated.",
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
