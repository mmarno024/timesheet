@extends('layouts.colorparalax')
@section('content')
<!-- begin #milestone -->
        <div id="milestone" class="content bg-black-darker has-bg" data-scrollview="true" style="padding-top: 120px;">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="{{url('colorparalax')}}/assets/img/milestone-bg.jpg" alt="Milestone" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="1292">1,292</div>
                            <div class="title">Themes & Template</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="9039">9,039</div>
                            <div class="title">Registered Members</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="89291">89,291</div>
                            <div class="title">Items Sold</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="129">129</div>
                            <div class="title">Theme Authors</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #milestone -->

<!-- begin #team -->
        <div id="team" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Our Team</h2>
                <p class="content-desc">
                    Phasellus suscipit nisi hendrerit metus pharetra dignissim. Nullam nunc ante, viverra quis<br />
                    ex non, porttitor iaculis nisi.
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <!-- begin team -->
                        <div class="team">
                            <div class="image" data-animation="true" data-animation-type="flipInX">
                                <img src="{{url('colorparalax')}}/assets/img/user-1.jpg" alt="Ryan Teller" />
                            </div>
                            <div class="info">
                                <h3 class="name">Ryan Teller</h3>
                                <div class="title text-theme">FOUNDER</div>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                                <div class="social">
                                    <a href="#"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end team -->
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <!-- begin team -->
                        <div class="team">
                            <div class="image" data-animation="true" data-animation-type="flipInX">
                                <img src="{{url('colorparalax')}}/assets/img/user-2.jpg" alt="Jonny Cash" />
                            </div>
                            <div class="info">
                                <h3 class="name">Johnny Cash</h3>
                                <div class="title text-theme">WEB DEVELOPER</div>
                                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                <div class="social">
                                    <a href="#"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end team -->
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <!-- begin team -->
                        <div class="team">
                            <div class="image" data-animation="true" data-animation-type="flipInX">
                                <img src="{{url('colorparalax')}}/assets/img/user-3.jpg" alt="Mia Donovan" />
                            </div>
                            <div class="info">
                                <h3 class="name">Mia Donovan</h3>
                                <div class="title text-theme">WEB DESIGNER</div>
                                <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. </p>
                                <div class="social">
                                    <a href="#"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end team -->
                    </div>
                    <!-- end col-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #team -->



        <!-- begin #pricing -->
        <div id="pricing" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Our Price</h2>
                <p class="content-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
                    sed bibendum turpis luctus eget
                </p>
                <!-- begin pricing-table -->
                <ul class="pricing-table col-4">
                    <li data-animation="true" data-animation-type="fadeInUp">
                        <div class="pricing-container">
                            <h3>Starter</h3>
                            <div class="price">
                                <div class="price-figure">
                                    <span class="price-number">FREE</span>
                                </div>
                            </div>
                            <ul class="features">
                                <li>1GB Storage</li>
                                <li>2 Clients</li>
                                <li>5 Active Projects</li>
                                <li>5 Colors</li>
                                <li>Free Goodies</li>
                                <li>24/7 Email support</li>
                            </ul>
                            <div class="footer">
                                <a href="#" class="btn btn-inverse btn-block">Buy Now</a>
                            </div>
                        </div>
                    </li>
                    <li data-animation="true" data-animation-type="fadeInUp">
                        <div class="pricing-container">
                            <h3>Basic</h3>
                            <div class="price">
                                <div class="price-figure">
                                    <span class="price-number">$9.99</span>
                                    <span class="price-tenure">per month</span>
                                </div>
                            </div>
                            <ul class="features">
                                <li>2GB Storage</li>
                                <li>5 Clients</li>
                                <li>10 Active Projects</li>
                                <li>10 Colors</li>
                                <li>Free Goodies</li>
                                <li>24/7 Email support</li>
                            </ul>
                            <div class="footer">
                                <a href="#" class="btn btn-inverse btn-block">Buy Now</a>
                            </div>
                        </div>
                    </li>
                    <li class="highlight" data-animation="true" data-animation-type="fadeInUp">
                        <div class="pricing-container">
                            <h3>Premium</h3>
                            <div class="price">
                                <div class="price-figure">
                                    <span class="price-number">$19.99</span>
                                    <span class="price-tenure">per month</span>
                                </div>
                            </div>
                            <ul class="features">
                                <li>5GB Storage</li>
                                <li>10 Clients</li>
                                <li>20 Active Projects</li>
                                <li>20 Colors</li>
                                <li>Free Goodies</li>
                                <li>24/7 Email support</li>
                            </ul>
                            <div class="footer">
                                <a href="#" class="btn btn-theme btn-block">Buy Now</a>
                            </div>
                        </div>
                    </li>
                    <li data-animation="true" data-animation-type="fadeInUp">
                        <div class="pricing-container">
                            <h3>Lifetime</h3>
                            <div class="price">
                                <div class="price-figure">
                                    <span class="price-number">$999</span>
                                </div>
                            </div>
                            <ul class="features">
                                <li>Unlimited Storage</li>
                                <li>Unlimited Clients</li>
                                <li>Unlimited Projects</li>
                                <li>Unlimited Colors</li>
                                <li>Free Goodies</li>
                                <li>24/7 Email support</li>
                            </ul>
                            <div class="footer">
                                <a href="#" class="btn btn-inverse btn-block">Buy Now</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end container -->
        </div>
        <!-- end #pricing -->

@endsection