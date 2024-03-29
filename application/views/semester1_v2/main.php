<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-location-arrow"></i>
				<div class="content-header-title">Provinsi Kalimantan Tengah</div>
				<?php if($active_user->group_id=='2'){ echo '<p class="text-center">'. $active_user->direktorat. '</p>'; } ?>
				
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
				<div class="content-header-title">Status Lembar Kerja (Semester I)</div>
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
		url						: "<?php echo base_url() . 'semester1_v2/data'; ?>",
		primaryField			: 'id_lembar_kerja', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'direktorat', title: 'Direktorat', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'nama_kategori_direktorat', title: 'Lembar Kerja', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'status', title: 'Sesi I', editable: true, sortable: false, width: 300, align: 'left', search: true},
		{field: 'Status', title: 'Sesi II', sortable: false, width: 1000, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["status2"]=="1"){
				return "Downloaded"
			}else{
				return "Open"
			}
		}
		},
		{field: 'download_On', title: 'Downloaded On', sortable: false, width: 700, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["download_on"]==null){
				return "-"
			}else{
				return rowData["download_on"]
			}
		}
		},
		{field: 'download_By', title: 'Downloaded By', sortable: false, width: 700, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["nama_d"]==null){
				return "-"
			}else{
				return rowData["nama_d"]
			}
		}
		},
		{field: 'upload_On', title: 'Uploaded On', sortable: false, width: 700, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["upload_on"]==null){
				return "-"
			}else{
				return rowData["upload_on"]
			}
		}
		},
		{field: 'nama_V', title: 'Uploaded On', sortable: false, width: 700, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["nama_v"]==null){
				return "-"
			}else{
				return rowData["nama_v"]
			}
		}
		},
		{field: 'menu', title: 'Download', sortable: false, width: 200, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			return menu(rowData, rowIndex)
		}
		}
	]
});

	datagrid.run();
	function menu(rowData, rowIndex) {
		if (rowData["file_validasi"]!=""){
			var menu = '<a href="javascript:;" onclick="main_routes(\'download\', \''+rowData["id_validasi"]+'\')"><i class="fa fa-file-excel-o" style="color:green" ></i></a> ' 
			return menu
		}else{
			return "-"
		}
	}

	function download(rowIndex) {
		window.location.href = "<?php echo base_url() . 'semester1_v2/download/'; ?>" + rowIndex;
	}


	function main_routes(action, rowIndex) {

		if (action == 'create') {
			create_update_form(rowIndex);
		} else if (action == 'download') {
			download(rowIndex);
		}
	}

	function color_row(){
		var td = document.getElementsByTagName("td");
		var tr = document.getElementsByTagName("tr");
		for(var i = 1, j = tr.length; i < j; ++i){
			for(var k = 0, l = 10*i; k < l; ++k){
			if (td[l-7].textContent.trim() == 'BELUM VALID') {
				tr[i].style.backgroundColor = "lightgray";
				}else if (td[l-7].textContent.trim() == 'INVALID'){
					tr[i].style.backgroundColor = "tomato";
				}else if (td[l-7].textContent.trim() == 'VALID'){
					tr[i].style.backgroundColor = "lightskyblue";
				}else if (td[l-7].textContent.trim() == 'FINAL'){
					tr[i].style.backgroundColor = "mediumseagreen";
				}else{
					// alert(td[l-7].textContent.trim());
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