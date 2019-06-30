<div class="content">
	<div class="panel">
		<div class="content-header no-mg-top">
			<i class="fa fa-newspaper-o"></i>
			<div class="content-header-title">Hak Akses</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="content-box">
					<div class="content-box-header">
						<div class="box-title">Level User</div>
					</div>
					<table class="table table-striped table-bordered tree">
						<?php foreach ($groups as $key => $group) { ?>
							<tr>
								<td class="list-group" id="<?php echo $group->id; ?>"><?php echo $group->group_nama; ?></td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
			<div class="col-md-9">
				<div class="content-box">
					<div class="content-box-header">
						<div class="box-title">Hak Akses</div>
					</div>
					<table class="table table-striped table-bordered tree">
						<!-- Loop menu -->
						<?php foreach ($menus as $key => $menu) { ?>
							<?php if ($menu->parent_id == 0) { ?>
								<tr class="treegrid-<?php echo $menu->id; ?>">
									<td><input type="checkbox" id="checkbox-<?php echo $menu->id; ?>"> <?php echo $menu->title; ?></td>
								</tr>
								<!-- Loop submenu -->
								<?php foreach ($menus as $key => $submenu) { ?>
									<?php if ($submenu->parent_id == $menu->id) { ?>
										<tr class="treegrid-<?php echo $submenu->id; ?> treegrid-parent-<?php echo $menu->id; ?>">
											<td><input type="checkbox" id="checkbox-<?php echo $submenu->id; ?>"> <?php echo $submenu->title; ?></td>
										</tr>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var group_id, arrId = [];

		$('.tree').treegrid({
			expanderExpandedClass: 'fa fa-folder-open',
			expanderCollapsedClass: 'fa fa-folder' 
		});

		$(".tree input[type='checkbox']").click(function() {
			var checked = $(this).is(':checked');
			if (checked) {
				if ($(this).closest('tr').treegrid('getParentNode') != null) {
					$(this).closest('tr').treegrid('getParentNode').find(":checkbox").prop('checked',true);
				}

				if ($(this).closest('tr').treegrid('getChildNodes') != null) {
					$(this).closest('tr').treegrid('getChildNodes').find(":checkbox").prop('checked',true);
				}
			} else {
				if ($(this).closest('tr').treegrid('getChildNodes') != null) {
					$(this).closest('tr').treegrid('getChildNodes').find(":checkbox").prop('checked',false);
				}
			}
		});

		$("input[type='checkbox']").each(function() {
			$(this).on("click", function() {
				arrId = [];
				$("input[type='checkbox']").each(function() {
					if ($(this).is(':checked')) {
						arrId.push(this.id.substr(9));
					}
				});
				$.post("<?php echo base_url() . 'privilege/action'; ?>", {group_id: group_id, arr_id: arrId});
			});
		});

		$(".list-group").each(function() {
			$(this).on("click", function() {
				group_id = this.id;
				$(".list-group").removeClass('active')
				$(".list-group").css({
					'color': '#263238',
					'background-color': '#fff'
				});
				$(this).addClass('active');
				$(this).css({
					'color': '#fff',
					'background-color': '#0275d8'
				});
				$("input[type='checkbox']").each(function() {
					$(this).prop('checked', false);
				});
				$.post("<?php echo base_url() . 'privilege/load'; ?>", {group_id: this.id}).done(function(data) {
					for (var i = 0; i < data.length; i++) {
						$("#checkbox-" + data[i].menu_id).prop('checked', true);
					}
				});
			});
		});
	});
</script>