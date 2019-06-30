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
								<div class="col-md-6">
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
		primaryField			: 'id', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'nama_kategori_direktorat', title: 'Kategori Direktorat', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'Template', title: 'Template', sortable: false, width: 200, align: 'left', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["template"]=="Tidak Ada"){
				return "Tidak Ada"
			}else{
				return menu(rowData,rowIndex)
			}
		}},
		{field: 'menu', title: 'Update', sortable: false, width: 200, align: 'left', search: true, 
		rowStyler: function(rowData, rowIndex) {
			return menu2(rowData,rowIndex)
		}},
		]
})

	datagrid.run()

	function menu(rowData, rowIndex) {
		var menu = '<a href="javascript:;" onclick="main_routes(\'download\', \''+rowData["id"]+'\')"><i class="fa fa-file-excel-o" style="color:green" ></i></a> ' +rowData["template"]
		return menu
	}

	function menu2(rowData, rowIndex) {
		var menu = '<a href="javascript:;" onclick="main_routes(\'update\', ' + rowIndex +','+rowData["group_id"]+ ')"><i class="fa fa-pencil"></i> Edit</a> '
		return menu
	}

	function create_update_form(rowIndex,rowData) {
		if (rowData=="" || rowData==null){
			rowData="0"
		}
		$.post("<?php echo base_url() . 'template/form'; ?>", {index : rowIndex,id_ref:rowData }).done(function(data) {
			$('.form-panel').html(data)
		})
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
			var row = datagrid.getRowData(rowIndex)
			$.post("<?php echo base_url() . 'user/delete'; ?>", {id : row.id}).done(function(data) {
				datagrid.reload()
			})
		})
	}

	function download(rowIndex) {
		window.location.href = "<?php echo base_url() . 'template/download/'; ?>" + rowIndex;
	}

	function main_routes(action, rowIndex,rowData) {
		if (action == 'update') {
			$('.datagrid-panel').fadeOut()
			$('.loading-panel').fadeIn()
			create_update_form(rowIndex,rowData)
		} else if (action == 'download') {
			download(rowIndex);
		}
	}

	function titleCase(str) {
		var splitStr = str.toLowerCase().split(' ');
		for (var i = 0; i < splitStr.length; i++) {
			splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
			}
		return splitStr.join(' '); 
	}
	
</script>