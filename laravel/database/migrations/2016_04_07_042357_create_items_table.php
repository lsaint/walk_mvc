<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
    name = models.CharField(max_length=48)         # 产品名
    brand = models.CharField(max_length=48)        # 品牌名
    photo = models.ImageField(upload_to='photo')
    major_type = models.PositiveIntegerField(db_index=True, default=0)     # 大类
    minor_type = models.PositiveIntegerField(default=0)                  # 小类
    url = models.URLField()
    original_price = models.FloatField(default=0)  # 市场价
    discount_price = models.FloatField(default=0)  # 活动价
    original_points = models.PositiveIntegerField(default=0)  # 原积分价
    discount_points = models.PositiveIntegerField(default=0)  # 折扣积分价
    hits = models.PositiveIntegerField(default=0)            # 点击量
    active = models.BooleanField(default=True)
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 48);
            $table->string('brand', 48);
            $table->string('photo');
            $table->integer('major_type');
            $table->integer('minor_type');
            $table->string('url');
            $table->float('original_price');
            $table->float('original_points');
            $table->integer('discount_points');
            $table->integer('discount_price');
            $table->integer('hits');
            $table->boolean('active');
            $table->timestamps();

            $table->index('major_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
