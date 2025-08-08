<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();

            // Seller Info
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();

            // Property Info
            $table->string('property_address');
            $table->string('property_city');
            $table->string('property_state');
            $table->string('property_zip');

            // Deal Type
            $table->enum('deal_type', ['Cash','Subject-To','Seller-Finance','Hybrid'])
                  ->default('Cash');

            // Core deal fields
            $table->unsignedInteger('asking_price');
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->decimal('bathrooms', 3, 1)->nullable();
            $table->unsignedInteger('square_footage')->nullable();

            // ROI / Entry inputs
            $table->unsignedInteger('arv')->nullable();
            $table->unsignedInteger('estimated_repairs')->nullable();
            $table->unsignedInteger('back_taxes')->nullable();
            $table->unsignedInteger('title_liens')->nullable();
            $table->unsignedInteger('closing_costs')->nullable();
            $table->unsignedInteger('transaction_coordinator_fees')->nullable();

            // Creative fields
            $table->unsignedInteger('mortgage_balance')->nullable();
            $table->unsignedInteger('monthly_piti')->nullable();
            $table->unsignedInteger('arrears')->nullable();
            $table->unsignedInteger('cash_to_seller')->nullable();
            $table->unsignedInteger('down_payment')->nullable();
            $table->unsignedInteger('monthly_payment_to_seller')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->unsignedInteger('term_length')->nullable();
            $table->boolean('balloon')->default(false);

            // **Use smallInteger here so 0–10 will always fit—and if you ever need more, you can bump it up further.**
            $table->unsignedSmallInteger('balloon_years')->nullable();

            // Extra notes
            $table->text('additional_details')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
