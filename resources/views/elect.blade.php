@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

<div class="loading-overlay" id="loadingSpinner1" style="display: none;">
    <div class="loading-spinner"></div>
</div><div class="loading-overlay" id="loadingSpinner" style="display: none;">
    <div class="loading-spinner"></div>
</div>
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

    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                <div class="page-header">
                    <DIV CLASS="ROW">
                        <div class="col">
                            <h4 class="page-title">Electricity Bills</h4>
                            <ul class="breadcrumb">
                                {{--                                <li class=""><a href="{{route('dashboard')}}">Dashboard</a></li>--}}
                                {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!--                    <div class="box w3-card-4">-->
                        <div class="row">
                            <div class="col-sm-8">
                                <br>
                                <br>
                                <div class="alert alert-danger" id="ElectNote" style="text-transform: uppercase;font-weight: bold;font-size: 18px;display: none;">
                                </div>
                                <div id="electPanel" class="subscribe">
                                    <div class="alert alert-danger">0.1% discount apply.</div>
                                    <form  id="dataForm">
                                        @csrf
                                        <div  class="form-group">
                                            <label  class="requiredField">
                                                Select  Electricity Company
                                                <span class="asteriskField">*</span>
                                            </label>
                                            <select name="id" class="text-success form-control" id="firstSelect" required>
                                                <option selected="">---------</option>
                                                @foreach($tv as $tv1)
                                                    <option value="{{$tv1['plan']}}">{{$tv1['plan']}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div id="metertypeID" class="form-group">
                                            <label for="metertypeID" class=" requiredField">
                                               Meter Number
                                                <span class="asteriskField">*</span>
                                            </label>
                                            <div class="">
                                                <input type="number" id="number" name="number" class="form-control" minlength="11" maxlength="11" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name1">Meter Name</label>
                                            <input type="text" id="name" name="name" class="text-success form-control" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label for="name1">Amount</label>
                                            <input type="text" id="amount" name="amount" class="text-success form-control" required>
                                            <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">

                                        </div>

                                        <button type="submit" class="submit-btn"
                                                style="color: white;background-color: #13b10d;margin-bottom:15px;"> PayNow
                                        </button>
                                        <!--                        <button type="button" id="verify" class=" btn" style="margin-bottom:15px;">  <span id="process"><i class="fa fa-circle-o-notch fa-spin " style="font-size: 30px;animation-duration: 1s;"></i> Validating Please wait </span>  <span id="displaytext">Validate Meter Number </span></button>-->
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#number').on('input', function() {
            var inputElement = document.getElementById("number");
            var inputValue = inputElement.value;
            var secondS = $('#firstSelect');
            var third = $('#name');

            if (inputValue.length === 11) {
                $('#loadingSpinner1').show();

                $.ajax({
                    url: '{{ url('velect') }}/' + inputValue + '/' + secondS.val(),
                    type: 'GET',
                    data: {
                        value1: inputValue,
                        value2: secondS.val()
                    },
                    success: function(response) {
                        $('#loadingSpinner1').hide();
                        $('#name').val(response);
                    },
                    error: function(xhr) {
                        $('#loadingSpinner1').hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'fail',
                            text: xhr.responseText
                        });
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally
            // Get the form data
            var formData = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to buy ' + document.getElementById("firstSelect").options[document.getElementById("firstSelect").selectedIndex].text + ' of ' + document.getElementById("amount").value + ' on ' + document.getElementById("number").value + ' (' + document.getElementById("name").value + ')?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{route('payelect')}}",
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


            // Send the AJAX request
        });
    });

</script>


