<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->enum('type', ['international', 'local'])->default('local');
            $table->json('organized_by')->nullable();
            $table->unsignedInteger('number_of_seminar_done')->default(0);
            $table->json('references')->nullable();
            $table->json('relate_majors')->nullable();
            $table->json('relate_curriculum')->nullable();
            $table->longText('other_info')->nullable();
            $table->unsignedBigInteger('proposed_by');
            $table->longText('proposer_signature');
            $table->dateTime('proposed_at');

            $table->longText('dean_comment')->nullable();
            $table->longText('dean_signature')->nullable();
            $table->unsignedBigInteger('dean_commented_by')->nullable();
            $table->dateTime('dean_commented_at')->nullable();

            $table->longText('chairman_comment')->nullable();
            $table->longText('chairman_signature')->nullable();
            $table->unsignedBigInteger('chairman_commented_by')->nullable();
            $table->dateTime('chairman_commented_at')->nullable();

            $table->longText('president_comment')->nullable();
            $table->longText('president_signature')->nullable();
            $table->unsignedBigInteger('president_commented_by')->nullable();
            $table->dateTime('president_commented_at')->nullable();

            $table->longText('secretary_comment')->nullable();
            $table->longText('secretary_signature')->nullable();
            $table->unsignedBigInteger('secretary_commented_by')->nullable();
            $table->dateTime('secretary_commented_at')->nullable();

            $table->unsignedTinyInteger('status')->default(2)
                ->comment(
                    '2:proposed,3:dean commented,4:chairman commented,5:president commented,6:secretary commented'
                );
            $table->foreign('proposed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dean_commented_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('chairman_commented_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('president_commented_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('secretary_commented_by')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
