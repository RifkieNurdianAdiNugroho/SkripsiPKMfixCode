	<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{url('assets/plugins/global/plugins.bundle.js')}}"></script>
				
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<!-- <script src="{{url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script> -->
		<script src="{{url('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{url('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{url('assets/js/custom/widgets.js')}}"></script>
		<script src="{{url('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{url('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{url('assets/js/custom/utilities/modals/create-app.js')}}"></script>
		<script src="{{url('assets/js/custom/utilities/modals/users-search.js')}}"></script>
		<!-- Wizzard -->
		<script src="{{url('assets/js/custom/wizzard/wizzard.js')}}"></script>
		<script src="{{url('assets/js/custom/apps/ecommerce/catalog/save-product.js')}}"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		<!-- Settings -->
		<script type="text/javascript">
			@if($message=Session::get('success'))
				 toastr.success("{{ $message }}");
			@endif
			@if($message=Session::get('error'))
				 toastr.error("{{$message}}");
			@endif
			@if($message=Session::get('gagal'))
				 toastr.warning("{{$message}}");
			@endif
		 </script>
		@yield('scriptcustom')
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->