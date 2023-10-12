@extends('layouts.ads')
@section('tittle', 'My Ads')
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

    <div class="row">

        <div class="col-lg-3">
            <div class="box">
                <div class="box-body text-center">
                    <h3 class="price">
                        <sup>$</sup>0
                        <span>&nbsp;</span>
                    </h3>
                    <h5 class="text-uppercase text-muted">Starter package</h5>

                    <hr>
                    <p><strong>500 MB</strong> Storage</p>
                    <p><strong>24x7</strong> Support</p>
                    <p><strong>5</strong> Project</p>
                    <p><strong>1</strong> User</p>

                    <br><br>
                    <a class="btn btn-warning" href="#">Select plan</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="box box-shadowed">
                <div class="box-body text-center">
                    <h3 class="price">
                        <sup>$</sup>5<sup>.99</sup>
                        <span>per month</span>
                    </h3>
                    <h5 class="text-uppercase text-muted">Professional package</h5>

                    <hr>
                    <p><strong>1 GB</strong> Storage</p>
                    <p><strong>24x7</strong> Support</p>
                    <p><strong>15</strong> Project</p>
                    <p><strong>3</strong> User</p>

                    <br><br>
                    <a class="btn btn-primary" href="#">Select plan</a>
                </div>
            </div>

        </div>

        <div class="col-lg-3">
            <div class="box">
                <div class="box-body text-center">
                    <h3 class="price">
                        <sup>$</sup>15<sup>.99</sup>
                        <span>per month</span>
                    </h3>
                    <h5 class="text-uppercase text-muted">Enterprise package</h5>

                    <hr>
                    <p><strong>5 GB</strong> Storage</p>
                    <p><strong>24x7</strong> Support</p>
                    <p><strong>50</strong> Project</p>
                    <p><strong>10</strong> User</p>

                    <br><br>
                    <a class="btn btn-info" href="#">Select plan</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="box">
                <div class="box-body text-center">
                    <h3 class="price">
                        <sup>$</sup>25<sup>.99</sup>
                        <span>per month</span>
                    </h3>
                    <h5 class="text-uppercase text-muted">Ultimate package</h5>

                    <hr>
                    <p><strong>50 GB</strong> Storage</p>
                    <p><strong>24x7</strong> Support</p>
                    <p><strong>50</strong> Project</p>
                    <p><strong>10</strong> User</p>

                    <br><br>
                    <a class="btn btn-danger" href="#">Select plan</a>
                </div>
            </div>
        </div>

    </div>

@endsection
