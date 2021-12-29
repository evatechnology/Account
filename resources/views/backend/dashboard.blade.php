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
                                <h6>Clients</h6>
                                <h3>{{ App\Models\ClientCompany::get()->count() }}</h3>
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
                                <h5 class="text-light">{{ number_format(App\Models\CompanyBalance::where('type','income')->sum('amount'),2) }} Tk</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h6 class="text-light">Expense</h6>
                                <h5 class="text-light">{{ number_format(App\Models\CompanyBalance::where('type','expense')->sum('amount'),2) }} Tk</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h6 class="text-light">Cash</h6>
                                <h5 class="text-light">{{ number_format(App\Models\CompanyBalance::where('type','income')->sum('amount') - App\Models\CompanyBalance::where('type','expense')->sum('amount'),2) }}Tk</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card5 shadow">

                    <div class="row card-body ">
                        <div class="col-sm-4 text-center text-dark">
                            <div class="text-center">
                                <h6 class="text-light">Diposit</h6>
                                <h5 class="text-light">{{ number_format(App\Models\BankTransaction::where('type','credit')->sum('amount'),2) }} Tk</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h6 class="text-light">Withdraw</h6>
                                <h5 class="text-light">{{ number_format(App\Models\BankTransaction::where('type','debit')->sum('amount'),2) }} Tk</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h6 class="text-light">Balance</h6>
                                <h5 class="text-light">{{ number_format(App\Models\BankTransaction::where('type','credit')->sum('amount') - App\Models\BankTransaction::where('type','debit')->sum('amount'),2) }}Tk</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div id="accordion-ten" class="accordion accordion-header-shadow accordion-rounded">
        <div class="accordion__item">
            <div class="accordion__header collapsed accordion__header--primary" data-toggle="collapse"
                data-target="#header-shadow_collapseOne">
                <span class="accordion__header--icon"></span>
                <span class="accordion__header--text">Recived Payment</span>
                <span class="accordion__header--indicator"></span>
            </div>
            <div id="header-shadow_collapseOne" class="collapse accordion__body show" data-parent="#accordion-ten">
                <div class="accordion__body--text">
                    <div class="row">
                        @foreach (App\Models\ClientCompany::get() as $company)
                            <div class="col-sm-4">
                                <div class="card text-white shadow" id="company-balance-card">
                                    <div class="card-body mb-0">
                                        <h4 class="card-title text-white text-center">{{ $company->name }}</h5>
                                            <br>
                                            <h2 class="card-text text-center" style="color:#0CECDD">
                                                {{ number_format($company->received_payment),2 }}Tk</h2>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 text-white">
                                        <small>Last updateed {{ $company->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div id="accordion-ten" class="accordion accordion-header-shadow accordion-rounded">
        <div class="accordion__item">
            <div class="accordion__header collapsed accordion__header--primary"  data-toggle="collapse"
                data-target="#header-shadow_collapseOne1">
                <span class="accordion__header--icon"></span>
                <span class="accordion__header--text">Bank Balance</span>
                <span class="accordion__header--indicator"></span>
            </div>
            <div id="header-shadow_collapseOne1" class="collapse accordion__body show" data-parent="#accordion-ten">
                <div class="accordion__body--text">
                    <div class="row">
                        @foreach (App\Models\Bank::get() as $item)
                        <div class="col-sm-4">
                            <div class="card shadow-lg" id="bank-card">
                                <div class="card-body">
                                    <h4 class="text-light text-center">{{ $item->bank_name }}</h4>
                                    <hr class="text-light">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="text-light text-center">Account Number</h6>
                                            <h5 class="text-light text-center">{{ $item->account_number }} </h5>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-light text-center">Current Balance</h6>
                                            <h4 class="text-light text-center">{{ $item->balance }}<small>&nbsp;tk</small></h4>
                                        </div>
                                    </div>
                                    <hr class="text-light">
                                    <div class="row">
                                        <div class="col-sm-8"><small class="text-light">Last update {{ $item->updated_at->diffForHumans() }}</small></div>
                                        {{-- <div class="col-sm-4">
                                            <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route('bank.edit', $item->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                            <a type="button" class="btn btn-outline-danger btn-sm deletebtn" href="javascript:void(0);" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
