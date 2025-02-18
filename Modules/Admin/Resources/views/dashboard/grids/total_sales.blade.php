<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="single-grid total-sales">
        <i class="fa fa-dollar" aria-hidden="true"></i>

        <span class="title">Today Sales</span>


        <a href="{{ route('admin.orders.index', ['filter_date' => 'today']) }}"><span class="count">${{number_format($todaySales, 2)}} →</span></a>
    </div>
</div>
