<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('label', 255);
            $table->string('company', 255);
            $table->char('inspection_status', 1);
            $table->text('packing_list');
            $table->integer('items_count');
            $table->timestamp('arrival_at');
            $table->timestamp('departure_at')->nullable();
            $table->float('weight');
            $table->string('origin');
            $table->string('destination');
            $table->float('capacity');
            $table->integer('contents_price_cents')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
