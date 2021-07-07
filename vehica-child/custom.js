jQuery(document).ready(function ($) {
  var url = window.location.href;
  if (url.includes("action=create")) {
    var $duration_dom = $(".vehica-package__desc__row__value");
    $duration_dom.each(function () {
      let $duration = $.trim($(this).text()).split(" ")[0];
      if ($duration === "900") $(this).text("Listed Until Solid");
    });

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var plan = urlParams.get("plan");
    if (plan) localStorage.setItem("plan", plan);
    else plan = localStorage.getItem("plan");
    console.log("plan", plan);
    if (plan === "regular") {
      $(".vehica-packages .vehica-package:first-child").click();
    } else if (plan === "plus") {
      $(".vehica-packages .vehica-package:nth-child(2)").click();
    } else if (plan === "premium") {
      $(".vehica-packages .vehica-package:last-child").click();
    } else {
      console.log("no listing");
    }
  }
});
