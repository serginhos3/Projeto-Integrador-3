<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('noivos', function (Blueprint $table) {
        $table->unsignedBigInteger('evento_id')->nullable()->after('id');
        $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('noivos', function (Blueprint $table) {
        $table->dropForeign(['evento_id']);
        $table->dropColumn('evento_id');
    });
}

};
