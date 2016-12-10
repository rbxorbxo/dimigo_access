</div><!-- /#wrapper -->

<script>
$(document).ready(function () {
  var msg = '<?=$this->session->userdata("message")?>';
  if (msg) alert(msg);

  $("#<?=isset($active) ? $active : ""?>").addClass("active");
});
</script>

</body>
</html>
