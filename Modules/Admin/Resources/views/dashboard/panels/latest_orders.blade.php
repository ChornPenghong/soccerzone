<!-- Filter Form -->
<form id="filterForm">
    <div class="form-group">
        <label for="status">{{ trans('report::admin.filters.status') }}</label>

        <select name="status" id="orderStatus" class="custom-select-black">
            <option value="">{{ trans('report::admin.filters.please_select') }}</option>

            @foreach (trans('order::statuses') as $name => $label)
                <option value="{{ $name }}" {{ request('status') === $name ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</form>

<!-- Orders Table -->
<div class="table-responsive anchor-table">
    <table class="table">
        <thead>
            <tr>
                <th>{{ trans('admin::dashboard.table.latest_orders.order_id') }}</th>
                <th>{{ trans('admin::dashboard.table.customer') }}</th>
                <th>{{ trans('admin::dashboard.table.latest_orders.status') }}</th>
                <th>{{ trans('admin::dashboard.table.latest_orders.total') }}</th>
            </tr>
        </thead>
        <tbody id="ordersTableBody">
            @forelse ($latestOrders as $latestOrder)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.show', $latestOrder) }}">
                            {{ $latestOrder->id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $latestOrder) }}">
                            {{ $latestOrder->customer_first_name }} {{ $latestOrder->customer_last_name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $latestOrder) }}">
                            {{ $latestOrder->status }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $latestOrder) }}">
                            {{ $latestOrder->total->format() }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="empty" colspan="4">{{ trans('admin::dashboard.no_data') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
