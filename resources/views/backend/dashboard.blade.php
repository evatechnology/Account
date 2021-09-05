@extends('backend.layout.master')
@section('title','Dashboard')
@section('content')


<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="card card1 shadow">
                    <div class="row card-body ">
                        <div class="col-sm-6 text-center text-dark">
                            <i class="fas fa-building fa-3x"></i>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-center">
                                <h6>Company</h6>
                                <h3>{{ App\Models\Company::get()->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card2 shadow">
                    <div class="row card-body ">
                        <div class="col-sm-6 text-center text-dark">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-center">
                                <h6>Employee</h6>
                                <h3>{{ App\Models\Employee::get()->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card3 shadow">
                    <div class="row card-body ">
                        <div class="col-sm-6 text-center text-dark">
                            <i class="fas fa-university fa-3x"></i>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-center">
                                <h6>Bank</h6>
                                <h3>{{ App\Models\Bank::get()->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card4 shadow">

                    <div class="row card-body ">
                        <div class="col-sm-4 text-center text-dark">
                            <div class="text-center">
                                <h6 class="text-light">Earn</h6>
                                <h5 style="color: #79B4B7">{{ number_format(App\Models\CompanyBalance::where('type','income')->sum('amount'),2) }} Tk</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h6 class="text-light">Expense</h6>
                                <h5 style="color: #79B4B7">{{ number_format(App\Models\CompanyBalance::where('type','expense')->sum('amount'),2) }} Tk</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h6>Company</h6>
                                <h3>{{ App\Models\Company::get()->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card2 shadow">
                    <div class="row card-body ">
                        <div class="col-sm-6 text-center text-dark">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-center">
                                <h6>Employee</h6>
                                <h3>{{ App\Models\Employee::get()->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="row">

            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Income Detail</div>
                            <div class="stat-digit"> <i class="fa fa-usd"></i>7800</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Task Completed</div>
                            <div class="stat-digit"> <i class="fa fa-usd"></i> 500</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Task Completed</div>
                            <div class="stat-digit"> <i class="fa fa-usd"></i>650</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>

        <div class="row">
            @foreach (App\Models\Company::get() as $company )
                            <div class="col-sm-4">
                                <div class="card text-white shadow" id="company-balance-card">
                                    <div class="card-body mb-0">
                                        <h5 class="text-white text-center">{{ $company->name }}</h5>
                                            <br>
                                        <h2 class="card-text text-center" style="color:#0CECDD">{{ $company->current_blance }}</p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 text-white">
                                        <small>Last updateed {{ $company->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
        @endforeach
        </div>


@endsection
