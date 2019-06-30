<div class="content">
	<div class="panel">
		<div class="content-header no-mg-top">
			<i class="fa fa-newspaper-o"></i>

			<div class="content-header-title">Lembar Kerja Upload</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<form id="form-action" enctype="multipart/form-data">
						<input  type="text" name="id_validasi" class="hidden"> 
						<input  type="text" name="id_user" value="<?php echo $id_user; ?>" class=""> 
						<div class="form-group">
							<label for=""> Lembar Kerja</label>
							<input type="text" class="form-control-file" disabled name="nama_kategori_direktorat" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/ >
						</div>
						<div class="form-group">
							<label for=""> File (Excel)</label>
							<input type="file" class="form-control-file" name="excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/ >
							<div class="validation-message" data-field="excel"></div>
						</div>
					</form>
					<div class="content-box-footer">
						<button type="button" class="btn btn-primary action" title="cancel" onclick="form_routes('cancel')">Cancel</button>
						<button type="button" class="btn btn-primary action" title="save" onclick="form_routes('save')">Upload</button>
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

	function validate(formData) {

		var returnData;
		$('#form-action').disable([".action"]);
		$("button[title='save']").html("Validating data, please wait...");
		$.ajax({
			url: "<?php echo base_url() . 'semester1_u/validate'; ?>", async: false, type: 'POST', data: formData,
			success: function(data, textStatus, jqXHR) {
				returnData = data;
			}
		});

		$('#form-action').enable([".action"]);
		$("button[title='save']").html("Save changes");
		if (returnData != 'success') {
			alert("gagal");
			$('#form-action').enable([".action"]);
			$("button[title='save']").html("Save changes");
			$('.validation-message').html('');
			$('.validation-message').each(function() {
				for (var key in returnData) {
					if ($(this).attr('data-field') == key) {
						$(this).html(returnData[key]);
					}
				}
			});
		} else {
			return 'success';	
		}
	}

	function save(formData) {
		$("button[title='save']").html("Saving data, please wait...");
		var fd = new FormData($("#form-action")[0]);
		$.ajax({
                     url:'<?php echo base_url() . 'semester1_v1/create'; ?>', //URL submit
                     type:"post", //method Submit
                     data:fd, //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
						$('.datagrid-panel').fadeIn();
						$('.form-panel').fadeOut();
						datagrid.reload();
						setTimeout(function(){
							color_row();
						},3000);
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
					text: "Uploaded data can not be restored",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					cancelButtonText: "Cancel",
					confirmButtonText: "Upload",
					closeOnConfirm: true 
				}, function() {
					save(formData);
				});
			}else{
				cancel();
			}
	}

	function color_row(){
		var td = document.getElementsByTagName("td");
		var tr = document.getElementsByTagName("tr");

		<?php $i=0; ?>
		for(var i = 1, j = tr.length; i < j; ++i){ 
			var a=i-1;
			var e = document.getElementById("status"+a);
			if 	(e.options[e.selectedIndex].value == '1') {
					tr[i].style.backgroundColor = "lightgray";
				}else if (e.options[e.selectedIndex].value== '2'){
					tr[i].style.backgroundColor = "tomato";
				}else if (e.options[e.selectedIndex].value== '3'){
					tr[i].style.backgroundColor = "lightskyblue";
				}else if (e.options[e.selectedIndex].value== '4'){
					tr[i].style.backgroundColor = "mediumseagreen";
				}else{
					alert(document.querySelector('#status<?php echo $i; ?> option:checked').textContent);
				}
				<?php $i++; ?>
		}
	}

</script>