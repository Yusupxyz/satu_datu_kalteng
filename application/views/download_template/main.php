<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-newspaper-o"></i>
				<div class="content-header-title">Download Template Lembar Kerja</div>
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
		url						: "<?php echo base_url() . 'download_template/data'; ?>",
		primaryField			: 'id', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'nama_kategori_direktorat', title: 'Kategori Direktorat', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'Template', title: 'Download', sortable: false, width: 200, align: 'left', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["template"]=="Tidak Ada"){
				return "Tidak Ada"
			}else{
				return menu(rowData,rowIndex)
			}
		}}
		]
})

	datagrid.run()

	function menu(rowData, rowIndex) {
		var menu = '<a href="javascript:;" onclick="main_routes(\'download\', \''+rowData["id"]+'\')"><i class="fa fa-file-excel-o" style="color:green" ></i></a> ' +rowData["template"]
		return menu
	}

	function download(rowIndex) {
		window.location.href = "<?php echo base_url() . 'download_template/download/'; ?>" + rowIndex;
	}

	function main_routes(action, rowIndex,rowData) {
		if (action == 'download') {
			download(rowIndex);
		}
	}

	
</script>