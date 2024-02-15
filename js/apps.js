(function ($) {
  //code

  // Spotlight Sticky Songs
  $(window).on("load resize", function () {
    if (this.matchMedia("(max-width: 998px)").matches) {
      $("#stickyScrollMagic").removeClass("stickyScrollMagic");
    } else {
      $("#stickyScrollMagic").addClass("stickyScrollMagic");
    }
  });

  // JQuery Onload
  $(function () {
    // Popular songs carousel
    // $('#popular-songsCarousel').height("+=10");
  });
})(jQuery);
