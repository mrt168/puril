// レーダーチャート描画
$(function () {
    // chartjsによる描画
    var drawChart = function (canvasId, data) {
        var ctx = document.getElementById(canvasId)
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['接客・サービス', 'メニュー・料金', '効果', '雰囲気', '予約・立地'],
                datasets: [{
                    data: data,
                    backgroundColor: 'rgba(106, 173, 191, .37)'
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scale: {
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 5,
                        stepSize: 1,
                    },
                    pointLabels: {
                        fontSize: 16
                    }
                }
            }
        })
    }

    // 描画実行
    drawChart('kuchikomiChart1', [4, 3, 2, 4, 5]);
})



