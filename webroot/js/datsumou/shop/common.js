// 口コミの開閉
$(function() {
  const trigger = ".shop-kuchikomi-list";
  const triggered = ".shop-kuchikomi-item-below";
  const arrows = ".shop-kuchikomi-arrow";
  $(trigger).click(function() {
    var index = $(trigger).index(this);
    $(triggered)
      .eq(index)
      .toggle();
    $(arrows).toggleClass("fa-chevron-down fa-chevron-up");
  });
});
