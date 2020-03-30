function renderCommentChart() {
  const labels = ["接客・サービス", "メニュー・ 料金", "効果", "雰囲気", "予約・立地"];
  // DBから取得
  const testData = [{
    "接客・サービス": 30,
    "メニュー・ 料金": 30,
    "効果": 30,
    "雰囲気": 30,
    "予約・立地": 30
  }, {
    "接客・サービス": 30,
    "メニュー・ 料金": 20,
    "効果": 30,
    "雰囲気": 40,
    "予約・立地": 50
  }, {
    "接客・サービス": 20,
    "メニュー・ 料金": 50,
    "効果": 30,
    "雰囲気": 20,
    "予約・立地": 40
  }]
  // var testData = JSON.parse('<?php echo $teatdata ?>');
  // console.log(testData);
  const charts = document.getElementsByClassName('comment-chart');
  //const width = window.innerWidth - 20;
  for (let i = 0; i < charts.length; i++) {
    const setting = {
      type: 'radar',
      data: {
        labels: labels,
        datasets: [{
          label: null,
          data: [30, 30, 30, 30, 30], // パーセントを直す
          backgroundColor: 'rgba(106, 173, 191, 0.37)',
          borderColor: 'rgba(106, 173, 191, 0.37)',
          borderWidth: 1,
          pointBackgroundColor: 'transparent'
        }]
      },
      options: {
        title: {
          display: false,
          text: null
        },
        scale: {
          ticks: {
            suggestedMin: 0,
            suggestedMax: 50,
            stepSize: 10,
            display: false
          }
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 0
          }
        }
      }
    }
    const key = `commentChart${i + 1}`;
    // 本来ならデータをindexと照らし合わせてとり、アップデートが必要
    const data = [];
    const target = testData[i];
    console.log(target)
    for (const key of labels) {
      data.push(target[key]);
    }
    setting.data.datasets[0].data = data;
    new Chart(document.getElementById(key), setting);
  }


  window.setTimeout(() => {
    $(".chartjs-render-monitor").css("height","auto");
  }, 2000);
}