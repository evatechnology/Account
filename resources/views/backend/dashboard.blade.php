@extends('backend.layout.master')
@section('title','Dashboard')
@section('content')
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Company </div>
                            <div class="stat-digit"> {{ App\Models\Company::get()->count() }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-{{ App\Models\Company::get()->count() }}" role="progressbar"  aria-valuemax="10"></div>
                        </div>
                    </div>
                </div>
            </div>
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
