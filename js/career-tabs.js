jQuery(document).ready(function ($) {
  $(".tab").on("click", function () {
    let filterLocation = $(this).data("location");
    let filterMenu = $(this).data("menuCategory");

    $(".careers").hide();
    $(".cla-menu").hide();

    $('.careers[data-location*="' + filterLocation + '"]').show();
    $('.cla-menu[data-menu-category*="' + filterMenu + '"]').show();
  });
});
