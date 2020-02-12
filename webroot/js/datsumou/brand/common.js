// 口コミの開閉
$(function () {
    const trigger = '.brand-kuchikomi-item';
    const triggered = '.brand-kuchikomi-item-below';
    const arrows = '.brand-kuchikomi-arrow';
    $(trigger).click(function () {
        var index = $(trigger).index(this);
        $(triggered).eq(index).toggle();
        $(arrows).toggleClass('fa-chevron-down fa-chevron-up');
    });
});
