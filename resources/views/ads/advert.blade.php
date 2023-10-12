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
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">New Post</h4>
                    </div>
                    <div class="box-body">
                        <x-validation-errors class="alert alert-danger" />


                        <form action="" method="post" enctype="multipart/form-data">
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
                                            <label class="font-weight-700 font-size-16">Advert Address<</label>
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
                                            <label class="font-weight-700 font-size-16">Status</label>
                                            <div class="radio-list">
                                                <label class="radio-inline p-0 mr-10">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="radio" id="radio1" value="option1">
                                                        <label for="radio1">Published</label>
                                                    </div>
                                                </label>
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="radio" id="radio2" value="option2">
                                                        <label for="radio2">Draft</label>
                                                    </div>
                                                </label>
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
                                            <label class="font-weight-700 font-size-16">Post Content</label>
                                            <div class="box-body">
                                                <textarea class="textarea" id="editor1" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="box-title mt-20">Upload Image</h4>
                                    <div class="product-img text-left">
                                        <div class="btn btn-info mb-20">
                                            <span>Upload Post Image</span>
                                            <input type="file" name="image" class="upload" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"> <i class="icon-Plus">
                                    </i> Add-Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
