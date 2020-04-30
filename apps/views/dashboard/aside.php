<aside class="main-sidebar"> 
	<section class="sidebar"> 
		<!-- Sidebar user panel -->
		<?php echo $this->events->apply_filters('before_dashboard_menu', '');?>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu" data-widget="tree">
			<?php Menu::load(); ?>
		</ul>
		<!-- /.sidebar-menu -->
		<a type="button" class="sidebar-footer" data-toggle="push-menu" role="button">
			<i class="fa fa-angle-double-left"></i>
		</a>
	</section>
	<!-- /.sidebar --> 
</aside>
