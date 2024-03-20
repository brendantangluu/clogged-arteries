jQuery(document).ready(function ($) {
  console.log("Tab script loaded."); // Debug: Confirm script is loading

  $(".tab").on("click", function () {
    let filter = $(this).data("term");
    console.log("Tab clicked:", filter); // Debug: Log clicked tab's filter

    $(".tab-class").hide();

    let filteredElements = $('.tab-class[data-term*="' + filter + '"]');
    console.log("Filtered elements found:", filteredElements.length); // Debug: Log count of elements to show

    filteredElements.show();
  });
});
