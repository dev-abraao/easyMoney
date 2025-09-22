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
        Schema::create('user_expenses', function (Blueprint $table) {
            $table->Uuid('id')->primary();;
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('expense_type_id')->constrained('expense_types')->onDelete('cascade');
            $table->string('description')->nullable();;
            $table->decimal('amount', 19, 2);
            $table->foreignUuid('card_id')->nullable()->constrained('cards')->onDelete('set null');
            $table->date('date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_expenses');
    }
};
