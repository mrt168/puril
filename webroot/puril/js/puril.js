$(function() {
  $(".Parts__box .prt .toggle").click(function() {
    depilationSiteCheck(!$(this).hasClass("show"));
    return false;
  });
});

function depilationSiteCheck(bool) {
  $('.Parts__box .cld [type="checkbox"]').prop("disabled", !bool);
  $(".Parts__box .cld").toggleClass("show", bool);
  $(".Parts__box .prt .toggle").toggleClass("show", bool);
}

//ハンバーガーメニュー
$(function() {
  $(document).on("click", ".datsumou-header-inner__navToggle", function() {
    $(".datsumou-header-inner__navToggle").toggleClass("active");
    $(".datsumou-header-inner__globalmenusp").toggleClass("active");
  });

  $(".datsumou-header-inner__globalmenusp__link").on("click", function() {
    if (window.innerWidth <= 768) {
      $(".datsumou-header-inner__navToggle").click();
    }
  });
});
