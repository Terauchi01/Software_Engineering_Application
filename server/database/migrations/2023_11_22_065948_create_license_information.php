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
        Schema::create('license_information', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_issue')->nullable(false);
            $table->date('date_of_registration')->nullable(false);
            $table->string("name",100)->nullable(false);
            $table->date("birth")->nullable(false);
            $table->string("conditions",100)->nullable();
            $table->string("classification",100)->nullable(false);
            $table->string("ratings_and_limitations1",100)->nullable(false);
            $table->string("ratings_and_limitations2",100)->nullable();
            $table->string("ratings_and_limitations3",100)->nullable();
            $table->string("number",200);
            $table->timestamps();
            $table->timestamp('deletion_date')->nullable()->default(null);
        });
        /*
        return [
            'date_of_issue' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'date_of_registration' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'name' => 'required|string|max:100',
            'birth' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'conditions' => 'nullable|string|max:100',
            'classification' => 'required|string|max:100',
            'ratings_and_limitations1' => 'nullable|string|max:100',
            'ratings_and_limitations2' => 'nullable|string|max:100',
            'ratings_and_limitations3' => 'nullable|string|max:100',
            'number' => 'nullable|string|max:200',
        ];
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_information');
    }
};
