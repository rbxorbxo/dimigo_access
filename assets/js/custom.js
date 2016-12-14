function getSegments(url) {
  return url.split(/[/]+/);
}

$(document).ready(function() {
  $("#footer-margin").css("height", $("#footer").outerHeight());
});
$(window).resize(function() {
  $("#footer-margin").css("height", $("#footer").outerHeight());
});
