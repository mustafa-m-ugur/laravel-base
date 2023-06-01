<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    protected $toTruncate = ['roles'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        Model::reguard();

        $permissions = array(
            [
                'name' => 'Admin', // full paket
                'guard' => 'backend',
                'permissions' => json_encode([
                    'role_index' => true, 'role_create' => true, 'role_edit' => true, 'role_destroy' => true,
                    'home_view' => true,
                ])
            ],


        );

        foreach ($permissions as $permission) {
            Role::create([
                'name' => $permission['name'],
                'slug' => $permission['name'],
                'guard_name' => $permission['guard'],
                'permissions' => $permission['permissions']
            ]);
        }
    }
}
