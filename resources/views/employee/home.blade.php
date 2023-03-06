@extends('partials.app')
@section('title', 'Dashboard')
@section('main-content')

    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    {{-- <div class="progress-data">
                        <div class="icon" style="width: 80px; height: 102.7px; font-size: 50px; text-align: center">
                            <i class="dw dw-file-6" style="line-height: 2 !important"></i>
                        </div>
                    </div> --}}
                    <div class="progress-data">
                        <div id="chart"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $total_leads }}</div>
                        <div class="weight-600 font-14">All Leads</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    {{-- <div class="progress-data">
                        <div class="icon" style="width: 80px; height: 102.7px; font-size: 50px; text-align: center">
                            <i class="dw dw-folder-23" style="line-height: 2 !important"></i>
                        </div>
                    </div> --}}
                    <div class="progress-data">
                        <div id="chart2"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $pending_leads }}</div>
                        <div class="weight-600 font-14">Total Pending Leads</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    {{-- <div class="progress-data">
                        <div class="icon" style="width: 80px; height: 102.7px; font-size: 50px; text-align: center">
                            <i class="dw dw-file-138" style="line-height: 2 !important"></i>
                        </div>
                    </div> --}}
                    <div class="progress-data">
                        <div id="chart3"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $progress_leads }}</div>
                        <div class="weight-600 font-14">Total In Progress Leads</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    {{-- <div class="progress-data">
                        <div class="icon" style="width: 80px; height: 102.7px; font-size: 50px; text-align: center">
                            <i class="dw dw-tick" style="line-height: 2 !important"></i>
                        </div>
                    </div> --}}
                    <div class="progress-data">
                        <div id="chart4"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $completed_leads }}</div>
                        <div class="weight-600 font-14">Total Completed Leads</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">All Leads-<?php echo date('Y'); ?></h2>
                    <div id="chart5"></div>
                </div>
            </div>
            <div class="col-xl-4 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Complete Leads</h2>
                    <div id="chart6"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        var aData = JSON.parse(`<?php echo $allLeads; ?>`);

        // Monthly Leads Chart
        var options5 = {
            chart: {
                height: 350,
                type: 'bar',
                parentHeightOffset: 0,
                fontFamily: 'Poppins, sans-serif',
                toolbar: {
                    show: false,
                },
            },
            colors: ['#1b00ff', '#f56767'],
            grid: {
                borderColor: '#c7d2dd',
                strokeDashArray: 5,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '25%',
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
            series: [{
                name: 'All Leads',
                data: aData.data
            }],
            xaxis: {
                categories: aData.label,
                labels: {
                    style: {
                        colors: ['#353535'],
                        fontSize: '16px',
                    },
                },
                axisBorder: {
                    color: '#8fa6bc',
                }
            },
            yaxis: {
                title: {
                    text: ''
                },
                labels: {
                    style: {
                        colors: '#353535',
                        fontSize: '16px',
                    },
                },
                axisBorder: {
                    color: '#f00',
                }
            },
            legend: {
                horizontalAlign: 'right',
                position: 'top',
                fontSize: '16px',
                offsetY: 0,
                labels: {
                    colors: '#353535',
                },
                markers: {
                    width: 10,
                    height: 10,
                    radius: 15,
                },
                itemMargin: {
                    vertical: 0
                },
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                style: {
                    fontSize: '15px',
                    fontFamily: 'Poppins, sans-serif',
                },
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        }
        // Monthly Leads Chart End


        // Complete Leads chart
        let completePercent = "<?php echo $completePercent; ?>";
        var options6 = {
            series: [completePercent],
            chart: {
                height: 350,
                type: 'radialBar',
                offsetY: 0
            },
            colors: ['#0B132B', '#222222'],
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                            color: undefined,
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '22px',
                            color: undefined,
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            labels: ['Complete Leads'],
        };
        // Complete Leads chart End


                // All Leads Chart
                let allLeadsPercent = "<?php echo $allLeadsPercent; ?>";
        var options = {
            series: [allLeadsPercent],
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            chart: {
                height: 100,
                width: 70,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '50%',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            color: '#333',
                            offsetY: 5,
                            fontSize: '15px'
                        }
                    }
                }
            },
            colors: ['#ecf0f4'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'diagonal1',
                    shadeIntensity: 0.8,
                    gradientToColors: ['#1b00ff'],
                    inverseColors: false,
                    opacityFrom: [1, 0.2],
                    opacityTo: 1,
                    stops: [0, 100],
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                active: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
            }
        };
        // All Leads Chart End

        // Total Pending Leads Chart
        let pendingLeadsPercent = "<?php echo $pendingLeadsPercent; ?>";
        var options2 = {
            series: [pendingLeadsPercent],
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            chart: {
                height: 100,
                width: 70,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '50%',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            color: '#333',
                            offsetY: 5,
                            fontSize: '15px'
                        }
                    }
                }
            },
            colors: ['#ecf0f4'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'diagonal1',
                    shadeIntensity: 1,
                    gradientToColors: ['#009688'],
                    inverseColors: false,
                    opacityFrom: [1, 0.2],
                    opacityTo: 1,
                    stops: [0, 100],
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                active: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
            }
        };
        // Total Pending Leads Chart End


        // Total In Progress Leads Chart
        let inProgressLeadsPercent = "<?php echo $inProgressLeadsPercent; ?>";
        var options3 = {
            series: [inProgressLeadsPercent],
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            chart: {
                height: 100,
                width: 70,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '50%',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            color: '#333',
                            offsetY: 5,
                            fontSize: '15px'
                        }
                    }
                }
            },
            colors: ['#ecf0f4'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'diagonal1',
                    shadeIntensity: 0.8,
                    gradientToColors: ['#f56767'],
                    inverseColors: false,
                    opacityFrom: [1, 0.2],
                    opacityTo: 1,
                    stops: [0, 100],
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                active: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
            }
        };
        // Total In Progress Leads Chart End

        // Total Completed Leads Chart
        var options4 = {
            series: [completePercent],
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            chart: {
                height: 100,
                width: 70,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '50%',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            color: '#333',
                            offsetY: 5,
                            fontSize: '15px'
                        }
                    }
                }
            },
            colors: ['#ecf0f4'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'diagonal1',
                    shadeIntensity: 0.8,
                    gradientToColors: ['#2979ff'],
                    inverseColors: false,
                    opacityFrom: [1, 0.5],
                    opacityTo: 1,
                    stops: [0, 100],
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                active: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
            }
        };
        // Total Completed Leads Chart end

        // Chart Render
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();

        var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
        chart3.render();

        var chart4 = new ApexCharts(document.querySelector("#chart4"), options4);
        chart4.render();

        var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
        chart5.render();

        var chart6 = new ApexCharts(document.querySelector("#chart6"), options6);
        chart6.render();
        // Chart Render End
    </script>
@endpush
