@include('admin.layouts.sidebar')
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

    <div class="row">
        <div class="loading-overlay" id="loadingSpinner" style="display: none;">
            <div class="loading-spinner"></div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                    <p class="text-muted mb-4 font-13">Product Controller</p>
                        <div class="table-responsive">
                            <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                                <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Limits</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plan as $seller)
                            <tr>
                                <link rel="stylesheet" href="{{asset('style.css')}}">
                                <!--Only for demo purpose - no need to add.-->
                                <link rel="stylesheet" href="{{asset('demo.css')}}"/>
                                <td> {{$seller->plan}}</td>
                                <td> {{$seller->amount}}</td>
                                <td> {{$seller->limis}}</td>
                                <td> {{$seller->days}}</td>
                                {{--                                <td><a href="{{route('editpayment', $pay->id)}}"--}}
                                {{--                                       {{$pay->value}}class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>--}}
                                {{--                                </td>--}}
                                <td>@if($seller->status=="1")<h6 class="btn-success">Active</h6>@else<h6
                                        class="btn-warning">
                                        Not-Active</h6> @endif</td>
                                <td>
                                    <label class="toggleSwitch nolabel">
                                        <input type="checkbox" name="status" value="0" id="myCheckBox"
                                               {{$seller->status =="1"?'checked':''}}
                                               {{--                                            @if($pay->status==1?'checked':'')--}}
                                               >
                                        <!--                                            <button  type="submit" class="btn-info col-lg">Update</button>-->
                                        <span>
                                                <span>off</span>
                                                <span>on</span>
                                             </span>

                                        <a></a>
                                    </label>
                                </td>
                                <td>
                                    <button  type="button" class="btn btn-primary" onclick="openModal(this)" data-user-id="{{$seller->id}}" data-user-name="{{$seller->plan}}" >
                                        <i class="fa fa-edit"></i>
                                    </button>
                               </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                                        <div class="card card-body subscribe">
                                            <p>EDIT Plan</p>
                                            {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                                            <br/>
                                            <div class="form-group">
                                                <label>Plan</label>
                                                <input type="text" class="form-control" id="plan"  name="name" value="" readonly />
                                                <input type="hidden" class="form-control" id="id" name="id" value="" required />
                                            </div>
                                            <br/>
                                            <div id="div_id_network" >
                                                <label for="network" class=" requiredField">
                                                   Amount<span class="asteriskField">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="number" id="amount" name="amount"  class="text-success form-control" required>
                                                </div>
                                            </div>
                                            <br/>
                                            <div id="div_id_network" >
                                                <label for="network" class=" requiredField">
                                                   Limits<span class="asteriskField">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="number" id="limits" name="limits"  class="text-success form-control" required>
                                                </div>
                                            </div>
                                            <div id="div_id_network" >
                                                <label for="network" class=" requiredField">
                                                    Numbers Of Days<span class="asteriskField">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="number" id="amount" name="pamount"  class="text-success form-control" required>
                                                </div>
                                            </div>
                                            <br/>
                                            <button type="submit" class="submit-btn">Update</button>
                                        </div>
                                    </form>
                                    <button class="btn btn-outline-danger" onclick="closeModal()">Cancel</button>
                                </div>
                            </div>

                </div>
            </div>
        </div>
        <!-- end col -->
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

        <script>
            $(document).ready(function() {


                // Send the AJAX request
                $('#dataForm').submit(function(e) {
                    e.preventDefault(); // Prevent the form from submitting traditionally

                    // Get the form data
                    var formData = $(this).serialize();
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();

                    $.ajax({
                        url: "{{route('admin/doplan')}}",
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
                });
            });

        </script>

        <!-- end row -->
@include('layouts.footer')
