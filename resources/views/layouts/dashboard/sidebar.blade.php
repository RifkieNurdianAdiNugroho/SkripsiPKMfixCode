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
								

								<div class="menu-item">
									<div class="menu-content pt-8 pb-0">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Data</span>
									</div>
								</div>
								
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-users"></i>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">User</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">
										<div class="menu-item">
											<a class="menu-link" href="{{url('user/manager_index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Ahli Gizi</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link" href="{{url('user/teller_index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Bidan</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link" href="{{url('user/financing_service_index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Kepala Puskesma</span>
											</a>
										</div>
									</div>
								</div>
							
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-medkit"></i>
											</span>
											<!--end::Svg Icon-->
										</span>
											<span class="menu-title">Posyandu</span>
											<span class="menu-arrow"></span>
										</span>
										<div class="menu-sub menu-sub-accordion menu-active-bg">
									
											<div class="menu-item">
												<a class="menu-link" href="{{url('/layanan/customer_service_submission_index')}}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
													<span class="menu-title">Data Pos</span>
												</a>
											</div>
										
											<div class="menu-sub menu-sub-accordion menu-active-bg">
												<div class="menu-item">
													<a class="menu-link" href="{{url('/layanan/financing_service_submission_index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Data Balita</span>
													</a>
												</div>
											</div>
										
											<div class="menu-sub menu-sub-accordion menu-active-bg">
												<div class="menu-item">
													<a class="menu-link" href="{{url('/layanan/teller_submission_index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Data Hasil</span>
													</a>
												</div>
											</div>
										</div>
									</div>

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-file-excel-o"></i>
											</span>
											<!--end::Svg Icon-->
										</span>
											<span class="menu-title">Laporan</span>
											<span class="menu-arrow"></span>
										</span>
										<div class="menu-sub menu-sub-accordion menu-active-bg">
									
											<div class="menu-item">
												<a class="menu-link" href="{{url('/layanan/customer_service_submission_index')}}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
													<span class="menu-title">Data User</span>
												</a>
											</div>
										
											<div class="menu-sub menu-sub-accordion menu-active-bg">
												<div class="menu-item">
													<a class="menu-link" href="{{url('/layanan/financing_service_submission_index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Data Balita</span>
													</a>
												</div>
											</div>
										
											<div class="menu-sub menu-sub-accordion menu-active-bg">
												<div class="menu-item">
													<a class="menu-link" href="{{url('/layanan/teller_submission_index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Data Posyandu</span>
													</a>
												</div>
											</div>

											<div class="menu-sub menu-sub-accordion menu-active-bg">
												<div class="menu-item">
													<a class="menu-link" href="{{url('/layanan/teller_submission_index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Data Hasil</span>
													</a>
												</div>
											</div>
										</div>
									</div>

									<div class="menu-item">
										<div class="menu-content">
											<div class="separator mx-1 my-4"></div>
										</div>
									</div>

									<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
										<a  href="{{url('home')}}">
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
										<a  href="{{url('home')}}">
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
									</div>

								</div>
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->
