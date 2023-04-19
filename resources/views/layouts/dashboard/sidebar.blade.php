					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
									<a  href="{{url('home')}}">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
											<span class="menu-title">Dashboard</span>
										</span>
									 </a>
								  </div>
								
								  @php $roleLoggedIn = Auth::user()->role; @endphp
								  @include('layouts.dashboard.'.$roleLoggedIn.'')

									<div class="menu-item">
										<div class="menu-content pt-8 pb-0">
											<span class="menu-section text-muted text-uppercase fs-8 ls-1">Anda</span>
										</div>
									</div>

									<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
										<a  href="{{url('profile')}}">
											<span class="menu-link">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
												<span class="svg-icon svg-icon-2">
													<i class="fa fa-user"></i>
												</span>
												<!--end::Svg Icon-->
											</span>
													<span class="menu-title">Profile</span>
											</span>
										</a>
									</div>

									<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
										<a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											<span class="menu-link">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
												<span class="svg-icon svg-icon-2">
													<i class="fa fa-sign-out"></i>
												</span>
												<!--end::Svg Icon-->
											</span>
													<span class="menu-title">Keluar</span>
											</span>
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        	@csrf
                                    	</form>
									</div>

								</div>
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->
