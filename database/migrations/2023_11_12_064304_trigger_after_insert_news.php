<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER after_insert_news
            AFTER INSERT ON news
            FOR EACH ROW
            BEGIN
                INSERT INTO notifications (user_id, news_id, description,created_at)
                VALUES (NEW.user_id, NEW.id, 'Menambahkan berita', NOW());
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
