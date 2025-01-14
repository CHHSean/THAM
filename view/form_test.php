<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>日曆</title>
    <link rel="stylesheet" type="text/css" href="Calendar.css">
    <script type="text/javascript" src="Calendar.js"></script>
</head>

<body>
    <div id="calendar" class="calendar">
        <div class="prev">
            <button id="prev_M">上個月</button>
        </div>

        <span id="month"></span>月<span id="year"></span>年

        <div class="next">
            <button id="next_M">下個月</button>
        </div>
    </div>

    <div style="clear:both"></div>
    <!--日曆主體-->
    <div id="calendar_weektitle"></div>
    <div id="calendar_weekday"></div>
    <div style="clear:both;"></div>
    <!--報名信息-->
    <div id="regis"><span id="reg_i" style="color:green;">●</span> 是否可報名</div>
    <div id="instalment">月份/批次</div>
</body>

</html>
<script>
    window.onload = function() { //為日曆寫入月份頭部     
        function Calendar() {
            var weeks = ['日', '一', '二', '三', '四', '五', '六'];
            for (i = 0; i < weeks.length; i++) {
                var div = document.createElement('div');
                div.id = 'week_' + i;
                div.innerHTML = weeks[i];
                div.style.width = '14%';
                div.style.height = '35px';
                div.style.lineHeight = div.style.height;
                div.style.backgroundColor = '#ccc';
                div.style.float = 'left';
                div.style.textAlign = 'center';
                document.getElementById('calendar_weektitle').appendChild(div);
            }
            alert("1");
        }

        //構造原型對象
        Calendar.prototype = {
            //取閏年函數
            isLeap: function(year) {
                return (year % 100 !== 0 && year % 4 == 0) || (year % 400 == 0);
            },
            //返回本年本月的天數
            getDaysNum: function(year, month) {
                var num = 31; //大月
                switch (month) {
                    case '2':
                        num = this.isLeap(year) ? 29 : 28;
                        break; //小月
                    case 4:
                    case 6:
                    case 9:
                    case 11:
                        num = 30;
                        break;
                }
                return num;
            },
            //返回本月的第一天是周幾
            getWeek: function(year, month) {
                var d = new Date();
                // var m=d.getMonth()+1;
                // var y=d.getYear();

                d.setYear(year);
                d.setMonth(month - 1);
                d.setDate(1);
                var weeks = ['7', '1', '2', '3', '4', '5', '6'];
                return weeks[d.getDay()];

            },
            //核心函數，寫入日曆
            show: function(year, month) {
                var weekFirstDay = this.getWeek(year, month);
                var dayCount = this.getDaysNum(year, month);
                console.log(weekFirstDay);
                //得到本月頭是周幾，併在前面插入空天數
                if (weekFirstDay != '7') {
                    for (var i = 0; i < weekFirstDay; i++) {
                        var div_1 = document.createElement('div');
                        div_1.style.cursor = 'pointer';
                        div_1.innerHTML = '';
                        div_1.style.width = '14%';
                        div_1.style.height = '40px';
                        //                    div_1.style.lineHeight = div_1.style.height / 2;
                        div_1.style.float = 'left';
                        div_1.style.textAlign = 'center';
                        document.getElementById('calendar_weekday').appendChild(div_1);
                    }
                }
                //得到本月的天數，按規則格式註入天數
                for (i = 0; i < dayCount; i++) {
                    var div_2 = document.createElement('div');
                    div_2.style.cursor = 'pointer';
                    div_2.id = 'day_' + year + '_' + month + '_' + (i + 1);
                    console.log(div_2.id);
                    div_2.innerHTML = i + 1 + '<br />';
                    div_2.style.width = '14%';
                    div_2.style.height = '40px';
                    //                div_2.style.lineHeight = div_2.style.height / 2;
                    div_2.style.float = 'left';
                    div_2.style.textAlign = 'center';
                    document.getElementById('calendar_weekday').appendChild(div_2);
                }

            },
            //跳轉上個月，月份減一
            PreMonth: function() {
                this.PreDraw(new Date(this.Year, this.Month - 2, 1));
            },
            //跳轉下個月，月份加一
            NextMonth: function() {
                this.PreDraw(new Date(this.Year, this.Month, 1));
            },
            //重繪
            PreDraw: function(date) {
                this.Year = date.getFullYear();
                this.Month = date.getMonth() + 1;
                this.Draw();
            }
        };
        alert('2');
        //對象實例化
        Calen = new Calendar();
        //獲取本地時間
        var data = new Date();
        m = data.getMonth() + 1;
        y = data.getFullYear();
        d = data.getDate();
        //寫入本月天數
        Calen.show(y, m);
        var today = document.getElementById('day_' + y + '_' + m + '_' + d);
        today.style.backgroundColor = '#ffcd3c';

        document.getElementById("year").innerHTML = y;
        document.getElementById("month").innerHTML = m;
        alert('3');
        //跳轉到下個月
        document.getElementById("next_M").onclick = function() {
            var div = document.getElementById("calendar_weekday");
            div.innerHTML = "";
            if (m > 0 && m < 12) {
                m += 1;
            } else if (m > 1) {
                m = 1;
                y += 1;
            } else if (m == 12) {
                m = 1;
                y += 1;
            }
            Calen.show(y, m);
            document.getElementById("year").innerHTML = y;
            document.getElementById("month").innerHTML = m;
        };

        //跳轉到上一月
        document.getElementById("prev_M").onclick = function() {
            var div = document.getElementById("calendar_weekday");
            div.innerHTML = "";
            if (m > 1 && m < 12) {
                m -= 1;
            } else if (m <= 1) {
                m = 12;
                y -= 1;
            } else if (m == 12) {
                m -= 1;
            }
            Calen.show(y, m);
            document.getElementById("year").innerHTML = y;
            document.getElementById("month").innerHTML = m;
        };
    }; 
    </script>