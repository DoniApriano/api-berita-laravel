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
        DB::unprepared('
            CREATE TRIGGER after_comment_reports_update
            AFTER UPDATE ON comment_reports
            FOR EACH ROW
            BEGIN
                INSERT INTO report_responds (comment_report_id, reporter_user_id, reported_user_id, comment_id, description, msg_for_reporter,msg_for_reported)
                VALUES (NEW.id, NEW.reporter_user_id, NEW.reported_user_id, NEW.comment_id, NEW.description, "Anda telah melakukan pelanggaran", "Terimakasih atas laporan yang telah diberikan pada");

                UPDATE comments
                SET status = "false"
                WHERE id = NEW.comment_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
