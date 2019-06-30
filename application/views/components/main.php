<?php $this->load->view('components/head'); ?>
<?php $this->load->view('modal'); ?>

<div class="top-nav">
	<div class="top-nav-box">
		<div class="side-nav-mobile"><i class="fa fa-bars"></i></div>
		<div class="logo-wrapper">
			<div class="logo-box">
				<img alt="pongo" src="<?php echo base_url() . 'assets/images/logo3.png'; ?>">
				<a href="<?php echo base_url(); ?>">
					<div class="logo-title">Satu Data KKP Kalteng</div>
				</a>
			</div>
		</div>
		<div class="top-nav-content">
			<div class="top-nav-box">
				<div class="quick-link">
					<div class="link-icon"></div>
				</div>
				<div class="user-top-profile">
					<div class="user-image">
						<div class="user-on"></div>
						<img alt="pongo" style="width: 40px;height: 40px;" src="<?php echo base_url().'foto/'.$picture_users; ?>">
					</div>
					<div class="clear">
						<div class="user-name"><?php echo $active_user->nama; ?></div>
						<div class="user-group"><?php echo $active_user_group->group_nama; ?></div>
						<ul class="user-top-menu animated bounceInUp">
							<?php if($active_user->group_id=='3'){ ?>
							<li><a href="<?php echo base_url() . 'profile_mahasiswa'; ?>">Profile</a></li>
							<?php } ?>
							<li><a href="<?php echo base_url() . 'change_picture'; ?>">Change Picture</a></li>
							<li><a href="<?php echo base_url() . 'change_password'; ?>">Change Password</a></li>
							<li><a href="<?php echo base_url() . 'auth/logout'; ?>">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="profile-nav-mobile"><i class="fa fa-cog"></i></div>
	</div>
</div>
<div class="wrapper <?php echo $menu_style != 'default' ? $menu_style : ''; ?>">
	<aside class="side-nav">
		<div class="user-side-profile">
			<div class="user-image">
				<div class="user-on"></div>
				<img alt="pongo" src="<?php echo base_url().'foto/'.$picture_users; ?>" style="width: 60px;height: 60px;">
			</div>
			<div class="clear">
				<div class="user-name"><?php echo $active_user->nama; ?></div>
				<div class="user-group"><?php echo $active_user_group->group_nama; ?></div>
				<ul class="user-side-menu animated bounceInUp">
					<?php if($active_user->group_id=='3'){ ?>
					<li><a href="<?php echo base_url() . 'profile_mahasiswa'; ?>">Profile</a></li>
					<?php } ?>
					<li><a href="<?php echo base_url() . 'change_picture'; ?>">Change Picture</a></li>
					<li><a href="<?php echo base_url() . 'change_password'; ?>">Change Password</a></li>
					<li><a href="<?php echo base_url() . 'auth/logout'; ?>">Logout</a></li>
				</ul>
			</div>
		</div>
		<div class="main-menu-title">Menu</div>
		<div class="main-menu">
			<ul>
				<li class="<?php echo $active_menu == 0 ? 'active' : ''; ?>">
					<a href="<?php echo base_url(); ?>">
						<i class="fa fa-bars"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<?php foreach ($list_menu as $key => $menu) { ?>
				<?php if ($menu->id <= 10) { ?>
				<!-- Print parent menu -->
				<?php if ($menu->parent_id == 0 && $menu->child != 0) { ?>
				<li class="<?php echo $active_menu == $menu->id && $menu_style != 'compact-nav' ? 'active' : ''; ?>">
					<a href="">
						<i class="<?php echo $menu->icon; ?>"></i>
						<span><?php echo $menu->title; ?></span>
					</a>
					<ul>
						<!-- Print submenu -->
						<?php foreach ($list_menu as $submenu) { ?>
						<?php if ($submenu->parent_id == $menu->id) { ?>
						<li><a href="<?php echo base_url() . $submenu->link; ?>"><?php echo $submenu->title; ?></a></li>
						<?php } ?>
						<?php } ?>
					</ul>
				</li>
				<?php } elseif ($menu->parent_id == 0 && $menu->child == 0) { ?>
				<li class="<?php echo $active_menu == $menu->id ? 'active' : ''; ?>">
					<a href="<?php echo base_url() . $menu->link; ?>">
						<i class="<?php echo $menu->icon; ?>"></i>
						<span><?php echo $menu->title; ?></span>
					</a>
				</li>
				<?php } ?>
				<?php } ?>
				<?php } ?>
			</ul>
		</div>
		<div class="side-banner">
			<div class="banner-content">
				<div class="title">SatuData KKP <div class="version">v1.1</div></div>
				<div class="subtitle"><?=get_field('1','settings','meta_value')?></div>
			</div>
		</div>
	</aside>
	<div class="main">
		<?php $this->load->view($subview); ?>
	</div>
</div>

<?php if($active_user->group_id=='3'){ ?>
<div style="padding: 60px;"></div>
<?php $this->load->view('components/menu'); ?>
<?php } ?>

<?php $this->load->view('components/foot'); ?>