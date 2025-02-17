<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
Route::get('/latest_order', 'DashboardController@latestOrder')->name('admin.dashboard.latestOrder');

Route::get('/sales-analytics', [
    'as' => 'admin.sales_analytics.index',
    'uses' => 'SalesAnalyticsController@index',
    'middleware' => 'can:admin.orders.index',
]);
