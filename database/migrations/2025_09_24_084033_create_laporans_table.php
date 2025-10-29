<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_laporans_table.php
use Illuminate\Database\Migrations\Migration;                    
use Illuminate\Database\Schema\Blueprint;                       
use Illuminate\Support\Facades\Schema;                           

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) { 
            $table->id();                                       
            $table->foreignId('pelapor_id')                      
                  ->constrained('users')                       
                  ->cascadeOnDelete();                          
            $table->string('judul');                            
            $table->text('detail');                              
            $table->string('foto_path')->nullable();            
            // si)
            $table->enum('status', ['proses', 'selesai'])->default('proses');         
            $table->timestamps();                               
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('laporans');                       
    }
};
