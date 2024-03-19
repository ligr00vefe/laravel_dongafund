<div class="status-chart__wrap">
    <div class="status-chart__contents">
        <div class="sc-con con__top">
            <div class="sc-con__title">
                <h1>최근 5년간 모금 현황</h1>
            </div>
            <div class="status-chart__chart">
                <canvas id="myChart_mix" width="1170" height="620"></canvas>
                <script src="/lib/chart.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.js" integrity="sha512-CAv0l04Voko2LIdaPmkvGjH3jLsH+pmTXKFoyh5TIimAME93KjejeP9j7wSeSRXqXForv73KUZGJMn8/P98Ifg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    Chart.defaults.font.family = 'paybooc-Medium';

                    Chart.defaults.font.size = 16;
                    var ctx = document.getElementById('myChart_mix').getContext('2d');
                    var annual_collection = new Chart(ctx, {
                        type: 'bar',

                        data: {
                            labels: ['2016학년도', '2017학년도', '2018학년도', '2019학년도', '2020학년도'],
                            datasets: [{
                                label: '발전기금',
                                data: [3039910000, 3221165000, 4293530000, 3415882000, 2875924158],
                                borderColor: '#0061AE',
                                backgroundColor: '#0061AE',
                                borderRadius: 10,

                            },
                                {

                                    label: '현물',
                                    data: [98532000, 52716000, 64208000, 30522140, 208501578],
                                    borderColor: '#27A9E1',
                                    backgroundColor: '#27A9E1',
                                    borderRadius: 10,


                                },
                                {
                                    label: '유가증권',
                                    data: [0, 0, 0, 8420000000, 2500140076],
                                    borderColor: '#27A9E1',
                                    backgroundColor: '#27A9E1',
                                    borderRadius: 10,

                                },

                                {
                                    label: '연간모금액',
                                    type: 'line',
                                    borderColor: '#F38E29',
                                    backgroundColor: '#FFFFFF',
                                    data: [3138442000, 3273881000, 4357738000, 11866404140, 5584565812],
                                    borderWidth: 6

                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: false,
                                    text: (ctx) => '최근 5년간 발전기금 모금 추이'
                                },

                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    mode: 'index',
                                    backgroundColor: 'rgba(250, 250, 250, 0.7)',
                                    titleColor: 'rgb(85, 85, 85)',
                                    bodyColor: 'rgb(85, 85, 85)',
                                    bodySpacing: 10,
                                    borderColor: 'rgb(200, 200, 200)',
                                    borderWidth: 1
                                },
                                deffered: {

                                },
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            },
                            animations: {
                                tension: {
                                    duration: 1000,
                                    easing: 'linear',
                                    from: 0,
                                    to: 0.4,
                                },

                            },
                            scales: {
                                x: {

                                    grid: {
                                        display: false,
                                    },
                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: {
                                        font: {
                                            family: 'paybooc-Bold',
                                            size: 16
                                        }
                                    }
                                },
                                y: {
                                    display: false,
                                    grid: {
                                        display: false,
                                    },

                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: {
                                        display: false,
                                    }
                                }
                            }

                        },

                    });

                </script>
            </div>{{-- .status-chart__chart end --}}
        </div>{{-- .sc-con__top end --}}

        <div class="sc-con con__bottom">
            <div class="sc-con con__left annual-result-graph">
                <div class="sc-con__title">
                    <h1>연간 모금현황(2020 회계연도)</h1>
                </div>
                <ul class="status-chart__graph">
{{--                   <li>--}}
{{--                       <div class="img-part">--}}
{{--                           <div class="graph-circle graph-circle01">--}}
{{--                               <span>40.6억</span>--}}
{{--                               <p>원</p>--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                       <div class="text-part">--}}
{{--                           <i class="fas fa-file-signature"></i>--}}
{{--                           <span>--}}
{{--                               약정액--}}
{{--                           </span>--}}
{{--                       </div>--}}
{{--                   </li>--}}

                    <li>
                        <div class="img-part">
                            <div class="graph-circle graph-circle02">
                                <span>55.8억</span>
                                <p>원</p>
                            </div>
                        </div>
                        <div class="text-part">
                            <i class="fas fa-donate"></i><span>모금액</span>
                        </div>
                    </li>

                    <li>
                        <div class="img-part">
                            <div class="graph-circle graph-circle03">
                                <span>2,793</span>
                                <p>명</p>
                            </div>
                        </div>
                        <div class="text-part">
                            <i class="fas fa-users"></i><span>납입자수</span>
                        </div>
                    </li>
                </ul>
            </div>{{-- .sc-con__body-left.annual-result-graph end --}}

            <div class="sc-con con__right donor-name-list">
                <div class="sc-con__title">
                    <h1>이달의 기부자</h1>
                </div>
                <div class="status-chart__table">
                    <ul>
                        @foreach(range(1,50) as $list)
                            <li>
                                <p>
                                    홍*동
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>{{-- .sc-con__body-right.donor-name-list end --}}

        </div>{{-- .sc-con__bottom end --}}
    </div>{{-- .status-chart__contents end --}}
</div>{{-- .status-chart__wrap end --}}
