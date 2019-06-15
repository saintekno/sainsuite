	<footer class="container footer">
		Executed in {elapsed_time} seconds, using {memory_usage}.<br />
		Powered by <a href="#" target="_blank">&nbsp;Racik</a> <?php echo RACIK_VERSION; ?>
	</footer>

	<div id="debug"><!-- Stores the Profiler Results --></div>
	
    <script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"></script>
    <script src="<?php echo js_path(); ?>modernizr-2.5.3.js"></script>
	<?php
	Assets::add_js(array('bootstrap.min.js', 'jwerty.js'));
	echo Assets::js(); 
	?>
</body>
</html>