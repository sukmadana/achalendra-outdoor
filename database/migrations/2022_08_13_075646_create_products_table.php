<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('product_name');
            $table->decimal('price')->default(0);
            $table->text('description')->nullable();
            $table->integer('qty')->default(0);
            $table->enum('status', ['draft', 'publish'])->default('publish');
            $table->foreignId('category_id')->constrained('product_categories');
            $table->string('attributes')->nullable();
            $table->string('tags')->nullable();
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
        Schema::dropIfExists('products');
    }
}
