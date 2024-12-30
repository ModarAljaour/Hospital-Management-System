@extends('WebSite.layouts.master')

@section('content')

<div class="page-wrapper rtl">
    <!-- Preloader -->
    <div class="preloader"></div>


	<!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/7.jpg);">
        <div class="auto-container">
            <h1>Departments of MediTech</h1>
			<div class="text">What We Actually Do?</div>
			<ul class="bread-crumb clearfix">
				<li><a href="index.html"><span class="fas fa-home"></span> Home </a></li>
				<li>Departments</li>
			</ul>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Department Section -->
	<section class="department-section">
		<div class="auto-container">

			<!-- Sec Title -->
			<div class="sec-title centered">
				<h2>Health Department</h2>
				<div class="separator"></div>
			</div>

			<div class="services-carousel owl-carousel owl-theme">
                @foreach($departments as $department)
				<!-- Department Block -->
				<div class="department-block" style="">
					<div class="inner-box">
						<div class="upper-box">
							<div class="icon flaticon-kidneys"></div>
							<h3><a href="#">{{$department->name}}</a></h3>
						</div>
						<div class="text">{{\Str::limit($department->description,90)}}</div>
						<div class="read-outer">
							<a href="#" class="read-more">Read More <span class="icon fas fa-angle-double-right"></span></a>
						</div>
					</div>
				</div>
                @endforeach



			</div>

		</div>
	</section>
	<!-- End Department Section -->

	<!-- Department Section Three -->
	<section class="department-section-three">
		<div class="image-layer" style="background-image:url(images/background/6.jpg)"></div>
		<div class="auto-container">
			<!-- Department Tabs-->
            <div class="department-tabs tabs-box">
				<div class="row clearfix">
                	<!--Column-->
                    <div class="col-lg-4 col-md-12 col-sm-12">
						<!-- Sec Title -->
						<div class="sec-title light">
							<h2>Health <br> Department</h2>
							<div class="separator"></div>
						</div>
                        @foreach(App\Models\Section::all() as $section)
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#tab-urology" class="tab-btn">{{$section->name}}</li>
                            </ul>
                        @endforeach
                    </div>
                    <!--Column-->
                    <div class="col-lg-8 col-md-12 col-sm-12">
                    	<!--Tabs Container-->
                        <div class="tabs-content">

                            <!-- Tab -->
                            <div class="tab" id="tab-urology">
                            	<div class="content">
									<h2>Urology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab active-tab" id="tab-department">
                            	<div class="content">
									<h2>Neurology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab" id="tab-gastrology">
                            	<div class="content">
									<h2>Gastrology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab" id="tab-cardiology">
                            	<div class="content">
									<h2>Cardiology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab" id="tab-eye">
                            	<div class="content">
									<h2>Eye Care Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- End Department Section -->

	<!-- Department Section Two -->
	<section class="department-section-two style-two">
		<div class="auto-container">
			<div class="sec-title centered">
				<h2>Health Department</h2>
				<div class="separator"></div>
			</div>

			<div class="three-item-carousel owl-carousel owl-theme">
                @foreach($departments as $section)

                <!-- Department Block Two -->
				<div class="department-block-two">
					<div class="inner-box">
						<div class="image">
							<a href="blog-single.html"><img src="images/resource/department-1.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="blog-single.html"> </a></h3>
							<div class="text">{{\Str::limit($section->description,90)}} </div>
							<a href="blog-single.html" class="read-more"> {{$section->name}} <span class="arrow fas fa-angle-double-right"></span></a>
						</div>
					</div>
				</div>
                @endforeach

            </div>

		</div>
	</section>
	<!-- End Department Section Two -->


</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>



@endsection
