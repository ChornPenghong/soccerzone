@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('order::orders.orders'))

    <li class="active">{{ trans('order::orders.orders') }}</li>
@endcomponent

@section('content')
    <div class="box box-primary">
        <div class="box-body index-table" >
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>{{ trans('admin::admin.table.id') }}</th>
                        <th>{{ trans('order::orders.table.customer_name') }}</th>
                        <th>{{ trans('order::orders.table.customer_email') }}</th>
                        <th>{{ trans('admin::admin.table.status') }}</th>
                        <th>{{ trans('order::orders.table.total') }}</th>
                        <th data-sort>{{ trans('admin::admin.table.created') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr onclick="window.location='{{ route('admin.orders.show', $order) }}'" style="cursor: pointer;">
                                <td>
                                    {{ $order->id }}
                                </td>

                                <td>
                                    {{ $order->customer_full_name }}
                                </td>

                                <td>
                                    {{ $order->customer_email }}
                                </td>

                                <td>
                                    {{ $order->status }}
                                </td>

                                <td>
                                    {{ $order->total->format() }}
                                </td>

                                <td>
                                    {{ $order->created_at->format('Y-m-d') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="empty" colspan="99"> No Record</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
          new DataTable('#myTable', {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                columns: [
                    { data: 'id', width: '5%' },
                    { data: 'customer_full_name', orderable: false, searchable: true },
                    { data: 'customer_email', searchable: true },
                    { data: 'status', searchable: false, orderable: false },
                    { data: 'total', searchable: false, orderable: false },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
    </script>
@endpush
