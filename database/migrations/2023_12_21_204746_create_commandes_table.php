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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->dateTime('date');
            $table->decimal('total', 10, 2);
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('commande_produit', function (Blueprint $table) {
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('produit_id');
            $table->integer('quantite'); // Ajoutez le champ de quantité si nécessaire

            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_produit');
        Schema::dropIfExists('commandes');
    }
};