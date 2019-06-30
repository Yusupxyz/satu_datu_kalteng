<div class="top-banner">
	<div class="top-banner-title">Dashboard</div>
	<div class="top-banner-subtitle">Welcome back, <?php echo $active_user->nama; ?>, <?php echo $active_user->username; ?> 
	<?php if($active_user->group_id=='3'){ echo ', '. $active_user->kabupaten_kota; } ?>
	<?php if($active_user->group_id=='2'){ echo ', '. $active_user->direktorat; } ?>
	</div>
</div>