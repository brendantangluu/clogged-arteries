jQuery(document).ready(function ($) {
  $(".tab").on("click", function () {
    let filter = $(this).data("item");

    $(".tab-class").hide();

    $('.tab-class[data-location*="' + filter + '"]').show();
  });
});
