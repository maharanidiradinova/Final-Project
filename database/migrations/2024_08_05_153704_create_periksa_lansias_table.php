<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaLansiasTable extends Migration
{
    public function up()
    {
        Schema::create('periksa_lansias', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('lansia_id')->constrained('lansias')->onDelete('cascade');
            $table->decimal('berat', 5, 2);
            $table->string('tekanan_darah');
            $table->decimal('lingkar_perut', 5, 2);
            $table->timestamps();
        });
        
        
    }

    public function down()
    {
        Schema::dropIfExists('periksa_lansias');
    }
}
