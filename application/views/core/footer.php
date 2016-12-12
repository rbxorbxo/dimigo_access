<!-- Footer -->
<div id="footer">
  <!-- Copyright -->
  <ul class="copyright">
    <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li>Demo Images: <a href="http://ineedchemicalx.deviantart.com/">Felicia Simion</a> + <a href="http://unsplash.com">Unsplash</a></li>
  </ul>
</div>

<script>
$(document).ready(function () {
  var msg = '<?=$this->session->userdata("message")?>';
  if (msg) alert(msg);

  $("#<?=isset($active) ? $active : ""?>").addClass("active");
});
</script>

</body>
</html>
