<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-newspaper-o"></i>
				<div class="content-header-title">Semester</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content-box">
						<div class="content-box-header">
							<div class="row">
								<div class="col-md-6">
									<button class="btn btn-primary"  title="generate" onclick="routes('generate')"><i class="fa fa-pencil"></i> Generate New Semester</button>
								</div>
								<div class="col-md-6 form-inline justify-content-end">
									<select class="form-control mb-1 mr-sm-1 mb-sm-0" id="search-option"></select>
									<input class="form-control" id="search" placeholder="Search" type="text">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 form-inline">
									<br><p class="text-left">Set Tahun Aktif :</p>&nbsp;&nbsp;
									<select name="tahun" id="tahun" class="form-control">
									<?php foreach ($tahun as $key => $thn) { ?>
										<option value="<?php echo $thn->id; ?>"><?php echo $thn->tahun; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-bordered" id="datagrid"></table>
						</div>
						<div class="content-box-footer">
							<div class="row">
								<div class="col-md-3 form-inline">
									<select class="form-control" id="option"></select>
								</div>
								<div class="col-md-3 form-inline" id="info"></div>
								<div class="col-md-6">
									<ul class="pagination pull-right" id="paging"></ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Form -->
<section class="form-panel"></section>

<script type="text/javascript">
	var datagrid = $("#datagrid").datagrid({
		url						: "<?php echo base_url() . 'semester/data'; ?>",
		primaryField			: 'id_semester', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'tahun', title: 'Tahun', editable: true, sortable: false, width: 450, align: 'left', search: true},
		{field: 'periode_semester', title: 'Semester', editable: true, sortable: false, width: 450, align: 'left', search: true},
	]
});

	datagrid.run();

	$(document).ready(function(){
        $('#tahun').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url() . 'semester/set_tahun'; ?>",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    swal({   
					title: "Set successfully",   
					text: "Year is now set! ",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					cancelButtonText: "Cancel",
					confirmButtonText: "Okay",
					closeOnConfirm: true 
                }, function() {
					
				});
            }
        });
    });});

	function check(formData) {
		var returnData;
		console.log(formData);
		$("button[title='generate']").html("Checking data, please wait...");
		$.ajax({
	        url: "<?php echo base_url() . 'semester/check'; ?>", async: false, type: 'POST', data: formData,
	        success: function(data, textStatus, jqXHR) {
				returnData = data;
	        }
	    });

		$("button[title='generate']").html("Generated successfully");
        if (returnData != 'success') {
			$("button[title='generate']").html("Generated failed");
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
		$.post("<?php echo base_url() . 'semester/create'; ?>", formData).done(function(data) {
			datagrid.reload();
        });
	}

	function routes(action) {
		if (action == 'generate') {
			var formData = {year : <?php echo date("Y");?>};
			if (check(formData) == 'success') {
				swal({   
					title: "Are you sure?",   
					text: "Generated data can not be restored",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					cancelButtonText: "Cancel",
					confirmButtonText: "Save",
					closeOnConfirm: true 
				}, function() {
					save(formData);
				});
			}else{
				cancel();
			}
		}
	}

	function cancel() {
		swal({   
					title: "Failed",   
					text: "Semester have been generated/existed!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					closeOnConfirm: true 
				}, function() {
					
				});
	}

</script>