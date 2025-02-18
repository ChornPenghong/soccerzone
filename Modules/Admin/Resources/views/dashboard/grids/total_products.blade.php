<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="single-grid total-products">
        <i class="fa fa-money" aria-hidden="true"></i>

        <!-- Title for Monthly Sales -->
        <span class="title">Monthly Sales</span>

        <!-- Display the total monthly sales amount -->
        <a href="{{ route('admin.orders.index', ['filter_date' => 'monthly']) }}"><span class="count">${{ number_format($monthlySales, 2) }} →</span></a>
    </div>
</div>
