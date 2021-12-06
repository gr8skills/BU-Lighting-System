<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTableSeederForLights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            [
                'id'         => '17',
                'title'      => 'light_create',
                'created_at' => '2021-11-01 14:00:26',
                'updated_at' => '2019-11-01 14:00:26',
            ],
            [
                'id'         => '18',
                'title'      => 'light_edit',
                'created_at' => '2019-09-10 14:00:26',
                'updated_at' => '2019-09-10 14:00:26',
            ],
            [
                'id'         => '19',
                'title'      => 'light_management_access',
                'created_at' => '2021-11-01 14:00:26',
                'updated_at' => '2019-11-01 14:00:26',
            ],
            [
                'id'         => '20',
                'title'      => 'light_show',
                'created_at' => '2019-09-10 14:00:26',
                'updated_at' => '2019-09-10 14:00:26',
            ],
            [
                'id'         => '21',
                'title'      => 'light_delete',
                'created_at' => '2019-09-10 14:00:26',
                'updated_at' => '2019-09-10 14:00:26',
            ],
            [
                'id'         => '21',
                'title'      => 'light_access',
                'created_at' => '2019-09-10 14:00:26',
                'updated_at' => '2019-09-10 14:00:26',
            ],
        ];
        Permission::insert($permissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_table_seeder_for_lights');
    }
}
