<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            @if (App\Models\MainCompany::get()->count() == 1)

                <li><a href="{{ route('home') }}" aria-expanded="false"><i class="fab fa-accusoft"></i><span class="nav-text">Dashboard</span></a></li>
                <li><a href="{{ route('maincompany') }}" aria-expanded="false"><i class="fas fa-info-circle"></i><span class="nav-text">Company Info</span></a></li>
                <li><a href="{{ route('company') }}" aria-expanded="false"><i class="fas fa-building"></i><span class="nav-text">Clients</span></a></li>
                <li><a href="{{ route('account_receivable') }}" aria-expanded="false"><i class="fas fa-coins"></i><span class="nav-text">Receivable</span></a></li>
                <li><a href="#" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i><span class="nav-text">Payable</span></a></li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fas fa-users"></i><span class="nav-text">Employees</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('position') }}"><i class="fas fa-sitemap"></i></i>Position</a></li>
                        <li><a href="{{ route('employees') }}"><i class="fas fa-users"></i>Employees</a></li>
                        <li><a href="{{ route('payroll') }}"><i class="fas fa-file-invoice-dollar"></i>Payroll</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fas fa-file-excel"></i><span class="nav-text">Salary Sheet</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('salarysheet.list') }}"><i class="fas fa-users"></i>All Salary Sheet</a></li>
                        <li><a href="{{ route('salarysheet') }}"><i class="fas fa-sitemap"></i>Generate Salary Sheet</a></li>

                    </ul>
                </li>
                {{-- <li><a href="{{ route('attendence') }}" aria-expanded="false"><i class="fab fa-autoprefixer"></i><span class="nav-text">Attendance</span></a></li> --}}
                {{-- <li><a href="#" aria-expanded="false"><i class="fas fa-file-excel"></i><span class="nav-text">Salary Sheet</span></a></li> --}}
                <li><a href="{{ route('bank') }}" aria-expanded="false"><i class="fas fa-university"></i><span class="nav-text">Bank</span></a></li>
                {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">Bank</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('bank') }}"><i class="fas fa-university"></i>Bank</a></li>
                        <li><a href="{{ route('bank.transaction') }}"><i class="fas fa-university"></i>Bank Trasection</a></li>
                        <li><a href="{{ route('ledger') }}"><i class="fas fa-university"></i>Bank Ledger</a></li>
                        <li><a href="{{ route('search') }}"><i class="fas fa-university"></i>Financial Report</a></li>
                    </ul>
                </li> --}}
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">Transection</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('company.balance') }}"><i class="fas fa-file-invoice-dollar"></i>Company Transection</a></li>
                        <li><a href="{{ route('bank.transaction') }}"><i class="fas fa-file-invoice-dollar"></i>Bank Trasection</a></li>
                        {{-- <li><a href="{{ route('ledger') }}"><i class="fas fa-university"></i>Bank Ledger</a></li>
                        <li><a href="{{ route('search') }}"><i class="fas fa-university"></i>Financial Report</a></li> --}}
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fas fa-book"></i><span class="nav-text">Ledger</span></a>
                    <ul aria-expanded="false">
                        {{-- <li><a href="{{ route('company.balance') }}"><i class="fas fa-university"></i>Company Transection</a></li> --}}
                        <li><a href="{{ route('ledger') }}"><i class="fas fa-book-open"></i>Bank Ledger</a></li>
                        <li><a href="{{ route('company.ledger') }}"><i class="fas fa-university"></i>Company Ledger</a></li>
                        {{-- <li><a href="{{ route('search') }}"><i class="fas fa-university"></i>Financial Report</a></li> --}}
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fab fa-buffer"></i><span class="nav-text">Financial Report</span></a>
                    <ul aria-expanded="false">
                        {{-- <li><a href="{{ route('company.balance') }}"><i class="fas fa-university"></i>Company Transection</a></li> --}}
                        <li><a href="#"><i class="fas fa-swatchbook"></i>Company Account Report</a></li>
                        <li><a href="{{ route('search') }}"><i class="far fa-file-alt"></i>Bank Account Report</a></li>
                        {{-- <li><a href="{{ route('ledger') }}"><i class="fas fa-university"></i>Bank Ledger</a></li>
                        <li><a href="{{ route('search') }}"><i class="fas fa-university"></i>Financial Report</a></li> --}}
                    </ul>
                </li>

                <li><a href="{{ route('rules') }}" aria-expanded="false"><i class="fas fa-clipboard-list"></i><span class="nav-text">Rules & Policy</span></a></li>
            @else
                <li><a href="{{ route('maincompany') }}" aria-expanded="false"><i class="fas fa-info-circle"></i><span class="nav-text">Main Company</span></a></li>
            @endif
        </ul>
    </div>


</div>
