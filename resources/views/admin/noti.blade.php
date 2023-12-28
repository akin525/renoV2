@include('admin.layouts.sidebar')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>User Notification</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div >
                    <div >
                            <div class="">
                                <form id="postm">
                                    @csrf

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
{{--                                    <div class="row">--}}
                                        <div class="card ">
                                            <div class="input-group">
                                                <input type="hidden" name="id" value="{{$message->id}}" />
                                                <label for="editor"></label>
                                                <textarea name="message" id="editor">{{$message->message}}</textarea>
                                            </div>
                                            <hr>
                                            <div class="input-group mt-2">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" style="align-self: center; align-content: center"><i class="fa fa-paper-plane"></i> Send Message</button>
                                            </div>
                                    </div>
                                </form>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>
        <script>
            $(document).ready(function() {
                $('#postm').submit(function(e) {
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
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{ route('admin/not') }}",
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

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    </div>
@include('layouts.footer')
