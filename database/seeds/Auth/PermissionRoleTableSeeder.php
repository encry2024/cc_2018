<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin      = Role::create(['name' => config('access.users.admin_role')]);
        $executive  = Role::create(['name' => 'executive']);
        $user       = Role::create(['name' => config('access.users.default_role')]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);
        # Create Cart Permission
        Permission::create(['name' => 'view cart']);
        Permission::create(['name' => 'update cart']);
        # Create Item Permission
        Permission::create(['name' => 'view item']);
        Permission::create(['name' => 'store item']);
        Permission::create(['name' => 'edit item']);
        Permission::create(['name' => 'restore item']);
        Permission::create(['name' => 'delete item']);
        Permission::create(['name' => 'force delete item']);
        # Create Supplier Permission
        Permission::create(['name' => 'view supplier']);
        Permission::create(['name' => 'store supplier']);
        Permission::create(['name' => 'edit supplier']);
        Permission::create(['name' => 'restore supplier']);
        Permission::create(['name' => 'delete supplier']);
        Permission::create(['name' => 'force delete supplier']);
        # Create Customer Permission
        Permission::create(['name' => 'view customer']);
        Permission::create(['name' => 'store customer']);
        Permission::create(['name' => 'edit customer']);
        Permission::create(['name' => 'restore customer']);
        Permission::create(['name' => 'delete customer']);
        Permission::create(['name' => 'force delete customer']);
        # Create Order Permission
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'store order']);
        Permission::create(['name' => 'edit order']);
        Permission::create(['name' => 'update order']);
        Permission::create(['name' => 'restore order']);
        Permission::create(['name' => 'delete order']);
        Permission::create(['name' => 'force delete order']);
        Permission::create(['name' => 'add payment']);
        # Create Expense Permission
        Permission::create(['name' => 'view expenses']);
        Permission::create(['name' => 'store expense']);
        Permission::create(['name' => 'edit expense']);
        Permission::create(['name' => 'update expense']);
        Permission::create(['name' => 'restore expense']);
        Permission::create(['name' => 'delete expense']);
        Permission::create(['name' => 'force delete expense']);

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('view backend');
        # Give admin permission to Cart
        $admin->givePermissionTo('view cart');
        $admin->givePermissionTo('update cart');
        # Give admin all permission to Item
        $admin->givePermissionTo('view item');
        $admin->givePermissionTo('store item');
        $admin->givePermissionTo('edit item');
        $admin->givePermissionTo('restore item');
        $admin->givePermissionTo('delete item');
        $admin->givePermissionTo('force delete item');
        # Give admin all permission to Supplier
        $admin->givePermissionTo('view supplier');
        $admin->givePermissionTo('store supplier');
        $admin->givePermissionTo('edit supplier');
        $admin->givePermissionTo('restore supplier');
        $admin->givePermissionTo('delete supplier');
        $admin->givePermissionTo('force delete supplier');
        # Give admin all permission to Customer
        $admin->givePermissionTo('view customer');
        $admin->givePermissionTo('store customer');
        $admin->givePermissionTo('edit customer');
        $admin->givePermissionTo('restore customer');
        $admin->givePermissionTo('delete customer');
        $admin->givePermissionTo('force delete customer');
        # Give admin all permission to Order
        $admin->givePermissionTo('view orders');
        $admin->givePermissionTo('store order');
        $admin->givePermissionTo('edit order');
        $admin->givePermissionTo('update order');
        $admin->givePermissionTo('restore order');
        $admin->givePermissionTo('delete order');
        $admin->givePermissionTo('force delete order');
        $admin->givePermissionTo('add payment');
        # Give admin all permission to Expense
        $admin->givePermissionTo('view expenses');
        $admin->givePermissionTo('store expense');
        $admin->givePermissionTo('edit expense');
        $admin->givePermissionTo('update expense');
        $admin->givePermissionTo('restore expense');
        $admin->givePermissionTo('delete expense');
        $admin->givePermissionTo('force delete expense');

        // Assign Permissions to other Roles
        $executive->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
