var ctx = document.getElementById("forecast");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["8月", "9月", "10月", "11月"],
        datasets: [{
                type: "bar",
                label: "實際需求",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 178, 235, 1)",
                data: [1558, 1905, 1604, 1785],
                lineTension: 1, // 曲線的彎度，設 0 表示直線
                fill: false // 是否填滿色彩
            },
            {
                type: "bar",
                label: "預測需求",
                borderColor: "rgba(92, 258, 235, 1)",
                data: [1500, 1800, 1500, 1600],
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
                    max: 2000,
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
    },
    animation: { // 这部分是数值显示的功能实现
        onComplete: function() {
            var ctx = this.chart.ctx;
            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
            ctx.fillStyle = "black";
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function(dataset) {
                for (var i = 0; i < dataset.data.length; i++) {
                    for (var key in dataset._meta) {
                        var model = dataset._meta[key].data[i]._model;
                        ctx.fillText(dataset.data[i], model.x, model.y - 5);
                    }
                }
            });
        }
    }
});