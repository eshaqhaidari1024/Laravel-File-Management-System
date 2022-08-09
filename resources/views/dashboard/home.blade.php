<div class="row" class="col-md-12 col-sm-12" style="margin: 2%; margin-bottom: 10%">
    <div class="row">
    <div class="col-md-3">
            <div class="dv-container" id="dv-2">
                <p class="a-title ">ریاست عواید و محاسبه</p>
                <div class="overlay">
                    <p class="text">{{\App\Models\Riasat::find(1)->departments->count()}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
          <div class="dv-container" id="dv-1">
              <p class="a-title">ریاست تخنیکی و خدمات مسلکی</p>
              <div class="overlay">
                  <p class="text">{{\App\Models\Riasat::find(2)->departments->count()}}</p>
              </div>
          </div>
        </div>

        <div class="col-md-3">
            <div class="dv-container" id="dv-3">
                <p class="a-title">ریاست حکومت داری شهری</p>
                <div class="overlay">
                    <p class="text">{{\App\Models\Riasat::find(3)->departments->count()}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dv-container" id="dv-4">
                <p class="a-title">مجموع کل فایل ها</p>
                <div class="overlay">
                    <p class="text">{{\App\Models\CreateLetter::count('riasat_id')}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">

        <h4>گزارش روزانه مکاتیب</h4>
        <canvas id="myChartDaily" height="120px"  ></canvas>
        <h4>گزارش ماهوار  مکاتیب</h4>
        <canvas id="myChart" height="120px"  ></canvas>

        <h4>گزارش هفته وار  مکاتیب</h4>
        <canvas id="myChartWeekly" height="120px"  ></canvas>



    </div>


</div>

<script src="{{ asset("assets/plugin/chart.js/Chart.bundle.min.js") }}"></script>
<script>

    $(document).ready(function(){
        var url = "{{route('chart.list')}}";
        var Years = new Array();
        var labels = new Array();
        var Prices = new Array();
        $.get(url, function(response){
            response.forEach(function(data){
                Years.push(data.date);

                Prices.push(data.total);
                switch (data.date){
                    case 1:
                        labels.push('حمل');
                        break;
                    
                    case 2:
                        labels.push('ثور');
                        break;
                    case 3:
                        labels.push('جوزا');
                        break;
                    case 4:
                        labels.push('سرطان');
                        break;
                    case 5:
                        labels.push('اسد');
                        break;
                    case 6:
                        labels.push('سنبله');
                        break;
                    case 7:
                        labels.push('میزان');
                        break;
                    case 8:
                        labels.push('عقرب');
                        break;
                    case 9:
                        labels.push('قوس');
                        break;
                    case 10:
                        labels.push('جدی');
                        break;
                    case 11:
                        labels.push('دلو');
                        break;
                    case 12:
                        labels.push('حوت');
                        break;

                }
            });
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:labels,
                    datasets: [{
                        label: 'گزارش ماهانه آپلود فایل',
                        data: Prices,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
        var url_dialy="{{route('chart.daily.list')}}";
        var daily = new Array();
        var label_dialy = new Array();
        var total_daily = new Array();
        /*get Dialy Report*/
        $.get(url_dialy, function(response){
            response.forEach(function(data){
                label_dialy.push(data.date);

                total_daily.push(data.total);

            });
            var ctx = document.getElementById("myChartDaily").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels:label_dialy,
                    datasets: [{
                        label: 'گزارش روزانه آپلود فایل',
                        data: total_daily,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });

        /*My Chart Weekly*/
        var url_weekly="{{route('chart.weekly.list')}}";
        var week = new Array();
        var label_week = new Array();
        var total_week = new Array();
        $.get(url_weekly, function(response){
            response.forEach(function(data){
                label_week.push(data.date);

                total_week.push(data.total);

            });
            var ctx = document.getElementById("myChartWeekly").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:label_week,
                    datasets: [{
                        label: 'گزارش هفته وار آپلود فایل',
                        data: total_week,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    });


</script>



