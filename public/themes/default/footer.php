    <?php if ( ! isset($show) || $show == true) : ?>
    <hr />
    <footer class="footer">
        <div class="container">
            <p>Powered by <a href="#" target="_blank">Racik <?php echo RACIK_VERSION; ?></a></p>
        </div>
    </footer>

    </div>
    </div>
    <!-- End Content -->
    <?php endif; ?>

    <div id="debug"><!-- Stores the Profiler Results --></div>
    
    <?php
    Assets::add_js(array('jquery-1.7.2.min.js', 'bootstrap.min.js', 'modernizr-2.5.3.js'));

    $inline  = '$(".dropdown-toggle").dropdown();';
    $inline .= '$(".tooltips").tooltip();';
    Assets::add_js($inline, 'inline');
    ?>

    <?php echo Assets::js(); ?>
</body>
</html>