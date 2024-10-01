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
        Schema::create('partner_sells', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->decimal('amount', 8, 2);
            $table->decimal('comission_amount', 8, 2);
            $table->json('payload');
            $table->enum('status', ['APPROVED', 'PENDING', 'DENIED', 'CANCELED']);
            $table->string('currency');
            $table->timestamp('date_transaction');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_sells');
    }
};
