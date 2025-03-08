<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSettingsTableForTiersTracking extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Remove this line, since 'previousTiersCount' already exists
            // $table->integer('previousTiersCount')->default(0);

            // Only add the new columns
            $table->integer('tiersAddedToday')->default(0)->after('previousTiersCount');
            $table->integer('tiersDeletedToday')->default(0)->after('tiersAddedToday');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('addedToday');
            $table->dropColumn('deletedToday');
        });
    }
}
