<!-- Table -->
<section class="datagrid-panel">
	<div class="content">
		<div class="panel">
			<div class="content-header no-mg-top">
				<i class="fa fa-location-arrow"></i>
				<div class="content-header-title">Provinsi Kalimantan Tengah</div>
				<?php if ($active_user->group_id=='2') { 
					echo '<p class="text-center">'.$active_user->direktorat.'</p>';
				} ?>
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
		url						: "<?php echo base_url() . 'semester2_v1/data'; ?>",
		primaryField			: 'id_validasi', 
		rowNumber				: true,
		searchInputElement 		: '#search', 
		searchFieldElement 		: '#search-option', 
		pagingElement 			: '#paging', 
		optionPagingElement 	: '#option', 
		pageInfoElement 		: '#info',
		columns					: [
		{field: 'nama_kategori_direktorat', title: 'Lembar Kerja', editable: true, sortable: false, width: 200, align: 'left', search: true},
		{field: 'menu3', title: 'Sesi I', sortable: false, width: 400, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			return menu3(rowData, rowIndex)
		}
		},
		{field: 'menu', title: 'Download', sortable: false, width: 200, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			return menu(rowData, rowIndex)
		}
		},
		{field: 'upload_On', title: 'Uploaded On', sortable: false, width: 200, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["upload_on"]==null){
				return "-"
			}else{
				return rowData["upload_on"]
			}
		}
		},
		{field: 'nama_V', title: 'Uploaded By', sortable: false, width: 200, align: 'center', search: true, 
		rowStyler: function(rowData, rowIndex) {
			if (rowData["nama_v"]==null){
				return "-"
			}else{
				return rowData["nama_v"]
			}
		}
		},
		{field: 'menu2', title: 'Upload', sortable: false, width: 200, align: 'center', search: false, 
		rowStyler: function(rowData, rowIndex) {
			return menu2(rowData, rowIndex)
		}
		}
	]
});

	datagrid.run();


	function menu(rowData, rowIndex) {
		var menu = '<a href="javascript:;" onclick="main_routes(\'download\', \''+rowData["id_lembar_kerja"]+'\')"><i class="fa fa-file-excel-o" style="color:green" ></i></a> ' 
		return menu;
	}

	function menu2(rowData, rowIndex) {
		if (rowData["file_validasi"]!=""){
			var menu = '<p>'+rowData["file_validasi"]+'</p><a href="javascript:;" onclick="main_routes(\'upload\', \''+rowIndex+'\')"><i class="fa fa-upload" ></i>Upload</a> '
		}else{
			var menu = '<a href="javascript:;" onclick="main_routes(\'upload\', \''+rowIndex+'\')"><i class="fa fa-upload" ></i>Upload</a> '
		}
		return menu;
	}

	function menu3(rowData, rowIndex) {
		var a='<select id="status'+rowIndex+'" class="form-control" onchange="myFunction(this.value,\''+rowData["id_validasi"]+'\')">';
		var c= '<?php foreach ($status as $key => $st) { echo '<option value="'.$st->id_status.'">'.$st->status.'</option>'; }; echo '</select>'; ?>';
		var menu = a+c;
		return menu;
	}

	function download(rowIndex) {
		window.location.href = "<?php echo base_url() . 'semester1_d/download/'; ?>" + rowIndex;
	}

	function upload(rowIndex) {
		$('.datagrid-panel').fadeOut()
		$('.loading-panel').fadeIn()
		$.post("<?php echo base_url() . 'semester1_v1/form'; ?>", {index : rowIndex}).done(function(data) {
			$('.form-panel').html(data)
		})
	}

	function main_routes(action, rowIndex) {
		if (action == 'upload') {
			upload(rowIndex);
		} else if (action == 'download') {
			download(rowIndex);
		}
	}

	function color_row(){
		var td = document.getElementsByTagName("td");
		var tr = document.getElementsByTagName("tr");

		<?php $i=0; ?>
		for(var i = 1, j = tr.length; i < j; ++i){ 
			var a=i-1;
			var e = document.getElementById("status"+a);
			if 	(e.options[e.selectedIndex].value == '1') {
					tr[i].style.backgroundColor = "lightgray";
				}else if (e.options[e.selectedIndex].value== '2'){
					tr[i].style.backgroundColor = "tomato";
				}else if (e.options[e.selectedIndex].value== '3'){
					tr[i].style.backgroundColor = "lightskyblue";
				}else if (e.options[e.selectedIndex].value== '4'){
					tr[i].style.backgroundColor = "mediumseagreen";
				}else{
					alert(document.querySelector('#status<?php echo $i; ?> option:checked').textContent);
				}
				<?php $i++; ?>
		}
	}

	function myFunction(val,index){   
		console.log("<?php echo base_url() . 'semester1_v1/update_status/'; ?>"+index);
            $.ajax({
                url : "<?php echo base_url() . 'semester1_v1/update_status/'; ?>"+index,
                method : "POST",
                data : {id: val},
                async : false,
                dataType : 'json',
                success: function(data){
                    swal({   
					title: "Update successfully",   
					text: "Status is now changed! ",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					cancelButtonText: "Cancel",
					confirmButtonText: "Okay",
					closeOnConfirm: true 
                }, function() {
					color_row();
				});
            }
        });
	}

	$(document).ready(function() {
		setTimeout(function(){
			<?php $i=0;  foreach ($status_aktif as $key => $value) {
				echo '
				var val = "'.$value->id_status.'";
				var sel = document.getElementById("status'.$i++.'");
				var opts = sel.options;
				for (var opt, j = 0; opt = opts[j]; j++) {
					if (opt.value == val) {
					sel.selectedIndex = j;
					// break;
					}
				}';
			}?>
			
		},2000);
		setTimeout(function(){
			color_row();
		},3000);
		
		});
		
		$(document).on("click", "#paging > li > a", function( event ){
			setTimeout(function(){
				color_row();
			},500);
		});

</script>