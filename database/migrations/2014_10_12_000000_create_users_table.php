<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            //extend
            $table->string('roles')->default('USER'); //roles (ADMIN, USER)
            $table->string('phone')->nullable();
            $table->string('username')->unique()->nullable();
            
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'Chaidar Saad',
                'email' => 'chaidarsaad55@gmail.com',
                'password' => Hash::make('aaaaaaaa'),
                'roles' => 'ADMIN',
                'phone' => '085156406238',
                'username' => 'chaidarsaad'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
