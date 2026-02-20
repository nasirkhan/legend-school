<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
{{--                <li class="menu-title">Menu</li>--}}

                <li>
                    <a href="{{ route('/') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span class="f-s-small">Dashboard</span>
                    </a>
                </li>


                <li class="menu-title f-s-small">Operations</li>
                <li><a href="{{ route('purchase') }}" class=" waves-effect"><i class="bx bx-cart-alt"></i><span class="f-s-small">Purchase</span></a></li>
                <li><a href="{{ route('sale') }}" class=" waves-effect"><i class="bx bx-money"></i><span class="f-s-small">Sales</span></a></li>
                <li><a href="{{ route('pending-order') }}" class=" waves-effect"><i class="bx bx-shopping-bag"></i><span class="f-s-small">Pending Order</span></a></li>

                <li><a href="{{ route('due-transaction-form') }}" class=" waves-effect"><i class="bx bx-dollar-circle"></i><span class="f-s-small"> Receive and Pay</span></a></li>

                <li><a href="{{ route('transaction') }}" class=" waves-effect"><i class="bx bx-analyse"></i><span class="f-s-small">Other Income/Expense</span></a></li>
                <li><a href="{{ route('bank-transaction') }}" class=" waves-effect"><i class="bx bx-analyse"></i><span class="f-s-small">Bank Transaction</span></a></li>

                {{--                <li><a href="{{ route('bank-loan-transaction') }}" class=" waves-effect"><i class="bx bx-analyse"></i><span class="f-s-small">CC Loan Transaction</span></a></li>--}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span class="f-s-small">Client List</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach(activeClientTypes() as $type)
                            <li class="">
                                <a href="{{ route('client',['type'=>$type->name]) }}"><span class="f-s-small">{{ siteInfo('language') =='bengali'? $type->bn_name : $type->name }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span class="f-s-small">Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="">
                            <a href="{{ route('cash-book') }}"><span class="f-s-small">Cashbook</span></a>
                            <a href="{{ route('stock') }}"><span class="f-s-small">Stock</span></a>
                            <a href="{{ route('purchase-report') }}"><span class="f-s-small">Purchase and Payment</span></a>
                            <a href="{{ route('cash-sale-report') }}"><span class="f-s-small">Cash Sale Report</span></a>
                            <a href="{{ route('credit-sale-report') }}"><span class="f-s-small">Credit Sale and Collection</span></a>
                            <a href="{{ route('sale-invoices') }}"><span class="f-s-small">Cash-Credit Invoices</span></a>
                            <a href="{{ route('transport-and-labour-cost-report') }}"><span class="f-s-small">Transport & Labour Cost</span></a>
                            <a href="{{ route('other-expense-report') }}"><span class="f-s-small">Daily Expense Report</span></a>
                            <a href="{{ route('other-income-report') }}"><span class="f-s-small">Other Income Report</span></a>
                            @if(role()->code=='developer' or role()->code=='s_admin' or role()->code=='admin')
                                <a href="{{ route('bank-account-list') }}"><span class="f-s-small">Bank Report</span></a>
{{--                                <a href="{{ route('bank-loan-report') }}"><span class="f-s-small">CC Loan Report </span></a>--}}
                                <a href="{{ route('profit-loss') }}"><span class="f-s-small">Profit-Loss Statement</span></a>
                                <a href="{{ route('balance-summary') }}"><span class="f-s-small">Balance Summary</span></a>
                            @endif
                        </li>
                    </ul>
                </li>

                <li class="menu-title"><span class="f-s-small">Settings</span></li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span class="f-s-small">Product Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('product-add') }}"><span class="f-s-small">New Product</span></a></li>
                        <li><a href="{{ route('product') }}"><span class="f-s-small">Product List</span></a></li>
                        <li><a href="{{ route('category') }}"><span class="f-s-small">Category Add</span></a></li>
                        <li><a href="{{ route('sub-category') }}"><span class="f-s-small">Sub-Category Add</span></a></li>
                        <li><a href="{{ route('brand') }}" class=" waves-effect"><span>Companies</span></a></li>
                    </ul>
                </li>



                @if(role()->code=='developer')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-bank"></i>
                            <span class="f-s-small">Client Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('client-add') }}"><span class="f-s-small">New Client</span></a></li>
                            <li><a href="{{ route('client-type') }}"><span class="f-s-small">Client Type</span></a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('client-add') }}" class=" waves-effect"><i class="bx bxs-ruler"></i><span class="f-s-small">New Client</span></a></li>
                @endif

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span class="f-s-small">Bank Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('bank') }}" class=" waves-effect"><span class="f-s-small">Bank List</span></a></li>
                        <li><a href="{{ route('bank-account') }}" class=" waves-effect"><span class="f-s-small">New Bank Account</span></a></li>
{{--                        <li><a href="{{ route('bank-loan') }}" class=" waves-effect"><span class="f-s-small">CC-Loan</span></a></li>--}}
                    </ul>
                </li>
{{--                <li><a href="{{ route('country') }}" class=" waves-effect"><i class="bx bx-flag"></i><span>Countries</span></a></li>--}}



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span class="f-s-small">Account Chart</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('transaction-item') }}"><span class="f-s-small">Account List</span></a></li>
                        @if(role()->code=='developer')
                            <li><a href="{{ route('transaction-sector') }}"><span class="f-s-small">Sector</span></a></li>
                        @endif
                    </ul>
                </li>

                @if(role()->code=='developer')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-bank"></i>
                            <span class="f-s-small">Measurement Unit</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('unit') }}"><span class="f-s-small">Unit List</span></a></li>
                            <li><a href="{{ route('unit-conversion') }}"><span class="f-s-small">Unit Conversion</span></a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('site-info') }}" class=" waves-effect"><i class="bx bxs-ruler"></i><span class="f-s-small">Site Options</span></a></li>
                @endif


