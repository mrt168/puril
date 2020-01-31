// 口コミの開閉
$(function() {
  const trigger = ".shop-kuchikomi-arrow";
  const triggered = ".shop-kuchikomi-item-below";
  $(trigger).click(function() {
    var index = $(trigger).index(this);
    $(triggered)
      .eq(index)
      .toggle();
    $(trigger).toggleClass("fa-chevron-down fa-chevron-up");
  });
});
