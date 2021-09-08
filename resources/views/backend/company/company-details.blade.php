@extends('backend.layout.master')
@section('title','Company')
@section('content')
    <div class="card">
        <div class="card-body" id="details">

            <div class="row">
                <div class="col-sm-4">
                  <div class="user-photo m-b-30">
                    <img class="img-fluid" src="{{ asset('/backend/image/company/'.$company->logo) }}" alt="" />
                  </div>

                </div>
                <div class="col-sm-8">
                  <div class="user-profile-name"><h5>{{ $company->name }}</p></div>
                  <div class="user-Location">
                    <i class="ti-location-pin"></i> Address
                </div>
                  <div class="custom-tab user-profile-tab">
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="1">
                        <div class="contact-information">
                          <h4>Information</h4>
                          <div class="phone-content">
                            <span class="contact-title">Phone:</span>
                            <span class="phone-number"></span>
                          </div>
                          <div class="address-content">
                            <span class="contact-title">Address:</span>
                            <span class="mail-address"></span>
                          </div>
                          <div class="email-content">
                            <span class="contact-title">Email:</span>
                            <span class="contact-email">{{ $company->email }}</span>
                          </div>
                          <div class="website-content">
                            <span class="contact-title">Website:</span>
                            <span class="contact-website">http://{{ $company->website }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>
        <div class="card-footer">
            <button class="btn btn-info waves-effect waves-light" onclick="myFunction('details')">Print</button>
            <a type="button" href="{{ route('company') }}" class=" float-right btn btn-info waves-effect waves-light" >Back</a>

        </div>

    </div>

    <script>
        function myFunction(el) {
            var getFullContent = document.body.innerHTML;
                    var printsection = document.getElementById(el).innerHTML;
                    document.body.innerHTML = printsection;
                    window.print();
                    document.body.innerHTML = getFullContent;
    }
    </script>
@endsection
