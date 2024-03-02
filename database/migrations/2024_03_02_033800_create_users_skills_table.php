<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\DateTimeHelper;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        Schema::create('users_skills', function (Blueprint $table) use ($time) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->dateTime('created_at')->default($time);
            $table->dateTime('updated_at')->default($time);
            $table->primary(['user_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_skills');
    }
};
