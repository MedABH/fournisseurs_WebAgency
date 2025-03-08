<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameTiersColumnsInSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Change the column name using raw SQL with the CHANGE command
        DB::statement('ALTER TABLE settings CHANGE addedToday addedToday INT DEFAULT 0');
        DB::statement('ALTER TABLE settings CHANGE deletedToday deletedToday INT DEFAULT 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the column names
        DB::statement('ALTER TABLE settings CHANGE addedToday addedToday INT DEFAULT 0');
        DB::statement('ALTER TABLE settings CHANGE deletedToday deletedToday INT DEFAULT 0');
    }
}
