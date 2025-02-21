<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // No need to add the unique constraint here anymore
        // It was already added in the 2024_12_19_153203_create_historiques_table.php migration
    }

    public function down(): void
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'login_at']);
        });
    }
};
