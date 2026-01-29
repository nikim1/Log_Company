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
        Schema::create('shipment_receivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
            $table->enum('delivery_type', ['office', 'address']);
            $table->foreignId('office_id')->nullable()->constrained('offices');  // if shipment is to an office
            $table->foreignId('address_id')->nullable()->constrained('client_addresses');  // if shipment is to an address
            $table->foreignId('courier_id')->nullable()->constrained('employees'); // if shipment is to an address
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_receivers');
    }
};
