const morekeys = ['comment', 'staff', 'news', 'blog'];
const moreprefix = `more-content-`;

window.addEventListener('load', () => {
    hideMoreContents()
});

function hideMoreContents() {
    for (const key of morekeys) {
        $(`.${moreprefix}${key}`).each(function (index, element) {
            if (index >= 3) {
                const jqueryObject = $(element);
                jqueryObject.hide();
            }
        })
    }
}

function detectIsHidden(jqueryObject) {
    return jqueryObject.css('display') == 'none';
}

function moreButtonTapped(key) {
    if (!morekeys.includes(key)) return;
    let counter = 0;
    $(`.${moreprefix}${key}`).each(function (index, element) {
        if (counter === 3) return true;
        const jqueryObject = $(element);
        const isHidden = detectIsHidden(jqueryObject);
        if (isHidden) {
            jqueryObject.show();
            counter++;
        }
    })
}