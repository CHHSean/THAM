var ctx = document.getElementById("getChart");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["活動A", "活動B", "活動C", "活動D"],
        datasets: [{
                type: "bar",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                label: "取得成本",
                data: [6347, 5943, 7684, 6745]
            },
            {
                type: "bar",
                backgroundColor: "rgba(54, 258, 235, 0.2)",
                label: "預期目標",
                data: [6500, 6300, 9000, 7000],
                lineTension: 0, // 曲線的彎度，設 0 表示直線
                //fill: true // 是否填滿色彩
            },
            {
                type: "bar",
                backgroundColor: "rgba(102, 243, 146, 0.2)",
                label: "實際結果",
                data: [6658, 6742, 5874, 7200],
                lineTension: 0, // 曲線的彎度，設 0 表示直線
                //fill: true // 是否填滿色彩
            }
        ]
    }
});