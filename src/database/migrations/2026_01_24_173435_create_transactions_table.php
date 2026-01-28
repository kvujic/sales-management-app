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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('transaction_date');
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete(); //取引があるカテゴリは消せない
            $table->unsignedInteger('amount');
            $table->unsignedTinyInteger('payment_method')->default(1); //1=cash　2=credit_card 3=bank_transfer..と後ほど増やせるように
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->restrictOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');

            //検索・集計用
            $table->index(['user_id', 'transaction_date']);
            $table->index(['user_id', 'category_id']);
            $table->index(['user_id', 'vendor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
