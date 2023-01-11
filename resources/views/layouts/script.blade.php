  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/index.js') }}"></script>
  <script src="{{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>


  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
 @if(session()->has('type'))
  <?php  $type= 'success';
    $message ="information has been saved successfully";
    session()->flash('type');
  ?>

  <script>
      iziToast.<?=$type?>({
    title: '<?= $type ?>',
    message: '<?= $message?>',
    position: 'topRight'
  });
  </script>
  @endif
  <script type="text/javascript">
		function confirm_modal(delete_url) {
      console.log(delete_url);
			swal({
				title: "Are You Sure",
				text: "Delete This Information",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn btn-primary ml-3",
				cancelButtonClass: "btn btn-danger ",
				confirmButtonText: "Yes Continue",
				cancelButtonText: "cancel",
				buttonsStyling: false,
				footer: "Deleted Note"
			}).then((result) => {
				if (result.value) {
          console.log('ok');
					$.ajax({
						url: delete_url,
						type: "POST",
            data:{"_token": "{{ csrf_token() }}"},
						success:function(data) {
							swal({
							title: "Deleted",
							text: "Information Deleted",
							buttonsStyling: false,
							showCloseButton: true,
							focusConfirm: false,
							confirmButtonClass: "btn btn-primary",
							type: "success"
							}).then((result) => {
								if (result.value) {
									location.reload();
								}
							});
						}
					});
				 }
			});
		}

	</script>
