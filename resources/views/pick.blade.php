@include('layouts.sidebar')

    <div class="row">
        <style>
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-header border-0">
                    <h4 class="heading mb-0 text-white">MTN & GLO</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="sales-bx" onclick="window.location.href='{{route('select', 'mtn')}}'">
                            <img src="{{asset('mtn.png')}}" alt="#" />
                            <h4>MTN DATA</h4>
                            <span>Select</span>
                        </div>
                        <div class="sales-bx" onclick="window.location.href='{{route('select', 'GLO')}}'">
                            <img src="{{asset('glo.jpeg')}}" alt="#" />
                            <h4>GLO DATA</h4>
                            <span>Select</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card" style="background: #394758!important">
                <div class="card-header border-0">
                    <h4 class="heading mb-0 text-white">AIRTEL & 9MOBILE</h4>
                </div>
                <div class="card-body" >
                    <div class="d-flex justify-content-between">
                        <div class="sales-bx" onclick="window.location.href='{{route('select', 'AIRTEL')}}'">
                            {{--                            <img src="images/analytics/sales.png" alt="">--}}
                            <img src="{{asset('air.jpg')}}" alt="#" />
                            <h4>AIRTEL</h4>
                            <span>Select</span>
                        </div>
                        <div class="sales-bx" onclick="window.location.href='{{route('select', '9MOBILE')}}'">
                            <img src="{{asset('9m.jpg')}}" alt="#" />
                            <h4>9MOBILE</h4>
                            <span>Select</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
