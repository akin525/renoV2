@extends('layouts.ads')
@section('tittle', 'My Ads')
@section('content')
    <div class="col-xl-8 col-12">
        <div class="box bg-primary-light">
            <div class="box-body d-flex px-0">
                <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(https://eduadmin-template.multipurposethemes.com/bs4/images/svg-icon/color-svg/custom-1.svg)">
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <h2>Welcome back, <strong>{{\App\Console\encription::decryptdata(Auth::user()->username)}}!</strong></h2>

                            <p class="text-dark my-10 font-size-16">
                                We help you promote <strong class="text-warning">Your business</strong> everywhere
                            </p>
                            <p class="text-dark my-10 font-size-16">
                                Progress is <strong class="text-warning">very good!</strong>
                            </p>
                        </div>
                        <div class="col-12 col-xl-5"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Students Progress </h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li class="dropdown">
                                <button class="btn btn-primary px-10 " data-toggle="dropdown" href="#">View List</button>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center font-weight-500">
                                <div class="mr-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block font-size-16">Amelia</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <h5 class="font-weight-600 mb-0 badge badge-pill badge-primary">75%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center font-weight-500">
                                <div class="mr-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-2.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block font-size-16">Johen</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100" style="width: 64%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <h5 class="font-weight-600 mb-0 badge badge-pill badge-warning">64%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center font-weight-500">
                                <div class="mr-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block font-size-16">Micheal</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="59" aria-valuemin="0" aria-valuemax="100" style="width: 59%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <h5 class="font-weight-600 mb-0 badge badge-pill badge-info">59%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center font-weight-500">
                                <div class="mr-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block font-size-16">Amanda</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <h5 class="font-weight-600 mb-0 badge badge-pill badge-danger">45%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center font-weight-500">
                                <div class="mr-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block font-size-16">Tyler</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <h5 class="font-weight-600 mb-0 badge badge-pill badge-primary">20%</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Working Hours</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li class="dropdown">
                                <button class="dropdown-toggle btn btn-warning-light px-10" data-toggle="dropdown" href="#">Today</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item active" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last week</a>
                                    <a class="dropdown-item" href="#">Last month</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div id="revenue5" class="min-h-325"></div>
                        <div class="d-flex justify-content-center">
                            <p class="d-flex align-items-center font-weight-600 mx-20"><span class="badge badge-xl badge-dot badge-warning mr-20"></span> Progress</p>
                            <p class="d-flex align-items-center font-weight-600 mx-20"><span class="badge badge-xl badge-dot badge-primary mr-20"></span> Done</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 col-xl-4">
        <div class="box">
            <div class="box-header bg-success">
                <h4 class="box-title text-white">Sales Overview</h4>
                <ul class="box-controls pull-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="#" class="btn btn-success-light px-10 base-font">Export</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="box-body px-0 bg-success rounded-0" style="position: relative;">
                <div id="spark3" class="text-dark" style="min-height: 200px;"><div id="apexchartskq2xw3c6l" class="apexcharts-canvas apexchartskq2xw3c6l apexcharts-theme-light" style="width: 340px; height: 200px;"><svg id="SvgjsSvg3095" width="340" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG3097" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 50)"><defs id="SvgjsDefs3096"><clipPath id="gridRectMaskkq2xw3c6l"><rect id="SvgjsRect3102" width="343" height="105" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskkq2xw3c6l"><rect id="SvgjsRect3103" width="338" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter3110" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood3111" flood-color="#000000" flood-opacity="0.1" result="SvgjsFeFlood3111Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite3112" in="SvgjsFeFlood3111Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite3112Out"></feComposite><feOffset id="SvgjsFeOffset3113" dx="1" dy="5" result="SvgjsFeOffset3113Out" in="SvgjsFeComposite3112Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur3114" stdDeviation="5 " result="SvgjsFeGaussianBlur3114Out" in="SvgjsFeOffset3113Out"></feGaussianBlur><feMerge id="SvgjsFeMerge3115" result="SvgjsFeMerge3115Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode3116" in="SvgjsFeGaussianBlur3114Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode3117" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend3118" in="SourceGraphic" in2="SvgjsFeMerge3115Out" mode="normal" result="SvgjsFeBlend3118Out"></feBlend></filter></defs><line id="SvgjsLine3101" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG3119" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG3120" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG3122" class="apexcharts-grid"><g id="SvgjsG3123" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine3125" x1="0" y1="0" x2="334" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3126" x1="0" y1="14.285714285714286" x2="334" y2="14.285714285714286" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3127" x1="0" y1="28.571428571428573" x2="334" y2="28.571428571428573" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3128" x1="0" y1="42.85714285714286" x2="334" y2="42.85714285714286" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3129" x1="0" y1="57.142857142857146" x2="334" y2="57.142857142857146" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3130" x1="0" y1="71.42857142857143" x2="334" y2="71.42857142857143" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3131" x1="0" y1="85.71428571428572" x2="334" y2="85.71428571428572" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine3132" x1="0" y1="100.00000000000001" x2="334" y2="100.00000000000001" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG3124" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine3134" x1="0" y1="100" x2="334" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine3133" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG3105" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG3106" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath3109" d="M 0 64.28571428571428C 12.988888888888887 64.28571428571428 24.12222222222222 5.714285714285708 37.11111111111111 5.714285714285708C 50.099999999999994 5.714285714285708 61.23333333333333 41.42857142857142 74.22222222222221 41.42857142857142C 87.21111111111111 41.42857142857142 98.34444444444443 15.714285714285708 111.33333333333333 15.714285714285708C 124.32222222222221 15.714285714285708 135.45555555555555 64.28571428571428 148.44444444444443 64.28571428571428C 161.4333333333333 64.28571428571428 172.56666666666666 37.14285714285714 185.55555555555554 37.14285714285714C 198.54444444444442 37.14285714285714 209.67777777777778 82.85714285714286 222.66666666666666 82.85714285714286C 235.65555555555554 82.85714285714286 246.7888888888889 48.57142857142857 259.77777777777777 48.57142857142857C 272.76666666666665 48.57142857142857 283.9 87.14285714285714 296.88888888888886 87.14285714285714C 309.87777777777774 87.14285714285714 321.0111111111111 70 334 70" fill="none" fill-opacity="1" stroke="rgba(20,144,138,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskkq2xw3c6l)" filter="url(#SvgjsFilter3110)" pathTo="M 0 64.28571428571428C 12.988888888888887 64.28571428571428 24.12222222222222 5.714285714285708 37.11111111111111 5.714285714285708C 50.099999999999994 5.714285714285708 61.23333333333333 41.42857142857142 74.22222222222221 41.42857142857142C 87.21111111111111 41.42857142857142 98.34444444444443 15.714285714285708 111.33333333333333 15.714285714285708C 124.32222222222221 15.714285714285708 135.45555555555555 64.28571428571428 148.44444444444443 64.28571428571428C 161.4333333333333 64.28571428571428 172.56666666666666 37.14285714285714 185.55555555555554 37.14285714285714C 198.54444444444442 37.14285714285714 209.67777777777778 82.85714285714286 222.66666666666666 82.85714285714286C 235.65555555555554 82.85714285714286 246.7888888888889 48.57142857142857 259.77777777777777 48.57142857142857C 272.76666666666665 48.57142857142857 283.9 87.14285714285714 296.88888888888886 87.14285714285714C 309.87777777777774 87.14285714285714 321.0111111111111 70 334 70" pathFrom="M -1 100L -1 100L 37.11111111111111 100L 74.22222222222221 100L 111.33333333333333 100L 148.44444444444443 100L 185.55555555555554 100L 222.66666666666666 100L 259.77777777777777 100L 296.88888888888886 100L 334 100"></path><g id="SvgjsG3107" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle3140" r="0" cx="0" cy="0" class="apexcharts-marker wm614zg8k no-pointer-events" stroke="#ffffff" fill="#14908a" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG3108" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine3135" x1="0" y1="0" x2="334" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine3136" x1="0" y1="0" x2="334" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG3137" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3138" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3139" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect3100" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG3121" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG3098" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(20, 144, 138);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                <div class="resize-triggers"><div class="expand-trigger"><div style="width: 341px; height: 243px;"></div></div><div class="contract-trigger"></div></div></div>
            <div class="box-body up-mar60 pb-0">
                <div class="row">
                    <div class="col-6">
                        <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                            <span class="icon-Equalizer d-block font-size-40"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                            <a href="#" class="font-weight-500 font-size-18">
                                Monthly Overview
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                            <span class="icon-Add-user d-block font-size-40"><span class="path1"></span><span class="path2"></span></span>
                            <a href="#" class="font-weight-500 font-size-18">
                                Total Visiter
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                            <span class="icon-Cart2 d-block font-size-40"><span class="path1"></span><span class="path2"></span></span>
                            <a href="#" class="font-weight-500 font-size-18">
                                Product Sale
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                            <span class="icon-Mail-opened d-block font-size-40"><span class="path1"></span><span class="path2"></span></span>
                            <a href="#" class="font-weight-500 font-size-18">
                                Order Overview
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
