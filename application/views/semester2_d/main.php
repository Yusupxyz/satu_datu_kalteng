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
				<div class="content-header-title">Validasi Lembar Kerja (Semester II)</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content-box">
						<div class="content-box-header">
							<div class="row">
							<div class="col-md-6">
									<!-- <button class="btn btn-primary" onclick="main_routes('create', '')"><i class="fa fa-pencil"></i> Upload New Lembar Kerja</button> -->
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
		url						: "<?php echo base_url() . 'semester2_d/data'; ?>",
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
		{field: 'Status', title: 'Status', sortable: false, width: 1000, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["status"]==null){
				return "-"
			}else{
				return rowData["status"]
			}
		}
		},
		{field: 'Download_on', title: 'Downloaded On', sortable: false, width: 750, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["download_on"]==null){
				return "-"
			}else{
				return rowData["download_on"]
			}
		}
		},
		{field: 'Download_by', title: 'Downloaded By', sortable: false, width: 750, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["nama_kk"]==null){
				return "-"
			}else{
				return rowData["nama_kk"]
			}
		}
		},
		{field: 'upload_On', title: 'Uploaded On', sortable: false, width: 750, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["upload_on"]==null){
				return "-"
			}else{
				return rowData["upload_on"]
			}
		}
		},
		{field: 'Uploaded_by', title: 'Uploaded By', sortable: false, width: 450, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["nama_admin"]==null){
				return "-"
			}else{
				return rowData["nama_admin"]
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
		if (rowData["template"]!=""){
			var menu = '<a href="javascript:;" onclick="main_routes(\'download\', \''+rowData["id_template"]+'\',\''+rowData["id_lembar_kerja"]+'\')"><i class="fa fa-file-excel-o" style="color:green" ></i></a> ' 
			return menu
		}else{
			return "-"
		}
		return menu;
	}

	function download(rowIndex) {
		window.location.href = "<?php echo base_url() . 'semester2_d/download/'; ?>" + rowIndex;
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
			for(var k = 0, l = 9*i; k < l; ++k){
			if (td[l-6].textContent.trim() == 'BELUM VALID') {
				tr[i].style.backgroundColor = "lightgray";
				}else if (td[l-6].textContent.trim() == 'INVALID'){
					tr[i].style.backgroundColor = "tomato";
				}else if (td[l-6].textContent.trim() == 'VALID'){
					tr[i].style.backgroundColor = "lightskyblue";
				}else if (td[l-6].textContent.trim() == 'FINAL'){
					tr[i].style.backgroundColor = "mediumseagreen";
				}else{
					// alert(td[l-6].textContent.trim());
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