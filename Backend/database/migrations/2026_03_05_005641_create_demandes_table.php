<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->onDelete('cascade');
            $table->string('type_document');
            $table->enum('etat', ['En cours', 'Validé', 'Signé', 'Délivré'])->default('En cours');
            $table->string('signature_electronique')->nullable();
            $table->timestamp('date_traitement')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};