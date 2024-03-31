var ctx = document.getElementById("getrate");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["活動A", "活動B", "活動C", "活動d"],
        datasets: [{
                type: "bar",
                label: "目標客群",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 178, 235, 1)",
                data: [26, 15, 24, 26],
                lineTension: 1, // 曲線的彎度，設 0 表示直線
                fill: false // 是否填滿色彩
            },
            {
                type: "bar",
                label: "其他客群",
                borderColor: "rgba(92, 258, 235, 1)",
                data: [14, 31, 25, 33],
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