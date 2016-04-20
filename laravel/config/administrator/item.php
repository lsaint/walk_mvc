<?php

return [

    // 菜单里面显示的名字
    'title' => 'Item',

    // 右上角有 `New $single` 的创建新内容的文字
    'single' => 'Item',

    // 依赖于 Eloquent ORM 作数据读取和处理
    'model' => 'App\Item',

    // 显示页面
    'columns' => [

        // 当前列在数据库中的字段名称, 下同
        'id' => [
            // 这个参数定义当前列的名称, 下同
            'title' => 'ID'
        ],

        // 不指定 title 的话, 会使用字段作为 title
        'name',

        'brand' => [
            'title' => 'brand',

            // 这个参数定义了是否支持排序, 下同
            'sortable' => false,
        ],

        'photo' => [
            'title' => 'Photo',
            'output' => '<img src="/(:value)" width=100 heigh=100/>'
        ],

        /*'xx' => [
            'title' => "Xx",

            // 自定义字段, 读取对应关系里面的数据, 下同
            'relationship' => 'user',

            // 对应关系在这里显示的内容
            'select' => "(:table).username",
        ],*/

        // 不指定 title 的话, 会使用字段作为 title
        'created_at',
    ],

    'edit_fields' => array(
        'name' => array(
            'title' => 'Name',
            'type' => 'text'
        ),
        'brand' => array(
            'title' => 'Brand',
            'type' => 'text'
        ),
        'photo' => array(
            'title' => 'Photo',
            'type' => 'image',
            'naming' => 'keep',
            'location' => public_path().'/',
            /*
             *'sizes' => array(
             *    array(65, 57, 'crop', public_path() . '/photo/thumbs/', 100),
             *    array(220, 138, 'landscape', public_path() . '/photo/thumbs/', 100),
             *)
             */
        ),
    ),

];
