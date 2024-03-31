var ctx = document.getElementById("Retention");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["活動A", "活動B", "活動C", "活動d"],
        datasets: [{
                type: "bar",
                label: "本期留存率",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                data: [38, 12, 26, 24],
                lineTension: 0, // 曲線的彎度，設 0 表示直線
                fill: false // 是否填滿色彩
            },
            {
                type: "bar",
                label: "上年同期留存率",
                borderColor: "rgba(72, 258, 235, 1)",
                data: [35, 18, 30, 38],
                lineTension: 0, // 曲線的彎度，設 0 表示直線
                fill: false // 是否填滿色彩
            }
        ]
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100,
                    maxTicksLimit: 5
                },
                gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                }
            }],
        },
        legend: {
            display: false
        }
    }
});