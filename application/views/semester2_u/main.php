<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-location-arrow"></i>
				<div class="content-header-title">Provinsi Kalimantan Tengah</div>
				<p class="text-center"><?php echo ucwords(strtolower($active_user->kabupaten_kota));?>	</p>
			</div>
		</div>
	</div>
</section>
<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-newspaper-o"></i>
				<div class="content-header-title">Status Lembar Kerja (Semester II)</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content-box">
						<div class="content-box-header">
							<div class="row">
							<div class="col-md-6">
									<button class="btn btn-primary" onclick="main_routes('create', '')"><i class="fa fa-pencil"></i> Upload New Lembar Kerja</button>
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
		url						: "<?php echo base_url() . 'semester2_u/data'; ?>",
		primaryField			: 'id_validasi', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'nama_kategori_direktorat', title: 'Lembar Kerja', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'file_lembar_kerja', title: 'Nama File (Excel)', editable: true, sortable: false, width: 300, align: 'left', search: true},
		{field: 'status', title: 'Status', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'keterangan_lembar_kerja', title: 'Keterangan', editable: true, sortable: false, width: 450, align: 'left', search: true},
		{field: 'keterangan_invalid', title: 'Keterangan Invalid', editable: true, sortable: false, width: 450, align: 'left', search: true},
		{field: 'uploaded_on', title: 'Uploaded On', editable: true, sortable: false, width: 450, align: 'left', search: true},
		{field: 'nama_u', title: 'Uploaded By', editable: true, sortable: false, width: 450, align: 'left', search: true}
	]
});

	datagrid.run();
	// function menu(rowData, rowIndex) {
	// 	var menu = '<a href="javascript:;" onclick="main_routes(\'update\', ' + rowIndex + ')"><i class="fa fa-pencil"></i> Validasi</a> ' 
	// 	return menu;
	// }

	function create_update_form(rowIndex) {
		$.post("<?php echo base_url() . 'semester2_u/form'; ?>", {index : rowIndex}).done(function(data) {
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
			$.post("<?php echo base_url() . 'group/delete'; ?>", {id : row.id}).done(function(data) {
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

	function color_row(){
		var td = document.getElementsByTagName("td");
		var tr = document.getElementsByTagName("tr");
		for(var i = 1, j = tr.length; i < j; ++i){
			for(var k = 0, l = 8*i; k < l; ++k){
			if (td[l-5].textContent.trim() == 'BELUM VALID') {
				tr[i].style.backgroundColor = "lightgray";
				}else if (td[l-5].textContent.trim() == 'INVALID'){
					tr[i].style.backgroundColor = "tomato";
				}else if (td[l-5].textContent.trim() == 'VALID'){
					tr[i].style.backgroundColor = "lightskyblue";
				}else if (td[l-5].textContent.trim() == 'FINAL'){
					tr[i].style.backgroundColor = "mediumseagreen";
				}
			}
		}
	}

	$(document).ready(function() {
		setTimeout(function(){
			color_row();
		},2000);
		});
		
		$(document).on("click", "#paging > li > a", function( event ){
			setTimeout(function(){
				color_row();
			},500);
		});
</script>