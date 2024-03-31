var ctx = document.getElementById("current-performance");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["9月", "10月", "11月", "12月"],
        datasets: [{
                type: "bar",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                label: "取得成本",
                data: [60, 72, 90, 100]
            },
            {
                type: "line",
                label: "獲取率",
                data: [25, 13, 30, 35],
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