<?php namespace ExtendUsers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateExtendedUserFields extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('organization')->nullable();
            $table->string('city_state')->nullable();
            $table->text('reason_for_joining')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn([
                'organization',
                'city_state',
                'reason_for_joining'
            ]);
        });
    }
} 