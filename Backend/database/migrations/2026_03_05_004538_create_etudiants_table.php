<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('numero_apogee')->unique();
            $table->string('cne')->unique();
            $table->string('cni')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance')->nullable();
            $table->string('filiere');
            $table->string('cycle');
            $table->string('niveau');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};