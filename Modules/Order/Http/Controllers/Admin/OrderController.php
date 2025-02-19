<?php

namespace Modules\Order\Http\Controllers\Admin;

use Modules\Order\Entities\Order;
use Modules\Admin\Traits\HasCrudActions;

class OrderController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['products', 'coupon', 'taxes'];

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'order::orders.order';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'order::admin.orders';


    public function index()
    {
        $request = request();
        $orders = Order::when(request('filter_date'), function ($query) use ($request) {
            if ($request->filter_date == 'today') {
                $query->whereDate('created_at', today())
                    ->whereStatus('completed');
            } elseif ($request->filter_date == 'weekly') {
                $query->whereBetween('created_at', [today()->startOfWeek(), today()->endOfWeek()])
                    ->whereStatus('completed');
            } elseif ($request->filter_date == 'monthly') {
                $query->whereBetween('created_at', [today()->startOfMonth(), today()->endOfMonth()])
                    ->whereStatus('completed');
            } elseif ($request->filter_date == 'yearly') {
                $query->whereBetween('created_at', [today()->startOfYear(), today()->endOfYear()])
                    ->whereStatus('completed');
            }
        })
            ->orderBy('id', 'desc')
            ->get();

        return view('order::admin.orders.index', compact('orders'));
    }
}
