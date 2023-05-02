            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">John Doe <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>
                            
                            <p class="text-muted m-0">Administrator</p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ route('dashboard') }}" class="waves-effect {{ Request::is('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><span> Dashboard </span></a>
                            </li>

                            <li>
                                <a href="{{ route('employees.index') }}" class="waves-effect {{ Request::is('employees') ? 'active' : '' }} "><i class="fa-solid fa-user-plus"></i><span>Employees</span></a>
                            </li>

                            <li>
                                <a href="{{ route('suppliers.index') }}" class="waves-effect {{ Request::is('suppliers') ? 'active' : '' }} "><i class="fas fa-industry"></i><span>Suppliers</span></a>
                            </li>


                            <li>
                                <a href="{{ route('customers.index') }}" class="waves-effect {{ Request::is('customer') ? 'active' : '' }} "><i class="fa-solid fa-user-tie"></i><span>Customer</span></a>
                            </li>

                            

                            <li>
                                <a href="{{ route('advanceSalaries.index') }}" class="waves-effect {{ Request::is('advanceSalaries') ? 'active' : '' }} "><i class="fa-regular fa-money-bill-1"></i><span>Advance Salaries</span></a>
                            </li>

                            <li>
                                <a href="{{ route('categories.index') }}" class="waves-effect {{ Request::is('categories') ? 'active' : '' }} "><i class="fa-solid fa-grip"></i><span>Categories</span></a>
                            </li>

                            <li>
                                <a href="{{ route('products.index') }}" class="waves-effect {{ Request::is('products') ? 'active' : '' }} "><i class="fa-solid fa-dumpster"></i><span>Products</span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ route('expenses.index') }}" class="waves-effect {{ Request::is('expenses') ? 'active' : '' }}"><i class="fa-solid fa-money-bill-trend-up"></i> <span> Exprense </span> <span class="collapsed_icon"><i class="fa-solid fa-chevron-right"></i></span></a>
                                <ul class="list-unstyled" style="display: none">
                                    <li><a href="{{ route('todayExpense',date('d-m-Y')) }}">Today</a></li>
                                    <li><a href="{{ route('expenses.index') }}">Monthly Expense</a></li>
                                    <li><a href="{{ route('yearlyExpense',date('Y')) }}">Yearly Expense</a></li>
                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 