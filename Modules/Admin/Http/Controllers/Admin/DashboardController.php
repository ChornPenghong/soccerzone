<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Carbon\Carbon;
use Modules\Order\Entities\Order;
use Modules\Review\Entities\Review;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\SearchTerm;
use Illuminate\Database\Eloquent\Collection;

class DashboardController
{
    /**
     * Display the dashboard with its widgets.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // Get the start and end of the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $todaySales = Order::whereStatus('completed')->whereDate('created_at', today())->sum('total');
        // Fetch the status from the request
        $status = $request->get('status');

        // Start querying the orders, ordered by creation date
        $query = Order::orderBy('created_at', 'desc');

        // If a status is selected, filter the query by that status
        if ($status) {
            $query->where('status', $status);
        }

        // Get the latest 5 orders (filtered if a status is selected)
        $latestOrders = $query->take(5)->get();
        // Sum the 'total' column for all orders created this week
        $weeklySales = Order::whereStatus('completed')->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->sum('total');
        $monthlySales = Order::whereStatus('completed')->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                            ->sum('total');
        $yearlySales = Order::whereStatus('completed')->whereBetween('created_at', [$startOfYear, $endOfYear])
                        ->sum('total');
        return view('admin::dashboard.index', [
            'todaySales' => $todaySales,
            'weeklySales' => $weeklySales,
            'monthlySales' => $monthlySales,
            'yearlySales' => $yearlySales,
            'totalSales' => Order::totalSales(),
            'totalOrders' => Order::withoutCanceledOrders()->count(),
            'totalProducts' => Product::withoutGlobalScope('active')->count(),
            'totalCustomers' => User::totalCustomers(),
            'latestSearchTerms' => $this->getLatestSearchTerms(),
            'latestOrders' => $latestOrders,
            'latestReviews' => $this->getLatestReviews(),
            'currentStatus' => $status,  // Pass the current status to the view
        ]);
    }


    private function getLatestSearchTerms()
    {
        return SearchTerm::latest('updated_at')->take(5)->get();
    }


    /**
     * Get latest five orders.
     *
     * @return Collection
     */
    private function getLatestOrders()
    {
        return Order::select([
            'id',
            'customer_first_name',
            'customer_last_name',
            'total',
            'status',
            'created_at',
        ])->latest()->take(5)->get();
    }


    /**
     * Get latest five reviews.
     *
     * @return Collection
     */
    private function getLatestReviews()
    {
        return Review::select('id', 'product_id', 'reviewer_name', 'rating')
            ->has('product')
            ->with('product:id')
            ->limit(5)
            ->get();
    }

    public function latestOrder() {
        $latestOrders = Order::when(request('status'), function ($q) {
                $q->where('status', request('status'));
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin::dashboard.panels.latest_orders', compact('latestOrders'));
    }
}
