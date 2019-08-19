<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('goods', GoodsController::class);
    $router->resource('sku', SkuController::class);         // SKU管理
    $router->resource('category', CategoryController::class);         // 分类管理
    $router->resource('goodsattr', GoodsAttrController::class);         // 商品属性管理
    $router->resource('goods-attr-value', GoodsAttrValController::class);   //属性值管理
    $router->get('/sku-detail/{goods_id}', 'SkuController@skuDetail');
    $router->post('/sku-detail-update', 'SkuController@skuUpdate');
});
