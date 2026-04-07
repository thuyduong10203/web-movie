<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('movie')) {
            return;
        }

        Schema::table('movie', function (Blueprint $table) {
            if (!Schema::hasColumn('movie', 'status')) {
                $table->tinyInteger('status')->default(1)->after('updated_at');
            }
        });
    }

    public function down()
    {
        if (!Schema::hasTable('movie')) {
            return;
        }

        Schema::table('movie', function (Blueprint $table) {
            if (Schema::hasColumn('movie', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
