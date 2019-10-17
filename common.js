$(function () {
  var $serif = $('.serifTop'),
    $scroll = $('.is-scroll');
  if ($serif.text() !== null) {
    var dist = $scroll.offset().top - $serif.position().top;
    $('.is-hidden').animate({ scrollTop: $scroll.scrollTop() + dist }, 1500);
  }
});
