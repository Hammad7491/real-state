<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerCriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('buyer_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained()->onDelete('cascade');
            $table->string('field');
            $table->string('operator');
            $table->string('value');
            $table->unsignedTinyInteger('weight')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyer_criteria');
    }
}
