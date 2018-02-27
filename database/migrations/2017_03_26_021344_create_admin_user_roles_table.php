<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateAdminUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('admin_user_id')->default(0);
            $table->string('role');

            $table->timestamps();

            $table->index(['role'], 'role_admin_user_id_index');
            $table->index(['admin_user_id'], 'fk_admin_user_roles_admin_users1_idx');
        });

        $this->updateTimestampDefaultValue('admin_user_roles', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CreateAdminUserRolesTable');
    }
}
