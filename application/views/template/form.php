<div class="content">
	<div class="panel">
		<div class="content-header no-mg-top">
			<i class="fa fa-newspaper-o"></i>
			<div class="content-header-title">Template Form</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<form id="form-action" enctype="multipart/form-data" >
						<input  type="text" name="id_user" value="<?php echo $id_user; ?>" class="hidden"> 
						<input  type="text" name="id_template" class="hidden"> 
						<input  type="text" name="nama_kategori_direktorat" class="hidden"> 
						<div class="form-group">
							<label for="">Kategori Direktorat</label>
							<input disabled class="form-control" name="nama_kategori_direktorat" placeholder="kategori direktorat" type="text">
							<div class="validation-message" data-field="nama_kategori_direktorat"></div>
						</div>
						<div class="form-group">
							<label for=""> File (Excel)</label>
							<input type="file" class="form-control-file" name="excel" >
							<div class="validation-message" data-field="excel"></div>
						</div>
					</form>
					<div class="content-box-footer">
						<button type="button" class="btn btn-primary action" title="cancel" onclick="form_routes('cancel')">Cancel</button>
						<button type="button" class="btn btn-primary action" title="save" onclick="form_routes('save')">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	

	var onLoad = (function() {
		var index = "<?php echo $index; ?>";
		
		if (index != '') {
			datagrid.formLoad('#form-action', index);
		}

		$('.loading-panel').hide();
		$('.form-panel').show();
	})();


	function save(formData) {	
		$("button[title='save']").html("Saving data, please wait...");
		var fd = new FormData($("#form-action")[0]);
		$.ajax({
                     url:'<?php echo base_url() . 'template/update'; ?>', //URL submit
                     type:"post", //method Submit
                     data:fd, //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
						  console.log(data);
						$('.datagrid-panel').fadeIn();
						$('.form-panel').fadeOut();
						datagrid.reload();
                   }
                 });
	}

	function cancel() {
		$('.datagrid-panel').fadeIn();
		$('.form-panel').fadeOut();
	}

	function form_routes(action) {
		if (action == 'save') {
			var formData = $('#form-action').serialize();
				swal({   
					title: "Please check your data",   
					text: "Saved data can not be restored",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					cancelButtonText: "Cancel",
					confirmButtonText: "Save",
					closeOnConfirm: true 
				}, function() {
					save(formData);
				});
		} else {
			cancel();
		}
	}

</script>