{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-user-circle"></i>--}}
{{--                        <span>Clients</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{ route('client-add') }}">Client Add</a></li>--}}

{{--                        @foreach(activeClientTypes() as $type)--}}
{{--                            <li class="">--}}
{{--                                <a href="{{ route('client',['type'=>$type->name]) }}">{{ $type->name }} List</a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="chat.html" class=" waves-effect">--}}
{{--                        <i class="bx bx-chat"></i>--}}
{{--                        <span class="badge badge-pill badge-success float-right">New</span>--}}
{{--                        <span>Chat</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-store"></i>--}}
{{--                        <span>Ecommerce</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="ecommerce-products.html">Products</a></li>--}}
{{--                        <li><a href="ecommerce-product-detail.html">Product Detail</a></li>--}}
{{--                        <li><a href="ecommerce-orders.html">Orders</a></li>--}}
{{--                        <li><a href="ecommerce-customers.html">Customers</a></li>--}}
{{--                        <li><a href="ecommerce-cart.html">Cart</a></li>--}}
{{--                        <li><a href="ecommerce-checkout.html">Checkout</a></li>--}}
{{--                        <li><a href="ecommerce-shops.html">Shops</a></li>--}}
{{--                        <li><a href="ecommerce-add-product.html">Add Product</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-bitcoin"></i>--}}
{{--                        <span>Crypto</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="crypto-wallet.html">Wallet</a></li>--}}
{{--                        <li><a href="crypto-buy-sell.html">Buy/Sell</a></li>--}}
{{--                        <li><a href="crypto-exchange.html">Exchange</a></li>--}}
{{--                        <li><a href="crypto-lending.html">Lending</a></li>--}}
{{--                        <li><a href="crypto-orders.html">Orders</a></li>--}}
{{--                        <li><a href="crypto-kyc-application.html">KYC Application</a></li>--}}
{{--                        <li><a href="crypto-ico-landing.html">ICO Landing</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-envelope"></i>--}}
{{--                        <span>Email</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="email-inbox.html">Inbox</a></li>--}}
{{--                        <li><a href="email-read.html">Read Email</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-receipt"></i>--}}
{{--                        <span>Invoices</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="invoices-list.html">Invoice List</a></li>--}}
{{--                        <li><a href="invoices-detail.html">Invoice Detail</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-briefcase-alt-2"></i>--}}
{{--                        <span>Projects</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="projects-grid.html">Projects Grid</a></li>--}}
{{--                        <li><a href="projects-list.html">Projects List</a></li>--}}
{{--                        <li><a href="projects-overview.html">Project Overview</a></li>--}}
{{--                        <li><a href="projects-create.html">Create New</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-task"></i>--}}
{{--                        <span>Tasks</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="tasks-list.html">Task List</a></li>--}}
{{--                        <li><a href="tasks-kanban.html">Kanban Board</a></li>--}}
{{--                        <li><a href="tasks-create.html">Create Task</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bxs-user-detail"></i>--}}
{{--                        <span>Contacts</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="contacts-grid.html">User Grid</a></li>--}}
{{--                        <li><a href="contacts-list.html">User List</a></li>--}}
{{--                        <li><a href="contacts-profile.html">Profile</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="menu-title">Pages</li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-user-circle"></i>--}}
{{--                        <span>Authentication</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="auth-login.html">Login</a></li>--}}
{{--                        <li><a href="auth-register.html">Register</a></li>--}}
{{--                        <li><a href="auth-recoverpw.html">Recover Password</a></li>--}}
{{--                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-file"></i>--}}
{{--                        <span>Utility</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="pages-starter.html">Starter Page</a></li>--}}
{{--                        <li><a href="pages-maintenance.html">Maintenance</a></li>--}}
{{--                        <li><a href="pages-comingsoon.html">Coming Soon</a></li>--}}
{{--                        <li><a href="pages-timeline.html">Timeline</a></li>--}}
{{--                        <li><a href="pages-faqs.html">FAQs</a></li>--}}
{{--                        <li><a href="pages-pricing.html">Pricing</a></li>--}}
{{--                        <li><a href="pages-404.html">Error 404</a></li>--}}
{{--                        <li><a href="pages-500.html">Error 500</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="menu-title">Components</li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-tone"></i>--}}
{{--                        <span>UI Elements</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="ui-alerts.html">Alerts</a></li>--}}
{{--                        <li><a href="ui-buttons.html">Buttons</a></li>--}}
{{--                        <li><a href="ui-cards.html">Cards</a></li>--}}
{{--                        <li><a href="ui-carousel.html">Carousel</a></li>--}}
{{--                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>--}}
{{--                        <li><a href="ui-grid.html">Grid</a></li>--}}
{{--                        <li><a href="ui-images.html">Images</a></li>--}}
{{--                        <li><a href="ui-lightbox.html">Lightbox</a></li>--}}
{{--                        <li><a href="ui-modals.html">Modals</a></li>--}}
{{--                        <li><a href="ui-rangeslider.html">Range Slider</a></li>--}}
{{--                        <li><a href="ui-session-timeout.html">Session Timeout</a></li>--}}
{{--                        <li><a href="ui-progressbars.html">Progress Bars</a></li>--}}
{{--                        <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>--}}
{{--                        <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>--}}
{{--                        <li><a href="ui-typography.html">Typography</a></li>--}}
{{--                        <li><a href="ui-video.html">Video</a></li>--}}
{{--                        <li><a href="ui-general.html">General</a></li>--}}
{{--                        <li><a href="ui-colors.html">Colors</a></li>--}}
{{--                        <li><a href="ui-rating.html">Rating</a></li>--}}
{{--                        <li><a href="ui-notifications.html">Notifications</a></li>--}}
{{--                        <li><a href="ui-image-cropper.html">Image Cropper</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="waves-effect">--}}
{{--                        <i class="bx bxs-eraser"></i>--}}
{{--                        <span class="badge badge-pill badge-danger float-right">10</span>--}}
{{--                        <span>Forms</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="form-elements.html">Form Elements</a></li>--}}
{{--                        <li><a href="form-layouts.html">Form Layouts</a></li>--}}
{{--                        <li><a href="form-validation.html">Form Validation</a></li>--}}
{{--                        <li><a href="form-advanced.html">Form Advanced</a></li>--}}
{{--                        <li><a href="form-editors.html">Form Editors</a></li>--}}
{{--                        <li><a href="form-uploads.html">Form File Upload</a></li>--}}
{{--                        <li><a href="form-xeditable.html">Form Xeditable</a></li>--}}
{{--                        <li><a href="form-repeater.html">Form Repeater</a></li>--}}
{{--                        <li><a href="form-wizard.html">Form Wizard</a></li>--}}
{{--                        <li><a href="form-mask.html">Form Mask</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-list-ul"></i>--}}
{{--                        <span>Tables</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="tables-basic.html">Basic Tables</a></li>--}}
{{--                        <li><a href="tables-datatable.html">Data Tables</a></li>--}}
{{--                        <li><a href="tables-responsive.html">Responsive Table</a></li>--}}
{{--                        <li><a href="tables-editable.html">Editable Table</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bxs-bar-chart-alt-2"></i>--}}
{{--                        <span>Charts</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="charts-apex.html">Apex Charts</a></li>--}}
{{--                        <li><a href="charts-echart.html">E Charts</a></li>--}}
{{--                        <li><a href="charts-chartjs.html">Chartjs Chart</a></li>--}}
{{--                        <li><a href="charts-flot.html">Flot Chart</a></li>--}}
{{--                        <li><a href="charts-tui.html">Toast UI Chart</a></li>--}}
{{--                        <li><a href="charts-knob.html">Jquery Knob Chart</a></li>--}}
{{--                        <li><a href="charts-sparkline.html">Sparkline Chart</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-aperture"></i>--}}
{{--                        <span>Icons</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="icons-boxicons.html">Boxicons</a></li>--}}
{{--                        <li><a href="icons-materialdesign.html">Material Design</a></li>--}}
{{--                        <li><a href="icons-dripicons.html">Dripicons</a></li>--}}
{{--                        <li><a href="icons-fontawesome.html">Font awesome</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-map"></i>--}}
{{--                        <span>Maps</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="maps-google.html">Google Maps</a></li>--}}
{{--                        <li><a href="maps-vector.html">Vector Maps</a></li>--}}
{{--                        <li><a href="maps-leaflet.html">Leaflet Maps</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-share-alt"></i>--}}
{{--                        <span>Multi Level</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="true">--}}
{{--                        <li><a href="javascript: void(0);">Level 1.1</a></li>--}}
{{--                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>--}}
{{--                            <ul class="sub-menu" aria-expanded="true">--}}
{{--                                <li><a href="javascript: void(0);">Level 2.1</a></li>--}}
{{--                                <li><a href="javascript: void(0);">Level 2.2</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
