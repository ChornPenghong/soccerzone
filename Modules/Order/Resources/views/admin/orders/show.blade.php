@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.show', ['resource' => trans('order::orders.order')]))

    <li><a href="{{ route('admin.orders.index') }}">{{ trans('order::orders.orders') }}</a></li>
    <li class="active">{{ trans('admin::resource.show', ['resource' => trans('order::orders.order')]) }}</li>
@endcomponent

@section('content')
    <div class="order-wrapper">
        @include('order::admin.orders.partials.order_and_account_information')
        @include('order::admin.orders.partials.address_information')
        @include('order::admin.orders.partials.items_ordered')
        @include('order::admin.orders.partials.order_totals')
    </div>
@endsection

@push('globals')
    @vite([
        'Modules/Order/Resources/assets/admin/sass/main.scss',
        'Modules/Order/Resources/assets/admin/js/main.js',
    ])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(() => {
            let selectedStatus = null; // Store previous status
            let selectedOrderId = null; // Store order ID

            $('#order-status').focus(function () {
                selectedStatus = $(this).val(); // Store current value before change
            });

            $('#order-status').change(function (e) {
                selectedOrderId = e.currentTarget.dataset.id;
                $('#confirm-status-modal').modal('show'); // Show the confirmation modal
            });

            $('#confirm-update').click(() => {
                const newStatus = $('#order-status').val();

                $.ajax({
                    type: 'PUT',
                    url: route('admin.orders.status.update', selectedOrderId),
                    data: { status: newStatus },
                    success: (message) => {
                        success(message);
                        $('#confirm-status-modal').modal('hide');
                    },
                    error: (xhr) => {
                        error(xhr.responseJSON.message);
                        $('#order-status').val(selectedStatus); // Revert if error occurs
                        $('#confirm-status-modal').modal('hide');
                    }
                });
            });

            // Revert selection if the user cancels
            $('#confirm-status-modal .btn-secondary').click(() => {
                $('#order-status').val(selectedStatus);
            });
        });
    </script>
@endpush
