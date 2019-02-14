<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Marks;

class AddUserRelationToMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::create(['id' => '337438577']);
        Schema::table('marks', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable()->after('id');
        });
        if (Marks::exists()) {
            Marks::query()->update(['user_id' => $user->id]);
        }
        Schema::table('marks', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->removeColumn('user_id');
        });
    }
}
