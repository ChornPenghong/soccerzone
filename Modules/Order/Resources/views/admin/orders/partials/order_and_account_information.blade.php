<div class="order-information-wrapper">
    <div class="order-information-buttons">
        <a href="{{ route('admin.orders.print.show', $order) }}" class="btn btn-default" target="_blank"
            data-toggle="tooltip" title="{{ trans('order::orders.print') }}">
            <i class="fa fa-print" aria-hidden="true"></i>
        </a>

        <form method="POST" action="{{ route('admin.orders.email.store', $order) }}">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-default" data-toggle="tooltip"
                title="{{ trans('order::orders.send_email') }}" data-loading>
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </button>
        </form>
    </div>

    <h4 class="section-title">{{ trans('order::orders.order_and_account_information') }}</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="order clearfix">
                <h5>{{ trans('order::orders.order_information') }}</h5>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{ trans('order::orders.order_id') }}</td>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('order::orders.order_date') }}</td>
                                <td>{{ $order->created_at->toFormattedDateString() }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('order::orders.order_status') }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-10 col-sm-10">
                                            <select id="order-status" class="form-control custom-select-black"
                                                data-id="{{ $order->id }}">
                                                @foreach (trans('order::statuses') as $name => $label)
                                                    <option value="{{ $name }}"
                                                        {{ $order->status === $name ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Confirmation Modal -->
                                    <div class="modal fade" id="confirm-status-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                    <h4 class="modal-title">{{ __('Update Status') }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{ __('Are you sure you want to update the order status?') }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                                                    <button type="button" class="btn btn-primary" id="confirm-update">{{ __('Confirm') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @if ($order->shipping_method)
                                <tr>
                                    <td>{{ trans('order::orders.shipping_method') }}</td>
                                    <td>{{ $order->shipping_method }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td>{{ trans('order::orders.payment_method') }}</td>
                                <td>{{ $order->payment_method }}
                                    @if ($order->payment_method === 'Bank Transfer')
                                        </br>
                                        {{ setting('bank_transfer_instructions') }}
                                    @endif
                                </td>
                            </tr>

                            @if (is_multilingual())
                                <tr>
                                    <td>{{ trans('order::orders.currency') }}</td>
                                    <td>{{ $order->currency }}</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('order::orders.currency_rate') }}</td>
                                    <td>{{ $order->currency_rate }}</td>
                                </tr>
                            @endif

                            @if ($order->note)
                                <tr>
                                    <td>{{ trans('order::orders.order_note') }}</td>
                                    <td>{{ $order->note }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="account-information">
                <h5>{{ trans('order::orders.account_information') }}</h5>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{ trans('order::orders.customer_name') }}</td>
                                <td>{{ $order->customer_full_name }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('order::orders.customer_email') }}</td>
                                <td>{{ $order->customer_email }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('order::orders.customer_phone') }}</td>
                                <td>{{ $order->customer_phone }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('order::orders.customer_group') }}</td>

                                <td>
                                    {{ is_null($order->customer_id) ? trans('order::orders.guest') : trans('order::orders.registered') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
