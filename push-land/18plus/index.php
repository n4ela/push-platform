<script type="text/javascript">
history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
window.addEventListener('popstate', function(event) {
    window.location.assign("#");
});
</script>
<?php
require_once "Mobile_Detect.php";
$detect = new Mobile_Detect;

if ( $detect->isMobile() ) {
  include ("./index_mobile.php");
} else {
  include ("./index_desktop.php");
}
?>