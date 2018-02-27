<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('profile_image_id')->default(0);

            $table->rememberToken();
            $table->timestamps();

            $table->index(['email'], 'email_index');
            $table->index(['profile_image_id'], 'fk_users_files1_idx');
        });

        $this->updateTimestampDefaultValue('users', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CreateUsersTable');
    }
}
