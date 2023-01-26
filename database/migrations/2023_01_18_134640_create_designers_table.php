<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designers', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('house_id');
            $table->integer('worker_id');
            $table->decimal('price');
            $table->integer('taksit')->nullable();
            $table->text('kargo')->nullable();
            $table->date('verilis')->nullable();
            $table->date('teslimat')->nullable();
            $table->text('detay')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designers');
    }
};
