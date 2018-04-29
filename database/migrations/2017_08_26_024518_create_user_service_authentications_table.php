<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateUserServiceAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_service_authentications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id');

            $table->string('name')->default('');
            $table->string('email')->default('');

            $table->string('service')->default('');
            $table->string('service_id')->default('');
            $table->string('image_url')->default('');

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('user_service_authentications', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_service_authentications');
    }
}
