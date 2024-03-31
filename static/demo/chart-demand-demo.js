var ctx = document.getElementById("demand");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["8月", "9月", "10月", "11月"],
        datasets: [{
                type: "bar",
                label: "當前庫存",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 178, 235, 1)",
                data: [1050, 2400, 1600, 1750],
                lineTension: 1, // 曲線的彎度，設 0 表示直線
                fill: false // 是否填滿色彩
            },
            {
                type: "bar",
                label: "需求庫存",
                borderColor: "rgba(92, 258, 235, 1)",
                data: [1500, 1800, 1500, 1600],
                lineTension: 1, // 曲線的彎度，設 0 表示直線
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
                    max: 2500,
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