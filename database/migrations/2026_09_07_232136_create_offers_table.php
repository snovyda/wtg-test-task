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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('CASCADE');
            $table->foreignId('import_id')->constrained('imports')->onDelete('CASCADE');
            $table->string('external_id');
            $table->foreignId('property_id')->nullable()->constrained('property')->onDelete('SET NULL');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('max_guests');
            $table->decimal('price', total: 10, places: 2);
            $table->string('currency');
            $table->integer('available_units');
            $table->timestamp('expires_at');
            $table->timestamps();


            $table->unique(['supplier_id', 'external_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
