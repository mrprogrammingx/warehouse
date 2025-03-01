<template>
    <div class="h-100">
        <div class="my-content mx-4 mb-5">
            <div class="row">
                <div class="mt-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="widget-four">
                        <apexchart type="area" height="350" :options="areaOptions" :series="areaData"></apexchart>
                    </div>
                </div>
                <div class="mt-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="widget-four">
                        <apexchart v-if="bardata[0].data!=''" type="bar" height="350" :options="barOptions"
                                   :series="bardata"></apexchart>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="mt-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="widget-four">
                        <apexchart type="pie" width="380" :options="pieOptions" :series="piedata"></apexchart>
                    </div>
                </div>
                <div class="mt-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="widget-four">
                        <div class="widget-heading">
                            <h5 class="">Visitors by Browser</h5>
                        </div>
                        <div class="widget-content">
                            <div class="vistorsBrowser">
                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-chrome">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <circle cx="12" cy="12" r="4"></circle>
                                            <line x1="21.17" y1="8" x2="12" y2="8"></line>
                                            <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                                            <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                                        </svg>
                                    </div>
                                    <div class="w-browser-details">
                                        <div class="w-browser-info">
                                            <h6>Chrome</h6>
                                            <p class="browser-count">65%</p>
                                        </div>
                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                     style="width: 65%" aria-valuenow="90" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-compass">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polygon
                                                points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                                        </svg>
                                    </div>
                                    <div class="w-browser-details">

                                        <div class="w-browser-info">
                                            <h6>Safari</h6>
                                            <p class="browser-count">25%</p>
                                        </div>

                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                     style="width: 25%" aria-valuenow="65" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-globe">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                        </svg>
                                    </div>
                                    <div class="w-browser-details">

                                        <div class="w-browser-info">
                                            <h6>Others</h6>
                                            <p class="browser-count">15%</p>
                                        </div>

                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                     style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="widget-four">
                        <apexchart type="line" height="320" :options="lineOptions" :series="lineData"></apexchart>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import moment from 'moment-jalaali'

export default {
    name: "Chart",
    data() {
        return {
            delivery_array: [],
            reserve_array: [],

            bardata: [
                {
                    name: 'Delivery statistics',
                    data: []
                }
                ,
                {
                    name: 'Food reservation statistics',
                    data: []
                }

            ],

            barOptions: {
                chart: {
                    type: 'bar',
                    height: 350
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [],
                },

                fill: {
                    opacity: 1
                },
                colors: ['#00E396', '#008FFB'],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                }
            },
            piedata: [44, 55, 13, 43, 22],
            pieOptions: {
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            },


            areaData: [{
                name: 'series1',
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: 'series2',
                data: [11, 32, 45, 32, 34, 52, 41]
            }],
            areaOptions: {
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'date',
                    categories: ["1401/05/20", "1401/05/21", "1401/05/22", "1401/05/23", "1401/05/24", "1401/05/25", "1401/05/26"]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            },


            lineData: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            lineOptions: {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Product Trends by Month',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                }
            },
        }
    },
    methods: {
        getStatisticsDelivery() {
            axios.get('/api/food/delivery/statistics/count').then(({data}) => (this.delivery_array = data.data.count))
        },
        getStatisticsReserve() {
            axios.get('/api/food/reservation/statistics/count').then(({data}) => (this.reserve_array = data.data.count, this.pushArrayToSeries()))
        },
        pushArrayToSeries() {
            for (let i = 0; i < this.delivery_array.length; i++) {
                this.bardata[0].data.push(this.delivery_array[i].count)
                this.bardata[1].data.push(this.reserve_array[i].count)
                this.barOptions.xaxis.categories.push(moment(this.delivery_array[i].date).format("jYYYY-jMM-jDD"))

            }
        }

    },
    created() {
        this.getStatisticsDelivery()
        this.getStatisticsReserve()
    }

}
</script>

<style>
#chart {
    width: 100%;
}
.my-content{
    overflow-y: auto;
    height: 85%;
    padding-left: 2%;
    padding-right: 2%;
}

</style>
