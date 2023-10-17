@extends('layouts.ads')
@section('tittle', 'Post-Advert')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Post Advert</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Advert</li>
                            <li class="breadcrumb-item active" aria-current="page">Add-Advertisement</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="box bg-gradient-success-dark overflow-hidden pull-up">
                    <div class="box-body pr-0 pl-lg-50 pl-15 py-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <h1 class="font-size-40 text-white">Create Advert</h1>
                                    <p class="text-white mb-0 font-size-20">
                                        <i> Please kindly select any plan for ur membership to allow posing automatically</i>
                                    </p>
                            </div>
                            <div class="col-12 col-lg-4"><img src="https://eduadmin-template.multipurposethemes.com/bs4/images/svg-icon/color-svg/custom-15.svg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                        <x-validation-errors class="alert alert-danger" />
                        <form action="{{route('padvert')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Advert Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Heading">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Advert Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Category</label>
                                            <select class="form-control" name="category" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="Appliances">Appliances</option>
                                                <option value="Fashions">Fashions</option>
                                                <option value="Properties">Properties</option>
                                                <option value="Educations">Educations</option>
                                                <option value="Businesses">Businesses</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Phone Number</label>
                                                <input type="number" name="number" class="form-control" placeholder="Heading">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Advert Duration</label>
                                            <input type="date" name="duration" class="form-control" placeholder="Heading">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Product Price</label>
                                            <input type="number" class="form-control " name="amount" placeholder="Enter Product amount" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Ads Content</label>
                                            <div class="box-body">
                                                <textarea class="textarea" id="editor1" name="text" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="box-title mt-20">Upload Advert Image</h4>
                                    <div class="product-img text-left">
                                        <div class="btn btn-info mb-20">
                                            <span>Upload Post Image</span>
                                            <input type="file" name="cover" class="upload" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"> <i class="icon-Plus">
                                    </i> Post Advert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
