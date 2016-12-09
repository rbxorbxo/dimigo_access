</div><!-- /#wrapper -->

<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="/js/plugins/morris/raphael.min.js"></script>
<!--script src="/js/plugins/morris/morris.min.js"></script-->
<!--script src="/js/plugins/morris/morris-data.js"></script-->

<!-- Custom Files -->
<script src="/js/custom.js"></script>

<script>
$(document).ready(function () {
  var msg = '<?=$this->session->userdata("message")?>';
  if (msg) alert(msg);

  $("#<?=isset($active) ? $active : ""?>").addClass("active");
  console.log(<?=$active?>);
});
</script>

</body>
</html>
