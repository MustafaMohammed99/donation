<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('association_id')->nullable()
                ->constrained('associations', 'id')
                ->nullOnDelete();
            $table->foreignId('category_id')->nullable()
                ->constrained('categories', 'id')
                ->nullOnDelete();

            $table->double('price_stock'); // سعر السهم
            $table->double('require_amount'); // المبلغ المطلوب
            $table->double('received_amount')->default(0); //المبلغ المستلم
            $table->enum('duration_unit', ['day', 'week', 'month', 'year'])->nullable();
            $table->integer('interval') ->nullable();
            $table->integer('num_beneficiaries');
            $table->integer('current_num_beneficiaries')->nullable();
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->string('title');
            $table->string('description');
            $table->timestamps();

//    DB::table('projects')->insert([
//    ['association_id' => '1', 'category_id' => '1', 'price_stock'=> '500', 'require_amount'=>'5000',
// 'interval'=>'10', 'duration_unit'=>'month',  'num_beneficiaries'=>'10',
// 'title'=>'كفالة يتيمين', 'description'=>' كفالة اخوين يتيمين',
//            'created_at'=>now(),'updated_at'=>now()
//  ]
//]);
//   DB::table('categories')->insert([
//    ['name' => 'كفالات', 'image_path' => '',  'created_at'=>now(),'updated_at'=>now() ]
//]);
//

//   DB::table('associations')->insert([
//    ['name' => 'تكافل',  'address' => 'غزة', 'email' => 'tcafull@gmail.com', 'password' => '123456',
//            'image_path' => '',
//   'created_at'=>now(),'updated_at'=>now() ]
//]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
