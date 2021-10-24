<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Adaptar estas instucciones a los roles y permisos requerido por tu aplicación  */
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolRol1 = Role::create(['name' => 'Rol1']);
        $rolRol2 = Role::create(['name' => 'Rol2']);

        Permission::create(['name' => 'Admin'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Rol1'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'Rol2'])->syncRoles($rolAdmin, $rolRol2);

        Permission::create(['name' => 'crud.users.index'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.users.create'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.users.edit'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.users.destroy'])->syncRoles($rolAdmin);
        
        Permission::create(['name' => 'crud.roles.index'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.roles.create'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.roles.edit'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.roles.destroy'])->syncRoles($rolAdmin);
        
        Permission::create(['name' => 'crud.permissions.index'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.permissions.create'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.permissions.edit'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.permissions.destroy'])->syncRoles($rolAdmin);

        Permission::create(['name' => 'crud.rol1.index'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'crud.rol1.create'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'crud.rol1.edit'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'crud.rol1.destroy'])->syncRoles($rolAdmin);

        Permission::create(['name' => 'crud.rol2.index'])->syncRoles($rolAdmin, $rolRol2);
        Permission::create(['name' => 'crud.rol2.create'])->syncRoles($rolAdmin, $rolRol2);
        Permission::create(['name' => 'crud.rol2.edit'])->syncRoles($rolAdmin, $rolRol2);
        Permission::create(['name' => 'crud.rol2.destroy'])->syncRoles($rolAdmin);
    }
}
