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
        Permission::create(['name' => 'Ver dashboard'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Listar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Crear role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Editar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Eliminar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Leer usuarios'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Editar usuarios'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Rol1'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'Rol2'])->syncRoles($rolAdmin, $rolRol2);
    }
}
