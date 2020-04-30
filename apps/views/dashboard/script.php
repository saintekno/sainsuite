<script type="text/javascript">
// Introducing Angular on RacikCore
<?php echo $this->events->apply_filters( 'load_Do_app', "var eracikApp = angular.module( 'eracikApp', " . json_encode( ( Array ) $this->events->apply_filters( 'dashboard_dependencies', array() ) ) . " );" );?>
</script>
