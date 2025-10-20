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
        Schema::create('expense_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_expense_id')->constrained('user_expenses')->onDelete('cascade');
            $table->integer('installments')->default(1);
            $table->decimal('installment_amount', 19, 2);
            $table->integer('remaining_installments');
            $table->date('next_due_date');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_infos');
    }
};
