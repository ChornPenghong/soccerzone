<div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-grid total-customers">
            <i class="fa  fa-money" aria-hidden="true"></i>

            <!-- Title for Yearly Sales -->
            <span class="title">Year Sales</span>

            <!-- Display the total yearly sales amount -->
            <a href="{{ route('admin.orders.index', ['filter_date' => 'yearly']) }}"> <span class="count">${{ number_format($yearlySales, 2) }} →</span></a>
        </div>
</div>
