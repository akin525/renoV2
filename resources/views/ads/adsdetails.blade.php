@extends('layouts.ads')
@section('tittle', $ads->advert_name)
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Advertisement</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">advert_name</li>
                            <li class="breadcrumb-item active" aria-current="page">Ads</li>
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
                            <h1 class="font-size-40 text-white">Product</h1>
                                <p class="text-white mb-0 font-size-20">
                                    {{$ads->advert_name	}}
                                </p>
                        </div>
                        <div class="col-12 col-lg-4"><img src="https://eduadmin-template.multipurposethemes.com/bs4/images/svg-icon/color-svg/custom-15.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="box box-body b-1 text-center no-shadow">
                                <img src="{{url('/', $ads->cover_image)}}" id="product-image" class="img-fluid" alt="" />
                            </div>
                            <div class="pro-photos">
                                <div class="photos-item item-active">
                                    <img src="{{url('/', $ads->cover_image)}}" alt="" >
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <h2 class="box-title mt-0">{{$ads->adver_name}}</h2>
                            <div class="list-inline">
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                            </div>
                            <h1 class="pro-price mb-0 mt-20">₦{{number_format(intval($ads->amount *1))}}
{{--                                <span class="old-price">&#36;540</span>--}}
{{--                                <span class="text-danger">50% off</span>--}}
                            </h1>
                            <hr>
{{--                            <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. but the majority have suffered alteration in some form, by injected humour</p>--}}
                            <hr>
                            <div class="gap-items">
                                <button class="btn btn-success"><i class="mdi mdi-shopping"></i>Contact Now</button>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! $ads->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
