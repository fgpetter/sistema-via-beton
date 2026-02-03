/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: apps ecommerce order Js File
*/



import ApexCharts from "apexcharts";

// Order overview Charts
class ecommerceOrderChart {
    initOrdersOverview() {
        var options = {
            series: [{
                name: 'Orders',
                data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 3.4, 5.5, 8.8]
            }],
            chart: {
                height: 190,
                type: 'bar',
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                style: {
                    fontSize: '12px',
                }
            },
            grid: {
                padding: {
                    bottom: -10,
                }
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "%";
                    }
                }

            },
            colors: ["#2b7fff"],
        };

        var chart = new ApexCharts(document.querySelector("#ordersOverview"), options);
        chart.render();
    }


    init() {
        this.initOrdersOverview();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        new ecommerceOrderChart().init();
    }, 100);
});