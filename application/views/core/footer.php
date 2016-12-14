<div id="footer-margin"></div>

<!-- Footer -->
<div id="footer">
  <!-- Copyright -->
  <ul class="copyright">
    <li>&copy; 2016 Passionate Silver. All rights reserved.</li><li>2016 Dimigo Hackathon</li><li>Team Passionate Silver</li>
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
