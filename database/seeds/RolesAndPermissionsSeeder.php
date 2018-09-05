<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Roles Permissions
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        // Permissions Permissions
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        // Buildings
        Permission::create(['name' => 'create buildings']);
        Permission::create(['name' => 'read buildings']);
        Permission::create(['name' => 'update buildings']);
        Permission::create(['name' => 'delete buildings']);

        // Rooms
        Permission::create(['name' => 'create rooms']);
        Permission::create(['name' => 'read rooms']);
        Permission::create(['name' => 'update rooms']);
        Permission::create(['name' => 'delete rooms']);

        // Items
        Permission::create(['name' => 'create items']);
        Permission::create(['name' => 'read items']);
        Permission::create(['name' => 'update items']);
        Permission::create(['name' => 'delete items']);

        // Reports
        Permission::create(['name' => 'create reports']);
        Permission::create(['name' => 'read reports']);
        Permission::create(['name' => 'update reports']);
        Permission::create(['name' => 'delete reports']);

        $role = Role::create([
          'name' => 'organisation admin', 'level' => 6, 'description' => 'In charge of an organisation.'
        ]);
        $role->givePermissionTo('create buildings');
        $role->givePermissionTo('read buildings');
        $role->givePermissionTo('update buildings');
        $role->givePermissionTo('delete buildings');

        $role->givePermissionTo('create rooms');
        $role->givePermissionTo('read rooms');
        $role->givePermissionTo('update rooms');
        $role->givePermissionTo('delete rooms');

        $role->givePermissionTo('create items');
        $role->givePermissionTo('read items');
        $role->givePermissionTo('update items');
        $role->givePermissionTo('delete items');

        $role->givePermissionTo('create reports');
        $role->givePermissionTo('read reports');
        $role->givePermissionTo('update reports');
        $role->givePermissionTo('delete reports');

        $role = Role::create([
          'name' => 'organisation user', 'level' => 4, 'description' => 'General organisation user.'
        ]);
        $role->givePermissionTo('create buildings');
        $role->givePermissionTo('read buildings');
        $role->givePermissionTo('update buildings');

        $role->givePermissionTo('create rooms');
        $role->givePermissionTo('read rooms');
        $role->givePermissionTo('update rooms');

        $role->givePermissionTo('create items');
        $role->givePermissionTo('read items');
        $role->givePermissionTo('update items');

        $role->givePermissionTo('create reports');
        $role->givePermissionTo('read reports');
        $role->givePermissionTo('update reports');
    }
}
