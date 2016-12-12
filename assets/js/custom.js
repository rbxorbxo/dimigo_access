function getSegments(url) {
  return url.split(/[/]+/);
}

$(document).ready(function() {
  $("#main").css("margin-bottom", $("#footer").outerHeight());
});
$(window).resize(function() {
  $("#main").css("margin-bottom", $("#footer").outerHeight());
});
