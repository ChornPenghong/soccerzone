<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="single-grid total-orders">
        <i class="fa fa-money" aria-hidden="true"></i>

        <!-- Title for Weekly Sales -->
        <span class="title">Weekly Sales</span>

        <!-- Display the total weekly sales -->
        <a href="{{ route('admin.orders.index', ['filter_date' => 'weekly']) }}"> <span class="count">${{ number_format($weeklySales, 2) }} →</span></a>

    </div>
</div>
