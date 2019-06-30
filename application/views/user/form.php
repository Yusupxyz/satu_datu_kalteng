<div class="content">
	<div class="panel">
		<div class="content-header no-mg-top">
			<i class="fa fa-newspaper-o"></i>
			<div class="content-header-title">User Form</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<form id="form-action">
						<input  type="text" name="id" class="hidden"> 
						<div class="form-group">
							<label for=""> Full Name</label>
							<input class="form-control" name="nama" placeholder="Name" type="text">
							<div class="validation-message" data-field="nama"></div>
						</div>
						<div class="form-group">
							<label for=""> Username</label>
							<input class="form-control" name="username" placeholder="Username" type="text">
							<div class="validation-message" data-field="username"></div>
						</div>
						<div class="form-group">
							<label for=""> Email Address</label>
							<input class="form-control" name="email" placeholder="Email" type="text">
							<div class="validation-message" data-field="email"></div>
						</div>
						<div class="form-group">
							<label for=""> Password</label>
							<input class="form-control" name="password" placeholder="Password" type="password">
							<div class="validation-message" data-field="password"></div>
						</div>
						<div class="form-group">
							<label for=""> Level User</label>
							<select name="group_id" id="group_id" class="form-control">
								<?php foreach ($groups as $key => $group) { ?>
									<option value="<?php echo $group->id; ?>"><?php echo $group->group_nama; ?></option>
								<?php } ?>
							</select>
							<div class="validation-message" data-field="group"></div>
						</div>
						<div id="detail_level" class="form-group" style="display: none">
							<label for=""> Detail Level </label>
							<select name="id_ref" id="id_ref" class="form-control">
									<?php foreach ($refs as $key => $ref) { ?>
										<option value="<?php echo $ref->id; ?>"><?php echo $ref->nama; ?></option>
									<?php } ?>
							</select>
							<div class="validation-message" data-field="ref"></div>
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

	$(document).ready(function(){
		display_sub_select()
	});

	$("#group_id").change(function()
	{				
		var idgroup=$('#group_id').val();
		if (idgroup=='2'){
			document.getElementById("detail_level").style.display="block";
			dir_get(idgroup);
		}else if(idgroup=='3'){
			document.getElementById("detail_level").style.display="block";
			kk_get(idgroup);
		}else{
			document.getElementById("detail_level").style.display="none";
		}
	});

	function display_sub_select(){
		var idgroup=document.getElementById("group_id").value;
		if (idgroup=="2"){
			document.getElementById("detail_level").style.display="block";
		}else if(idgroup=="3"){
			document.getElementById("detail_level").style.display="block"
		}
	}

	function dir_get(arr) {
		$("#id_ref").empty();
		$.getJSON('<?php echo base_url() . 'user/get_dir'; ?>', function(result){
			manageData_dir(result);
		});
	}
	function kk_get(arr) {
		$("#id_ref").empty(); 
		$.getJSON('<?php echo base_url() . 'user/get_kk'; ?>', function(result){
			manageData_kk(result);
		});
	}

	function manageData_dir(data) {
	for(var i = 0; i < data.length; i++) {
		  $("#id_ref").append("<option value='" + data[i].id_direktorat + "'>" + data[i].direktorat + "</option>")
		};
	}

	function manageData_kk(data) {
	for(var i = 0; i < data.length; i++) {
		  $("#id_ref").append("<option value='" + data[i].id_kabupaten_kota + "'>" + data[i].kabupaten_kota + "</option>")
		};
	}

	function validate(formData) {

		var returnData;
		$('#form-action').disable([".action"]);
		$("button[title='save']").html("Validating data, please wait...");
		$.ajax({
			url: "<?php echo base_url() . 'user/validate'; ?>", async: false, type: 'POST', data: formData,
			success: function(data, textStatus, jqXHR) {
				returnData = data;
			}
		});

		$('#form-action').enable([".action"]);
		$("button[title='save']").html("Save changes");
		if (returnData != 'success') {
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
		$.post("<?php echo base_url() . 'user/action'; ?>", formData).done(function(data) {
			$('.datagrid-panel').fadeIn();
			$('.form-panel').fadeOut();
			datagrid.reload();
		});
	}

	function cancel() {
		$('.datagrid-panel').fadeIn();
		$('.form-panel').fadeOut();
	}

	function form_routes(action) {
		if (action == 'save') {
			var formData = $('#form-action').serialize();
			if (validate(formData) == 'success') {
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
			}
		} else {
			cancel();
		}
	}

</script>