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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('clients');
            $table->foreignId('receiver_id')->constrained('clients');
            $table->decimal('weight', 5, 2);
            $table->decimal('price', 9, 2);
            $table->enum('status', ['pending', 'in_transit', 'delivered', 'at_office'])->default('pending');
            $table->foreignId('registered_by')->nulable()->constrained('employees');
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
