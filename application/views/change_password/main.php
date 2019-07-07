<div class="content">
	<div class="panel">
		<div class="content-header no-mg-top">
			<i class="fa fa-newspaper-o"></i>
			<div class="content-header-title">Change Password</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<form id="form-action">
			<input type="text" name="id" class="hidden" value="<?php echo $active_user->id; ?>">
						<div class="form-group">
							<label for=""> Old Password</label>
							<input class="form-control" name="old_password" placeholder="Old Password" type="password">
							<div class="validation-message" data-field="old_password"></div>
						</div>
						<div class="form-group">
							<label for=""> New Password</label>
							<input class="form-control" name="new_password" placeholder="New Password" type="password">
							<div class="validation-message" data-field="new_password"></div>
						</div>
					</form>
					<div class="content-box-footer">
						<button type="button" class="btn btn-primary action" title="save" onclick="save()">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function validate(formData) {
		var returnData;
		$('#form-action').disable([".action"]);
		$("button[title='save']").html("Validating data, please wait...");
		$.ajax({
			url: "<?php echo base_url() . 'change_password/validate'; ?>", async: false, type: 'POST', data: formData,
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

	function save() {
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
				$('.validation-message').html('');
				$("button[title='save']").html("Saving data, please wait...");
				$.post("<?php echo base_url() . 'change_password/save'; ?>", formData).done(function(data) {
					swal({   
						title: "Success",
						text: "Your password successfully saved",
						type: "success"
					})

					$('#form-action').enable([".action"]);
					$("button[title='save']").html("Save");
					$('[name="old_password"]').val('')
					$('[name="new_password"]').val('')
				});
			});
		}
	}

</script>