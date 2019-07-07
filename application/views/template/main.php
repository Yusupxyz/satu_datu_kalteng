<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-newspaper-o"></i>
				<div class="content-header-title">Template</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content-box">
						<div class="content-box-header">
							<div class="row">
								<div class="col-md-3 form-inline">
									<br><p class="text-left">Pilih Semester :</p>&nbsp;&nbsp;
									<select name="semester" id="semester" class="form-control">
										<option>1</option>
										<option>2</option>
									</select>
								</div>
								<div class="col-md-6 form-inline justify-content-end">
									<select class="form-control mb-1 mr-sm-1 mb-sm-0" id="search-option"></select>
									<input class="form-control" id="search" placeholder="Search" type="text">
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
		url						: "<?php echo base_url() . 'template/data'; ?>",
		primaryField			: 'id_template', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'nama_kategori_direktorat', title: 'Kategori Direktorat', editable: true, sortable: false, width: 450, align: 'left', search: true},
		{field: 'Template', title: 'Template', sortable: false, width: 700, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["template"]=="Tidak Ada"){
				return "-"
			}else{
				return rowData["template"]
			}
		}
		},
		{field: 'Upload_on', title: 'Uploaded On', sortable: false, width: 500, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["upload_on"]==null){
				return "-"
			}else{
				return rowData["upload_on"]
			}
		}
		},
		{field: 'Nama', title: 'Uploaded By', sortable: false, width: 400, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["nama"]==null){
				return "-"
			}else{
				return rowData["nama"]
			}
		}
		},
		{field: 'menu', title: 'Menu', sortable: false, width: 400, align: 'center', search: false, 
			rowStyler: function(rowData, rowIndex) {
				return menu(rowData, rowIndex);
			}
		}
	]
});

	datagrid.run();

	$(document).ready(function(){
        $('#semester').change(function(){
            var val=$(this).val();
            $.ajax({
                url : "<?php echo base_url() . 'template/set_aktif'; ?>",
                method : "POST",
                data : {val: val},
                async : false,
                dataType : 'json',
                success: function(data){
                    swal({   
					title: "Set successfully",   
					text: "Semester is now choosen! ",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					cancelButtonText: "Cancel",
					confirmButtonText: "Okay",
					closeOnConfirm: true 
                }, function() {
					datagrid.reload();
				});
            }
        });
    });});

	function menu(rowData, rowIndex) {
		var menu = '<a href="javascript:;" onclick="main_routes(\'update\', ' + rowIndex + ')"><i class="fa fa-pencil"></i> Update</a> '+
		'<a href="javascript:;" onclick="delete_action(' + rowIndex + ')"><i class="fa fa-trash-o"></i> Delete</a>'
		return menu;
	}

	function create_update_form(rowIndex) {
		$.post("<?php echo base_url() . 'template/form'; ?>", {index : rowIndex}).done(function(data) {
			$('.form-panel').html(data);
		});
	}

	function delete_action(rowIndex) {
		swal({   
			title: "Are you sure want to delete this data?",   
			text: "Deleted data can not be restored!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Cancel",
			confirmButtonText: "Hapus",
			closeOnConfirm: true 
		}, function() {
			var row = datagrid.getRowData(rowIndex);
			$.post("<?php echo base_url() . 'template/delete'; ?>", {id : row.id_template}).done(function(data) {
				datagrid.reload();
			});
		});
	}

	function main_routes(action, rowIndex) {
		$('.datagrid-panel').fadeOut();
		$('.loading-panel').fadeIn();

		if (action == 'create') {
			create_update_form(rowIndex);
		} else if (action == 'update') {
			create_update_form(rowIndex);
		}
	}

</script>