<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('from');
            $table->date('to');
            $table->enum('leave_type',[0,1,2,3,4,5,6]); 
            $table->enum('status',[-1,0,1]); //0 = pending, 1 = success , -1 = denied
            $table->string('employee_reason');
            $table->string('hr_reason');
            $table->timestamps();

            //0 = causal leave
            //1 = paternity leave
            //2 = medical leave
            //3 = without salary leave
            //4 = earn leave
            //5 = study leave
            //6 = bereavement leave
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
