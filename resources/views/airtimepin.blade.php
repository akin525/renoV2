
@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>


<style>
    .subscribe {
        position: relative;
        padding: 20px;
        background-color: #FFF;
        border-radius: 4px;
        color: #333;
        box-shadow: 0px 0px 60px 5px rgba(0, 0, 0, 0.4);
    }

    .subscribe:after {
        position: absolute;
        content: "";
        right: -10px;
        bottom: 18px;
        width: 0;
        height: 0;
        border-left: 0px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #208b37;
    }

    .subscribe p {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        letter-spacing: 4px;
        line-height: 28px;
    }



    .subscribe .submit-btn {
        position: absolute;
        border-radius: 30px;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        background-color: #208b37;
        color: #FFF;
        padding: 12px 25px;
        display: inline-block;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 5px;
        right: -10px;
        bottom: -20px;
        cursor: pointer;
        transition: all .25s ease;
        box-shadow: -5px 6px 20px 0px rgba(26, 26, 26, 0.4);
    }

    .subscribe .submit-btn:hover {
        background-color: #208b37;
        box-shadow: -5px 6px 20px 0px rgba(88, 88, 88, 0.569);
    }
</style>

<div style="padding:90px 15px 20px 15px">
    <!--    <h4 class="align-content-center text-center">Data Subscription</h4>-->

    <div class="loading-overlay" id="loadingSpinner" style="display: none;">
        <div class="loading-spinner"></div>
    </div>



    <div class="card bg-primary">
        <center>

            <div class="">
                <h4 class="heading mb-0 text-white text-center">Advertisement 😎</h4>
            </div>
            <div class="card card-body shadow-hover">
                <style>
                    .bo {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
                @if($ads=="")
                    <center>
                    <video width="320" height="240" controls autoplay loop>
                        <source src="{{asset('ads/ads.mp4')}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    </center>
                    <a href="{{route('advertisement')}}" class="btn btn-success">Advertise here</a>
                @else
                    <a href="{{route('details', $ads->id)}}">
                        <img  class="bo" src="{{url('/', $ads->cover_image)}}" alt="ads" />
                        <h3 class="text-primary" ><b>{{$ads->advert_name}}</b></h3>
                    </a>


            @endif
        </center>
    </div>
    <form id="dataForm" >
        @csrf
        <div class="row">
            <div class="col-sm-8">
                <br>
                <br>
               <div id="AirtimePanel">
                   <div class="subscribe">
                       <p>AIRTIME PIN PURCHASE</p>
{{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                       <br/>
                       <div id="div_id_network" class="form-group">
                           <label for="network" class=" requiredField">
                               Network<span class="asteriskField">*</span>
                           </label>
                           <div class="">
                               <select name="id" class="text-success form-control" required="">

                                   <option value="MTN">MTN</option>
                                   <option value="GLO">GLO</option>
                                   <option value="AIRTEL">AIRTEL</option>
                                   <option value="9MOBILE">9MOBILE</option>

                               </select>
                           </div>
                       </div>
                       <br/>
                       <div id="div_id_network" >
                           <label for="network" class=" requiredField">
                               Select Amount<span class="asteriskField">*</span>
                           </label>
                           <div class="">
{{--                               <input type="number" id="amount" name="amount" min="100" max="4000" oninput="calc()" class="text-success form-control" required>--}}
                               <select name="amount" id="amount" class="text-success form-control" required="">

                                   <option value="100">100</option>
                                   <option value="200">200</option>
                                   <option value="500">500</option>
                                   <option value="1000">1000</option>

                               </select>
                           </div>
                       </div>
                       <br/>
                       <div id="div_id_network" class="form-group">
                           <label for="network" class=" requiredField">
                               Enter Phone Number<span class="asteriskField">*</span>
                           </label>
                           <div class="">
                               <input type="number"  name="number" minlength="11" class="text-success form-control" required>
                           </div>
{{--                           <i class="fa fa-user" onclick="web2app.selectContact(contactCallback);"></i>--}}
                       </div>
                       <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                       <button type="submit" class="submit-btn">PURCHASE<span class="load loading"></span></button>
{{--                       <div class="col-lg-12">--}}
{{--                           <div class="form-group">--}}
{{--                               <label class="small mb-1" for="amount" style="color: #000000"><b>Amount to Pay (<span>₦</span>)</b></label>--}}
{{--                               <br>--}}
{{--                               <span class="text-danger">2% Discount:</span> <b class="text-success">₦<span id="shownow1"></span></b>--}}
{{--                           </div>--}}
{{--                       </div>--}}
                       <script>

                           function dynamicLinkEvent(type, data) {
                               // alert(JSON.stringify(data));

                               console.log("dLink Event");
                               console.log(type);
                               console.log(JSON.stringify(data));
                               document.getElementById('anyme').value=data.data;
                           }

                           function web2appInit(data) {
                               // alert(JSON.stringify(data));
                               console.log("web2app is ready")
                               console.log(JSON.stringify(data));
                           }

                           function myCallback(data) {
                               // alert(JSON.stringify(data));
                               console.log("I am in callback")
                               console.log(JSON.stringify(data));
                           }

                           function contactCallback(data) {
                               // alert(JSON.stringify(data));
                               console.log("I am in callback")
                               console.log(JSON.stringify(data));
                               document.getElementById('anyme').value=data.data;
                           }

                       </script>

                       <script>
                           function calc(){
                                   var value = document.getElementById("amount").value;
                                   var percent = 2/100 * value;
                                   var reducedvalue = value - percent;
                                   document.getElementById("shownow1").innerHTML = reducedvalue;

                           }
                       </script>
                   </div>
                </div>

            </div>
            <div class="col-sm-4 ">
                <br>
                <div class="card-body">
                    <a href="{{route('advertisement')}}">
                        <div class="center">
                            <img    src="{{asset('ads/ads1.jpg')}}" alt="#" />
                        </div>
                    </a>
{{--                    <video width="320" height="240" controls autoplay loop>--}}
{{--                        <source src="{{asset('ads/ads.mp4')}}" type="video/mp4">--}}
{{--                        Your browser does not support the video tag.--}}
{{--                    </video>--}}
                </div>

{{--                <a href="{{route('advertisement')}}" class="btn btn-success">Advertise here</a>--}}


                {{--                <p><b>You can use the codes below to check your Airtime Balance!  </b> </p>--}}


{{--                <h6>--}}
{{--                    <ul class="list-group">--}}
{{--                        <b><li class="list-group-item list-group-item-primary bold"> MTN *556#</li></b>--}}
{{--                        <b><li class="list-group-item list-group-item-success">MTN [CG] *131*4# or *460*260#</li></b>--}}
{{--                        <b><li class="list-group-item list-group-item-action">9mobile  *223#</li></b>--}}
{{--                        <b><li class="list-group-item list-group-item-info">Airtel *123#</li></b>--}}
{{--                        <b><li class="list-group-item list-group-item-secondary">Glo *124*0#</li></b>--}}
{{--                    </ul>--}}
{{--                </h6>--}}
                <br>
                <style>
                    img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
                <div class="card-body">
                    <div class="center">
{{--                        <img    src="{{asset('images/tp.jpeg')}}" alt="#" />--}}
                    </div>
                </div>

                <br>




            </div>
        </div>

    </form>


</div>
<script>
    function myCallback(data) {
        // alert(JSON.stringify(data));
        // console.log("I am in callback")
        // console.log(JSON.stringify(data));
    }
</script>
<script>
    $(document).ready(function() {


            // Send the AJAX request
        $('#dataForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            // Get the form data
            var formData = $(this).serialize();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to buy airtime of ₦' + document.getElementById("amount").value + ' on ' + document.getElementById("anyme").value +' ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $('#loadingSpinner').show();
                        // web2app.advert.showinterstitial(myCallback)
                        try {
                            web2app.advert.showinterstitial(myCallback);
                        } catch (error) {
                            console.error("An error occurred while trying to show the interstitial ad:", error);
                        }

                        $.ajax({
                            url: "{{ route('buyairtime') }}",
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                // Handle the success response here
                                $('#loadingSpinner').hide();

                                console.log(response);
                                // Update the page or perform any other actions based on the response

                                if (response.status == 'success') {
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

                    }
                });
            });
    });

</script>



