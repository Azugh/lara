<?php

use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 * userId
 * cartId
 * total_price
 * total_quantity
 *
 * ********************************
 *
 * show()
 * cart->All CartItems
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
//                $table->foreignId('cart_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('total_price', 10, 2);
            $table->integer('total_quantity');
            $table->text('shipping_address');
            $table->string('shipping_status')->default(ShippingStatus::PENDING->value);
            $table->string('payment_status')->default(PaymentStatus::PENDING->value);
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }


};
