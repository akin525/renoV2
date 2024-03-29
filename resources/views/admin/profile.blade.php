@include('admin.layouts.sidebar')

<div class="row">

    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body met-pro-bg">
                <div class="met-profile" >
                    <div class="row" style='background-image: url("/images/pattern.png"); padding: 20px; color: white'>
                        <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                            <div class="met-profile-main">
                                <div class="met-profile-main-pic">
                                    @if($user->profile_photo_path!=null)
                                        <img src="{{url('/', $user->profile_photo_path)}}" alt="img" class="img img-thumbnail">
                                    @else
                                        <img alt="image" class="img img-thumbnail" width="100" src="{{asset("renon.png")}}">
                                    @endif
                                    <span class="fro-profile_main-pic-change"><i class="fa fa-camera"></i></span></div>
                                <div class="met-profile_user-detail">
                                    <h4 class="met-user-name" style="color: white">{{\App\Console\encription::decryptdata($user->username)}}</h4>
                                    <p class="mb-0 met-user-name-post">{{\App\Console\encription::decryptdata($user->name)}}</p>
                                    <p class="mb-0 met-user-name-post text-muted">({{$user->role}})</p>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-4 ml-auto">
                            <ul class="list-unstyled personal-detail">
                                <li class=""><i class="fa fa-user text-info "></i> <b>Full-Name</b> : {{\App\Console\encription::decryptdata($user->name)}}</li>
                                <br>
                                <li class=""><i class="fa fa-phone text-info "></i> <b>Phone </b> : {{\App\Console\encription::decryptdata($user->phone)}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-envelope text-info "></i> <b>Email </b> : {{\App\Console\encription::decryptdata($user->email)}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-calendar text-info"></i> <b>Reg. Date</b> : {{$user->date}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-key text-info "></i> <b>Api</b> : {{$user->apikey}}</li>
                                @if($wallet->account_number != "1")
                                <br>
                                <li class="mt-2"><i class="fa fa-phone text-info "></i> <b>Account-No</b> : {{$wallet->account_number}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-user text-info "></i> <b>Account-Name</b> : {{$wallet->account_name}}</li>
                                @endif
                                @if($wallet->account_number1 != "1")
                                    <br>
                                    <li class="mt-2"><i class="fa fa-phone text-info "></i> <b>Account-No1</b> : {{$wallet->account_number1}}</li>
                                    <br>
                                    <li class="mt-2"><i class="fa fa-user text-info "></i> <b>Account-Name1</b> : {{$wallet->account_name1}}</li>
                                @endif
                            </ul>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end f_profile-->
            </div>
            <!--end card-body-->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="general_detail_tab" data-toggle="pill" href="#general_detail">General</a></li>
                    <li class="nav-item"><a class="nav-link" id="activity_detail_tab" data-toggle="pill" href="#activity_detail">Transactions</a></li>
                    <li class="nav-item"><a class="nav-link" id="safelock_detail_tab" data-toggle="pill" href="#safelock_detail">Safe-lock</a></li>
                    <li class="nav-item"><a class="nav-link" id="portfolio_detail_tab" data-toggle="pill" href="#portfolio_detail">Bills</a></li>
                    <li class="nav-item"><a class="nav-link" id="settings_detail_tab" data-toggle="pill" href="#settings_detail">Charges</a></li>
                    <li class="nav-item"><a class="nav-link" id="sms_tab" data-toggle="pill" href="#sms_detail">Update User</a></li>
                    <li class="nav-item"><a class="nav-link" id="pass_tab" data-toggle="pill" href="#pass">Change Password</a></li>
                </ul>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->
<div class="card-body">
    <div class="w3-panel w3-yellow w3-round-xlarge">
        <div class="card-body">
            <center>
                <!--                    <h4 class="w3-text-green"><b>&nbsp;&nbsp; &nbsp;&nbsp; <a class="w3-btn w3-green w3-border w3-round-large" href="with.php">Withdraw From MCD Wallet</a>-->
                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/credit')}}">Credit User</a>

                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/regen',$user->id)}}">Regenerate Virtual1</a>
                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/regen1',$user->id)}}">Regenerate Virtual2</a>
                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/charge')}}">Charge User</a>
                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/upgrade',$user->username)}}">Upgrade User</a>

                <!--                            <a class="w3-btn w3-green w3-border w3-round-large" href="method.php">All Payment Method</a>-->
            </center>
        </div>
        </b></h4>  	</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="tab-content detail-list" id="pills-tabContent">
            <div class="tab-pane fade show active" id="general_detail">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                {{--                                    <div class="d-flex justify-content-between">--}}
                                {{--                                        <img src="../assets/images/widgets/monthly-re.png" alt="" height="75">--}}
                                {{--                                        <div class="align-self-center">--}}
                                {{--                                            <h2 class="mt-0 mb-2 font-weight-semibold">$955<span class="badge badge-soft-success font-11 ml-2"><i class="fas fa-arrow-up"></i> 8.6%</span></h2>--}}
                                {{--                                            <h4 class="title-text mb-0">Monthly Revenue</h4>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                <div class="d-flex justify-content-between bg-purple p-3 mt-3 rounded">
                                    <center>
                                    <div>
                                        <h4 class="font-weight-semibold ">&#8358;{{number_format($wallet->balance)}}</h4>
                                        <p class="mb-0 ">Wallet Balance</p>
                                    </div>
                                    </center>
                                    <div>
                                        <h4 class="mb-1 font-weight-semibold ">&#8358;{{$sumtt}}</h4>
                                        <p class="mb-0">Total Deposit</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between bg-purple p-3 mt-3 rounded">
                                    <div>
                                        <h4 class="mb-1 font-weight-semibold ">&#8358;{{number_format($sumbo)}}</h4>
                                        <p class=" mb-0">Total Bills</p>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 font-weight-semibold ">&#8358;{{number_format($sumch)}}</h4>
                                        <p class="mb-0">Total Charges</p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>

                        <!--end card-->
                        <div class="card">
                            <div class="card-body dash-info-carousel">
                                {{--                                    <h4 class="mt-0 header-title mb-4">New Leads</h4>--}}
                                <div id="carousel_1" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="media">
{{--                                                <div class="media-body align-self-center">--}}
{{--                                                    <h4 class="mt-0 mb-1 title-text text-dark">{{$user->gnews}}</h4>--}}
{{--                                                    <p class="text-muted mb-0">General News</p>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
{{--                                        <div class="carousel-item">--}}
{{--                                            <div class="media">--}}
{{--                                                <div class="media-body align-self-center">--}}
{{--                                                    <h4 class="mt-0 mb-1 title-text">{{$user->target}}</h4>--}}
{{--                                                    <p class="text-muted mb-0">Target</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel_1" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a><a class="carousel-control-next" href="#carousel_1" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span></a>
                                </div>
                            </div>
                        </div>
                        <!--end card-->

                        <div class="card">
                            <div class="card-body dash-info-carousel">

                                <div class="progress bg-warning mb-3" style="height:5px;">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!--end card-->


                    </div>
                    <!--end col-->
                    <div class="col-lg-8">
                        <div class="card">
                            <div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-4 bg-light text-center align-item-center">
                                            <h1 class="font-weight-semibold">{{($tt)}}</h1>
                                            <h4 class="header-title">Overall Performance</h4>
                                        </div>
                                        <ul class="list-unstyled mt-3">
                                            <li class="mb-2">
                                                <span class="text-dark">All Bill</span> <small class="float-right text-muted ml-3 font-14">{{$tat}}</small>
                                                <div class="progress mt-2" style="height:5px;">
                                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{($tat/100)}}%; border-radius:5px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>

                        <div class="button-list btn-social-icon">
                            <b>Referrals</b> :

                            @foreach($referrals as $referral)
                                @if($referral->photo!=null)
                                    <a href="{{$referral->username}}" class="btn btn-pink btn-circle ml-2">
                                        <img alt="image" class="card-img img" width="50" src="{{asset("renon.png")}}">
                                        {{$referral->username}}
                                    </a>
                                @else
                                    <a href="{{$referral->username}}" class="btn btn-pink btn-circle ml-2">{{$referral->username}}</a>
                                @endif

                            @endforeach
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end general detail-->
            <div class="tab-pane fade" id="activity_detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Transactions</h4>
                                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>I. Wallet</th>
                                            <th>F. Wallet</th>
                                            <th>Ref</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($td as $dat)
                                            <tr>
                                                <td>{{$dat->id}}</td>
                                                <td>{{\App\Console\encription::decryptdata($dat->username)}}
                                                </td>
                                                <td>{{$dat->amount}}</td>
                                                <td class="center">

                                                    @if($dat->status=="1")
                                                        <span class="badge badge-success">Delivered</span>
                                                    @elseif($dat->status=="0" || $dat->status=="Not Delivered" || $dat->status=="Error" || $dat->status=="ORDER_CANCELLED" || $dat->status=="Invalid Number" || $dat->status=="Unsuccessful")
                                                        <span class="badge badge-warning">{{$dat->status}}</span>
                                                    @else
                                                        <span class="badge badge-info">{{$dat->status}}</span>
                                                    @endif

                                                </td>
                                                <td>{{$dat->iwallet}}</td>
                                                <td>{{$dat->fwallet}}</td>
                                                <td>{{$dat->payment_ref}}</td>
                                                <td>{{$dat->date}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $td->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>
            <div class="tab-pane fade" id="safelock_detail">
                <div class="row">
                    <div class="col-lg-12">


                        @foreach($lock as $re)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 profile_details margin_bottom_30">
                                <div class="contact_blog">
                                    <h2 class="badge badge-success"><b>SAFE-LOCK</b></h2>
                                    <div class="contact_inner">
                                        <div class="left">
                                            <h3>{{$re->tittle}}</h3>
                                            <p><b>Username: </b>{{\App\Console\encription::decryptdata($re->username)}}</p>
                                            <p><b>Starting-Date</b>: {{$re->Start_date}}</p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-money"></i>: ₦{{ number_format(intval($re->balance *1),2)}}</li>
                                                <li><i class="fa fa-calendar">Withdraw-Date</i> : {{$re->date}}</li>
                                            </ul>
                                        </div>
                                        <div class="right">
                                            <div class="profile_contacts">
                                                <img class="img-responsive" src="{{asset("renon.png")}}" alt="#" />
                                            </div>
                                        </div>
                                        <div class="bottom_list">
                                            <div class="left_rating">
                                                <p class="ratings">
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                                </p>
                                            </div>
                                            <div class="right_button">
                                                <button type="button" onclick="{{route('profile.show')}}" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                    </i> <i class="fa fa-comments-o"></i>
                                                </button>
                                                @if($re->status=="1")
                                                    <button type="button" class="btn btn-info btn-xs">
                                                        Running
                                                    </button>
                                                    <a onclick="openModal(this)" data-user-id="{{$re->id}}" data-user-name="{{$re->tittle}}" class="btn btn-danger text-white">Change-Amount</a>
                                                @elseif($re->status=="0")
                                                    <button type="button" class="btn btn-primary btn-xs">
                                                        Completed
                                                    </button>
                                                    <a onclick="openModal(this)" data-user-id="{{$re->id}}" data-user-name="{{$re->tittle}}" class="btn btn-danger text-white">Change-Amount</a>
                                                @endif
                                                @if($re->status=="1")
                                                    <a href="{{route('admin/cron', $re->id)}}" class="btn btn-danger">Terminate</a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>
            <style>
                /* Add your CSS styles here */
                .modal {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                }
                .modal-content {
                    background-color: white;
                    width: 60%;
                    max-width: 400px;
                    margin: 100px auto;
                    padding: 20px;
                    border-radius: 5px;
                }
            </style>
            <div class="modal" id="editModal">
                <div class="modal-content">
                    <form id="dataForm" >
                        @csrf
                        <div class="card card-body">
                            <p>Change Amount</p>
                            {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                            <br/>
                            <div class="form-group">
                                <label>Safe-lock Tittle</label>
                                <input type="text" class="form-control" id="plan"  name="name" value="" readonly />
                                <input type="hidden" class="form-control" id="id" name="id" value="" required />
                            </div>
                            <br/>
                            <div id="div_id_network" >
                                <label for="network" class=" requiredField">
                                    Enter selling Amount<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="number" id="amount" name="amount"  class="text-success form-control" required>
                                </div>
                            </div>
                            <br/>
                            <button type="submit" class="btn btn-outline-success">Change</button>
                        </div>
                    </form>
                    <button class="btn btn-outline-danger" onclick="closeModal()">Cancel</button>
                </div>
            </div>
            <script>
                function openModal(element) {
                    const modal = document.getElementById('editModal');
                    const newNameInput = document.getElementById('id');
                    const net = document.getElementById('plan');
                    const userId =element.getAttribute('data-user-id');
                    const userName = element.getAttribute('data-user-name');



                    newNameInput.value = userId;
                    net.value = userName;

                    console.log(newNameInput);
                    console.log(net);
                    modal.style.display = 'block';
                    // You can fetch user data using the userId and populate the input fields in the modal if needed
                }

                function closeModal() {
                    const modal = document.getElementById('editModal');
                    modal.style.display = 'none';
                }

                function saveChanges() {
                    // Add code here to save the changes and update the table
                    closeModal();
                }
            </script>

            <div class="tab-pane fade" id="portfolio_detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Bills Table</h4>
                                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th>Product</th>
                                            <th>Number</th>
                                            <th>Token</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($version as $dat)
                                            <tr>
                                                <td>{{$dat->id}}</td>
                                                <td>{{\App\Console\encription::decryptdata($dat->username)}}</td>
                                                <td>&#8358;{{$dat->amount}}</td>
                                                <td>{{$dat->product}}</td>
                                                <td>{{$dat->number}}</td>
                                                <td>{{$dat->token}}</td>
                                                <td> @if($dat->status=="1")
                                                        <span class="badge badge-success">Delivered</span>
                                                    @elseif($dat->status=="0")
                                                        <span class="badge badge-warning">Not-Delivered</span>
                                                    @else
                                                        <span class="badge badge-info">Not-Delivered</span>
                                                    @endif</td>
                                                <td>{{$dat->created_at}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $version->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>

            <div class="tab-pane fade" id="settings_detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Charges Table</h4>
                                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th>Refid</th>
                                            <th>I-Wallet</th>
                                            <th>F-Wallet</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($charge as $dat)
                                            <tr>
                                                <td>{{$dat->id}}</td>
                                                <td>{{\App\Console\encription::decryptdata($dat->username)}}</td>
                                                <td>&#8358;{{$dat->amount}}</td>
                                                <td>{{$dat->payment_ref}}</td>
                                                <td>{{$dat->iwallet}}</td>
                                                <td>{{$dat->fwallet}}</td>
                                                <td>{{$dat->date}}</td>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $charge->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>

            <div class="tab-pane fade" id="sms_detail">
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="general-label">
                                    <form class="form-horizontal" method="POST" action="{{ route('admin/update') }}">
                                        @csrf
                                            <div class="">
                                                <div class="field">
                                                    <label class="label_field">Phone No</label>
                                                    <input type="number" class="form-control" name="number" value="{{$cphone}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{$cname}}" required />
                                                    <input type="hidden" name="username" class="form-control" value="{{$user->username}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Address</label>
                                                    <input type="text" name="address" class="form-control" value="{{$user->address}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Dob</label>
                                                    <input type="date" name="dob" class="form-control" value="{{$user->dob}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Gender</label>
                                                    <select  name="gender" class="form-control"  required >
                                                        <option value="{{$user->gender}}">{{$user->gender}}</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{$cmail}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Role</label>
                                                    <select  name="role" class="form-control"  required >
                                                        <option value="{{$user->role}}">{{$user->role}}</option>
                                                        <option value="user">User</option>
                                                        <option value="admin">admin</option>
                                                    </select>
                                                </div>
                                                <br>
                                                    <button class="btn btn-primary " type="submit"><i class="fa fa-user"></i> Update User</button>
                                                </div>

                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>

            <div class="tab-pane fade" id="pass">
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="general-label">
                                    <form class="form-horizontal" method="POST" action="{{ route('admin/pass') }}">
                                        @csrf
                                            <div class="">

                                                <div class="field">
                                                    <input type="hidden" name="username" class="form-control" value="{{$user->username}}" required />
                                                </div>
                                                <br>
                                                    <button class="btn btn-primary " type="submit"><i class="fa fa-user"></i>Generate password</button>
                                                </div>

                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>

        </div>
        <!--end tab-content-->
    </div>
    <!--end col-->
</div>
<!--end row-->


<script>
    $(document).ready(function() {
        $('#dataForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally
            // Get the form data
            var formData = $(this).serialize();
                    Swal.fire({
                        title: 'Processing',
                        text: 'Please wait...',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false
                    });
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{ route('admin/changelock') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle the success response here
                            $('#loadingSpinner').hide();

                            console.log(response);
                            // Update the page or perform any other actions based on the response

                            if (response.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Pending',
                                    text: response.message
                                });
                                // Handle any other response status
                            }

                        },
                        error: function(xhr) {
                            $('#loadingSpinner').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'fail',
                                text: xhr.responseText
                            });
                            // Handle any errors
                            console.log(xhr.responseText);

                        }
                    });


            // Send the AJAX request
        });
    });

</script>

@include('layouts.footer')
