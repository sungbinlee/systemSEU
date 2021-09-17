<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
            'status' => 0
        ]);

        //create permissions
        Permission::create(['name' => 'add courses']);
        Permission::create(['name' => 'view student registration']);
        Permission::create(['name' => 'drop course']);

        //assign all permissions to Admin
        $role = Role::create(['name' => 'Administrator']);
        $role->givePermissionTo(Permission::all());

        //assign Role to a User
        $user = User::find(1);
        $user->assignRole('Administrator');
    }
}
