// 口コミの開閉
$(function () {
    const trigger = '.brand-kuchikomi-arrow'
    const triggered = '.brand-kuchikomi-item-below'
    $(trigger).click(function () {
        var index = $(trigger).index(this)
        $(triggered).eq(index).toggle()
        $(trigger).toggleClass('fa-chevron-down fa-chevron-up')
    })
})
