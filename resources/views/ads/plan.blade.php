@extends('layouts.ads')
@section('tittle', 'Select Plan')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Select Plan</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                            <li class="breadcrumb-item active" aria-current="page">Pricing Table</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <hr/>
    <div class="row">
        <div class="col-12">
            <div class="box bg-gradient-success-dark overflow-hidden pull-up">
                <div class="box-body pr-0 pl-lg-50 pl-15 py-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-8">
                            <h1 class="font-size-40 text-white">My-Ads Plan</h1>
                            @if(Auth::user()->plan ==NULL)
                            <p class="text-white mb-0 font-size-20">
                                Please kindly select any plan for ur membership here
                            </p>
                                @elseif(Auth::user()->plan =="0")
                                <p class="text-white mb-0 font-size-20">
                                   <b>MY Plan:</b> <i>STARTER</i>
                                    <hr>
                            <a href="#" class="badge badge-success">Upgrade</a>
                                </p>
                            @elseif(Auth::user()->plan =="1")
                                <p class="text-white mb-0 font-size-20">
                                    <b>MY Plan:</b> <i>PROFESSIONAL PACKAGE</i>
                                <hr>
                                <a href="#" class="badge badge-success">Upgrade</a>
                                </p>
                            @elseif(Auth::user()->plan =="2")
                                <p class="text-white mb-0 font-size-20">
                                    <b>MY Plan:</b> <i>ENTERPRISE PACKAGE</i>
                                <hr>
                                <a href="#" class="badge badge-success">Upgrade</a>
                                </p>

                            @endif
                        </div>
                        <div class="col-12 col-lg-4"><img src="https://eduadmin-template.multipurposethemes.com/bs4/images/svg-icon/color-svg/custom-15.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($plan as $pa)
        <div class="col-lg-4">
            <div class="box">
                <div class="box-body text-center">
                    <h3 class="price">
                        <sup>₦</sup>{{$pa['amount']}}
                        <span>&nbsp;</span>
                    </h3>
                    <h5 class="text-uppercase text-muted">{{$pa['plan']}}</h5>

                    <hr>
                    <p><strong>{{$pa['limits']}}</strong> Ads-Post</p>
                    <p><strong>24x7</strong> Support</p>
                    <p><strong>{{$pa['days']}}Days</strong> Duration</p>
                    <p><strong>1</strong> User</p>

                    <br><br>
                    <a class="btn btn-success" href="{{route('choosep', $pa['code'])}}">Select plan</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

@endsection
