<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Reset cached roles and permissions
      app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      // Create permissions
      Permission::create(['name' => 'create post']);
      Permission::create(['name' => 'edit post']);
      Permission::create(['name' => 'delete post']);

      // Create roles and assign permissions
      $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
      $adminRole->givePermissionTo('create post', 'edit post', 'delete post');

      $customerRole = Role::create(['name' => 'customer', 'guard_name' => 'web']);

    }
}
