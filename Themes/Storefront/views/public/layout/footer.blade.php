<footer class="footer-wrap">
    <div class="container">
        <div class="footer">
            <div class="footer-top">
                <div class="row">
                    
                    <div class="col-lg-4 col-md-7">
                        <ul class="list-inline">
                            <li>
                                <div class="header-column-left align-items-center">
                                    <a href="{{ route('home') }}" class="header-logo">
                                        @if (is_null($logo))
                                            <h3>{{ setting('store_name') }}</h3>
                                        @else
                                            <img src="{{ $logo }}" alt="Logo">
                                        @endif
                                    </a>
                                </div>
                            </li>
                            <li>&nbsp;</li>
                            <li>
                                <p>Our passion for this existence is driven by a common belief that advancement of one country’s next generation economy largely depends on the readiness.</p>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="col-lg-2 col-md-2"></div>

                    <div class="col-lg-3 col-md-7">
                        <div class="footer-links">
                            <h4 class="title">{{ trans('storefront::layout.my_account') }}</h4>

                            <ul class="list-inline">
                                <li>
                                    <a href="{{ route('account.dashboard.index') }}">
                                        {{ trans('storefront::account.pages.dashboard') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.orders.index') }}">
                                        {{ trans('storefront::account.pages.my_orders') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.reviews.index') }}">
                                        {{ trans('storefront::account.pages.my_reviews') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.profile.edit') }}">
                                        {{ trans('storefront::account.pages.my_profile') }}
                                    </a>
                                </li>

                                @auth
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            {{ trans('storefront::account.pages.logout') }}
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>

                    <!-- @if ($footerMenuOne->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title">{{ setting('storefront_footer_menu_one_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuOne as $menuItem)
                                        <li>
                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif -->

                    <!-- @if ($footerMenuTwo->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title">{{ setting('storefront_footer_menu_two_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuTwo as $menuItem)
                                        <li>
                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif -->

                    @if ($footerTags->isNotEmpty())
                        <div class="col-lg-4 col-md-7">
                            <div class="footer-links footer-tags">
                                <h4 class="title">{{ trans('storefront::layout.tags') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerTags as $footerTag)
                                        <li>
                                            <a href="{{ $footerTag->url() }}">
                                                {{ $footerTag->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="col-lg-5 col-md-7">
                        <div class="contact-us">
                            <h4 class="title">{{ trans('storefront::layout.contact_us') }}</h4>

                            <ul class="list-inline contact-info">
                                @if (setting('store_phone') && ! setting('store_phone_hide'))
                                    <li>
                                        <i class="las la-phone"></i>

                                        <a href="tel:+1 206 555 0100" class="store-phone">
                                            <span>{{ substr(setting('store_phone'), 0 , strlen(setting('store_phone')) / 2) }}</span>
                                            <span class="d-none">JUNK LOAD</span>
                                            <span>{{ substr(setting('store_phone'), strlen(setting('store_phone')) / 2) }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (setting('store_email') && ! setting('store_email_hide'))
                                    <li>
                                        <i class="las la-envelope"></i>

                                        <a href="mailto:user@email.com" class="store-email">
                                            <span>{{ substr(setting('store_email'), 0 , strlen(setting('store_email')) / 2) }}</span>
                                            <span class="d-none">JUNK LOAD</span>
                                            <span>{{ substr(setting('store_email'), strlen(setting('store_email')) / 2) }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (setting('storefront_address'))
                                    <li>
                                        <i class="las la-map"></i>

                                        <span>{{ setting('storefront_address') }}</span>
                                    </li>
                                @endif
                            </ul>

                            @if (social_links()->isNotEmpty())
                                <ul class="list-inline social-links">
                                    @foreach (social_links() as $icon => $socialLink)
                                        <li>
                                            <a href="{{ $socialLink }}">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-9 col-sm-18">
                        <div class="footer-text">
                            {!! $copyrightText !!}
                        </div>
                    </div>

                    @if ($acceptedPaymentMethodsImage->exists)
                        <div class="col-md-9 col-sm-18">
                            <div class="footer-payment">
                                <img src="{{ $acceptedPaymentMethodsImage->path }}" alt="Accepted payment methods">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>


@push('scripts')
    <script type="module">
        $('.store-phone').attr('href', `tel:{{ setting('store_phone') }}`);
        $('.store-email').attr('href', `mailto:{{ setting('store_email') }}`);
    </script>
@endpush
