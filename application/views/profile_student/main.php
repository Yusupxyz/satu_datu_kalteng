<div class="content">
	<div class="panel">
		<div class="content-header no-mg-top">
			<i class="fa fa-newspaper-o"></i>
			<div class="content-header-title">Profile</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<form id="form-action">
						<div class="form-group">
							<label for=""> Full Name</label>
							<input class="form-control" name="student_name" placeholder="Name" type="text" value="<?php echo $students->student_name; ?>" readonly="readonly">
							<div class="validation-message" data-field="student_name"></div>
						</div>
						<div class="form-group">
							<label for=""> NIS</label>
							<input class="form-control" name="student_nis" placeholder="NIS" type="text" value="<?php echo $students->student_nis; ?>" readonly="readonly">
							<div class="validation-message" data-field="student_nis"></div>
						</div>
						<div class="form-group">
							<label for=""> Gender</label>
							<select name="gender" class="form-control">
									<option value="L" <?php echo "L" == $students->gender ? 'selected' : ''; ?>>Male</option>
									<option value="P" <?php echo "P" == $students->gender ? 'selected' : ''; ?>>Female</option>

							</select>					
							<div class="validation-message" data-field="gender"></div>
						</div>
						<div class="form-group">
							<label for=""> Birthplace</label>
							<input class="form-control" name="birthplace" placeholder="Birthplace" type="text" value="<?php echo $students->birthplace; ?>">
							<div class="validation-message" data-field="birthplace"></div>
						</div>
						<div class="form-group">
							<label for=""> Birthdate</label>
							<input class="single-daterange form-control" name="birthdate" placeholder="Birthdate" type="text" value="<?=date('d-m-Y',strtotime($students->birthdate))?>">
							<div class="validation-message" data-field="birthdate"></div>
						</div>
						<div class="form-group">
							<label for=""> Phone Number</label>
							<input class="form-control" name="phone_number" placeholder="Phone Number" type="text" value="<?php echo $students->phone_number; ?>">
							<div class="validation-message" data-field="phone_number"></div>
						</div>
						<div class="form-group">
							<label for=""> Email Address</label>
							<input class="form-control" name="email" placeholder="Email" type="text" value="<?php echo $students->email; ?>">
							<div class="validation-message" data-field="email"></div>
						</div>
						<div class="form-group">
							<label for=""> Address</label>
							<input class="form-control" name="address" placeholder="Address" type="text" value="<?php echo $students->address; ?>">
							<div class="validation-message" data-field="address"></div>
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
url: "<?php echo base_url() . 'profile_student/validate'; ?>", async: false, type: 'POST', data: formData,
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
$.post("<?php echo base_url() . 'profile_student/save'; ?>", formData).done(function(data) {
swal({
title: "Success",
text: "Your profile successfully saved",
type: "success"
})
$('#form-action').enable([".action"]);
$("button[title='save']").html("Save");
$('.user-group').html($('[name="group_id"]').find('option:selected').html())
});
});
}
}
</script>

<script type="text/javascript">
		// Date picker
	if ($('input.single-daterange').length) {
		$('input.single-daterange').daterangepicker({ "singleDatePicker": true, showDropdowns:true })
	}
</script>