/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: dashboard hr Js File
*/

import ApexCharts from "apexcharts";

class DashboardHR {
    initRadialChart() {

        var totalEmployeeChart = "";
        var totalApplicationChart = "";
        var hiredCandidatesChart = "";
        var rejectedCandidatesChart = "";

        function loadCharts() {
            //  Total Employee
            var totalEmployeeColors = "";
            totalEmployeeColors = ["#2b7fff"];
            if (totalEmployeeColors) {
                var options = {
                    series: [10],
                    chart: {
                        height: 110,
                        type: 'radialBar',
                        parentHeightOffset: 0,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: '50%',
                            },
                            track: {
                                margin: 2,
                            },
                            dataLabels: {
                                show: false
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -15,
                            bottom: -15
                        }
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: ['Total Employee'],
                    colors: totalEmployeeColors
                };

                if (totalEmployeeChart != "")
                    totalEmployeeChart.destroy();
                totalEmployeeChart = new ApexCharts(document.querySelector("#totalEmployee"), options);
                totalEmployeeChart.render();
            }

            //  Total Application
            var totalApplicationColors = "primary";
            totalApplicationColors = ["var(--color-purple-500)"];
            if (totalApplicationColors) {
                var options = {
                    series: [60],
                    chart: {
                        height: 110,
                        type: 'radialBar',
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: '50%',
                            },
                            track: {
                                margin: 2,
                            },
                            dataLabels: {
                                show: false
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -15,
                            bottom: -15
                        }
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: ['Total Employee'],
                    colors: totalApplicationColors
                };

                if (totalApplicationChart != "")
                    totalApplicationChart.destroy();
                totalApplicationChart = new ApexCharts(document.querySelector("#totalApplication"), options);
                totalApplicationChart.render();
            }

            //  Hired Candidates
            var hiredCandidatesColors = "";
            hiredCandidatesColors = ["#00c951"];
            if (hiredCandidatesColors) {
                var options = {
                    series: [25],
                    chart: {
                        height: 110,
                        type: 'radialBar',
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: '50%',
                            },
                            track: {
                                margin: 2,
                            },
                            dataLabels: {
                                show: false
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -15,
                            bottom: -15
                        }
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: ['Total Employee'],
                    colors: hiredCandidatesColors
                };

                if (hiredCandidatesChart != "")
                    hiredCandidatesChart.destroy();
                hiredCandidatesChart = new ApexCharts(document.querySelector("#hiredCandidates"), options);
                hiredCandidatesChart.render();
            }

            //  Rejected Candidates
            var rejectedCandidatesColors = "";
            rejectedCandidatesColors = ["#ff6900"];
            if (rejectedCandidatesColors) {
                var options = {
                    series: [75],
                    chart: {
                        height: 110,
                        type: 'radialBar',
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: '50%',
                            },
                            track: {
                                margin: 2,
                            },
                            dataLabels: {
                                show: false
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -15,
                            bottom: -15
                        }
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: ['Total Employee'],
                    colors: rejectedCandidatesColors
                };

                if (rejectedCandidatesChart != "")
                    rejectedCandidatesChart.destroy();
                rejectedCandidatesChart = new ApexCharts(document.querySelector("#rejectedCandidates"), options);
                rejectedCandidatesChart.render();
            }


        }

        window.addEventListener("resize", function () {
            setTimeout(() => {
                loadCharts();
            }, 0);
        });

        loadCharts();
    }

    initApplicationReceivedChart() {
        var options = {
            series: [{
                name: 'Total Application',
                type: 'area',
                data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
            }, {
                name: 'Hired Candidates',
                type: 'line',
                data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
            }],
            chart: {
                height: 315,
                type: 'line',
                stacked: false,
                margin: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                },
                toolbar: {
                    show: false,
                },
            },
            stroke: {
                width: [2, 2],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },

            fill: {
                opacity: [0.03, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            colors: ["#2b7fff", "#00c951"],
            markers: {
                size: 0
            },
            grid: {
                padding: {
                    top: -15,
                    right: 0,
                }
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;

                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#applicationReceivedChart"), options);
        chart.render();

    }

    initTotalProjectChart() {
        //Stacked Columns
        var options = {
            series: [{
                name: 'New',
                data: [44, 55, 41, 67, 22, 43, 14, 55, 41,]
            }, {
                name: 'Pending',
                data: [13, 23, 20, 8, 13, 27, 8, 20, 8,]
            }, {
                name: 'Completed',
                data: [11, 17, 15, 15, 21, 14, 24, 11, 17,]
            }, {
                name: 'Rejected',
                data: [21, 7, 25, 13, 22, 8, 13, 7, 25,]
            }],
            chart: {
                type: 'bar',
                height: 353,
                stacked: true,
                zoom: {
                    enabled: true
                },
                toolbar: {
                    show: false,
                },
                parentHeightOffset: 0,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 2,
                    columnWidth: '25%',
                },
            },
            grid: {
                padding: {
                    top: -15,
                    bottom: 5,
                    right: 0,
                }
            },
            xaxis: {
                categories: ['01', '02', '03', '04',
                    '05', '06', '07', '08', '09'
                ],
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#2b7fff", "#facc15", "#4ade80", "#f87171"],
            legend: {
                position: 'bottom',
            },
            fill: {
                opacity: 1
            }
        };

        var chart = new ApexCharts(document.querySelector("#totalProjectChart"), options);
        chart.render();
    }

    init() {
        this.initRadialChart();
        this.initApplicationReceivedChart();
        this.initTotalProjectChart();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        new DashboardHR().init();
    }, 100);
});
