jQuery(document).ready(function ($) {
  $(".tab").on("click", function () {
    var filterLocation = $(this).data("location");

    $(".careers").hide();

    $('.careers[data-location*="' + filterLocation + '"]').show();
  });
});
