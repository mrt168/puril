// 評価点平均計算
$(function () {
    const rId1 = "#rating1"
    const rId2 = "#rating2"
    const rId3 = "#rating3"
    const rId4 = "#rating4"
    const rId5 = "#rating5"
    const targetNum = "#rating-number-span"
    const targetStar = 'img.rating-star-icon'

    var showStar = function (ave) {
        for (let i = 0; i < 5; i++) {
            var target = $(targetStar).eq(i)
            var num = i + 1
            var aveBiased = ave + 0.5 // NOTE: .1~.5 -> .5, .6~1.0 -> 1.0
            if (num < aveBiased) {
                target.attr('src', '/img/datsumou/star-on-large.png')
            } else {
                if (num - 0.5 < aveBiased) {
                    target.attr('src', '/img/datsumou/star-half-large.png')
                } else {
                    target.attr('src', '/img/datsumou/star-off-large.png')
                }
            }
        }
    }

    var calcAverage = function () {
        r1 = parseFloat($(rId1).val()) || 0
        r2 = parseFloat($(rId2).val()) || 0
        r3 = parseFloat($(rId3).val()) || 0
        r4 = parseFloat($(rId4).val()) || 0
        r5 = parseFloat($(rId5).val()) || 0
        sum = r1 + r2 + r3 + r4 + r5
        ave = Math.round(sum * 10 / 5) / 10

        $(targetNum).html(ave)
        showStar(ave)
    }

    $(rId1).on('change', function () { calcAverage() })
    $(rId2).on('change', function () { calcAverage() })
    $(rId3).on('change', function () { calcAverage() })
    $(rId4).on('change', function () { calcAverage() })
    $(rId5).on('change', function () { calcAverage() })
})

// 簡易アップロード画像プレビュー
$(function () {
    const imageInputId1 = 'image-add1'
    const imageInputId2 = 'image-add2'
    const imageInputId3 = 'image-add3'
    const imageInputId4 = 'image-add4'
    const imageInputId5 = 'image-add5'
    const imagePreviewId1 = 'image-preview1'
    const imagePreviewId2 = 'image-preview2'
    const imagePreviewId3 = 'image-preview3'
    const imagePreviewId4 = 'image-preview4'
    const imagePreviewId5 = 'image-preview5'
    const cancelAfterFix = '-cancel'
    const imageCancelId1 = imagePreviewId1 + cancelAfterFix
    const imageCancelId2 = imagePreviewId2 + cancelAfterFix
    const imageCancelId3 = imagePreviewId3 + cancelAfterFix
    const imageCancelId4 = imagePreviewId4 + cancelAfterFix
    const imageCancelId5 = imagePreviewId5 + cancelAfterFix

    // 画像追加
    var imagesPreview = function (input, targetIdName) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader()
                reader.onload = function (event) {
                    var target = "#" + targetIdName
                    // input要素を非表示
                    $(target + ' .input-image').toggle();
                    // プレビュー画像を追加
                    $($.parseHTML(`
                        <div class="preview-image">
                            <img src=` + event.target.result + `>
                            <i id=` + targetIdName + `-cancel` + ` class="far fa-times-circle preview-image-cancel"></i>
                        </div>
                    `)).appendTo(target)
                }
                reader.readAsDataURL(input.files[i])
            }
        }
    }

    // 画像削除
    var removePreview = function (inputId, cancelId) {
        // プレビュー画像を削除
        $('.preview-image:has(#' + cancelId + ')').remove()
        // 画像データを削除
        $('#' + inputId).val('')
        // input要素を表示
        $('.input-image:has(#' + inputId + ')').toggle()
    }

    $('#' + imageInputId1).on('change', function () {
        imagesPreview(this, imagePreviewId1)
        $(function () {
            $('#' + imageCancelId1).click(function () {
                removePreview(imageInputId1, imageCancelId1)
            })
        })
    })
    $('#' + imageInputId2).on('change', function () {
        imagesPreview(this, imagePreviewId2)
        $(function () {
            $('#' + imageCancelId2).click(function () {
                removePreview(imageInputId2, imageCancelId2)
            })
        })
    })
    $('#' + imageInputId3).on('change', function () {
        imagesPreview(this, imagePreviewId3)
        $(function () {
            $('#' + imageCancelId3).click(function () {
                removePreview(imageInputId3, imageCancelId3)
            })
        })
    })
    $('#' + imageInputId4).on('change', function () {
        imagesPreview(this, imagePreviewId4)
        $(function () {
            $('#' + imageCancelId4).click(function () {
                removePreview(imageInputId4, imageCancelId4)
            })
        })
    })
    $('#' + imageInputId5).on('change', function () {
        imagesPreview(this, imagePreviewId5)
        $(function () {
            $('#' + imageCancelId5).click(function () {
                removePreview(imageInputId5, imageCancelId5)
            })
        })
    })
})
