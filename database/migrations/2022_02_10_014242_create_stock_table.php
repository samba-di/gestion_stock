<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->date_time('date_entree');
            $table->date_time('date_sortie')->nullable();
            $table->integer('quantite_entree');
            $table->integer('quantite_sortie')->default(0);
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
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
        Schema::dropIfExists('stock');
    }
};
