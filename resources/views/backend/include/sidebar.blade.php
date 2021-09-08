<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{ route('home') }}" aria-expanded="false"><i class="fab fa-accusoft"></i><span class="nav-text">Dashboard</span></a></li>
            <li><a href="{{ route('company') }}" aria-expanded="false"><i class="fab fa-artstation"></i><span class="nav-text">Company</span></a></li>
            <li><a href="{{ route('employees') }}" aria-expanded="false"><i class="fas fa-users"></i><span class="nav-text">Employee</span></a></li>
            <li><a href="{{ route('company.balance') }}" aria-expanded="false"><i class="fas fa-users"></i><span class="nav-text">Company Trasection</span></a></li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">Bank</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('bank') }}"><i class="fas fa-university"></i>Bank</a></li>
                    <li><a href="{{ route('bank.transaction') }}"><i class="fas fa-university"></i>Bank Trasection</a></li>
                    <li><a href="{{ route('ledger') }}"><i class="fas fa-university"></i>Bank Ledger</a></li>
                    <li><a href="{{ route('search') }}"><i class="fas fa-university"></i>Financial Report</a></li>
                </ul>
            </li>
            <li><a href="#" aria-expanded="false"><i class="icon icon-globe-2"></i><span class="nav-text">Widget</span></a></li>
        </ul>
    </div>


</div>
