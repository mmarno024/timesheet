@extends('layouts.colorparalax')
@section('content')
<!-- beign #action-box -->
        <div id="action-box" class="content has-bg" data-scrollview="true" style="padding-top: 120px">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="{{url('colorparalax')}}/assets/img/action-bg.jpg" alt="Action" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInRight">
                <!-- begin row -->
                <div class="row action-box">
                    <!-- begin col-9 -->
                    <div class="col-md-9 col-sm-9">
                        <div class="icon-large text-theme">
                            <i class="fa fa-binoculars"></i>
                        </div>
                        <h3>CHECK OUT OUR ADMIN THEME!</h3>
                        <p>
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus faucibus magna eu lacinia eleifend.
                        </p>
                    </div>
                    <!-- end col-9 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <a href="#" class="btn btn-outline btn-block">Live Preview</a>
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #action-box -->
        <!-- begin #work -->
        <div id="work" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title">Our Latest Work</h2>
                <p class="content-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
                    sed bibendum turpis luctus eget
                </p>
                <!-- begin row -->
                <div class="row row-space-10">
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-1.jpg" alt="Work 1" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Aliquam molestie</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-3.jpg" alt="Work 3" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Quisque at pulvinar lacus</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-5.jpg" alt="Work 5" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Vestibulum et erat ornare</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-7.jpg" alt="Work 7" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Sed vitae mollis magna</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
                <!-- begin row -->
                <div class="row row-space-10">
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-2.jpg" alt="Work 2" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Suspendisse at mattis odio</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-4.jpg" alt="Work 4" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Aliquam vitae commodo diam</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-6.jpg" alt="Work 6" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Phasellus eu vehicula lorem</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-6">
                        <!-- begin work -->
                        <div class="work">
                            <div class="image">
                                <a href="#"><img src="{{url('colorparalax')}}/assets/img/work-8.jpg" alt="Work 8" /></a>
                            </div>
                            <div class="desc">
                                <span class="desc-title">Morbi bibendum pellentesque</span>
                                <span class="desc-text">Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <!-- end work -->
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #work -->





@endsection