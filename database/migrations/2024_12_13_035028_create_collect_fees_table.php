<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect_fees', function (Blueprint $table) {
            $table->id();
            $table->string("student_index_number");
            $table->string("student_name");
            $table->string("start_academic_year");
            $table->string("end_academic_year");
            $table->string("semester");
            $table->enum("method_of_payment",['Cash','Cheque','Momo']);
            $table->integer("amount");
            $table->integer("balance");
            $table->enum("currency",['$','GHS']);
            $table->string('cheque_number')->nullable();
            $table->string('Momo_number')->nullable();
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
        Schema::dropIfExists('collect_fees');
    }
}
