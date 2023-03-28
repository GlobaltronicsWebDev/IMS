@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>

    </head>

    <body>


        <div class="container mt-3">

            <div class="card mb-5 border-primary" style="margin-left: 0%;">
                <div class="card-header bg-primary text-white" style="background-color: #166ccf;">

                    <h3 class="mt-2">
                        Dashboard
                    </h3>

                </div>
                <div class="card-body" style="background-color: #ffffff">

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Categories
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM categories';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Brands
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM brands';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Inventory Items
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM products';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Check-ins
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM checkins';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Client Checkouts
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM order_items';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Item Returns
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM return_slips';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Borrowed Items
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM borrowers';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card border-primary text-dark">
                                <div class="card-header bg-primary text-white">
                                    Purchase Returned Items
                                </div>
                                <div class="card-body">
                                    <h3 style="text-align: center">
                                        <span class="count">
                                            <?php
                                            $servername = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $dbname = 'ims_inventory1';
                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            $sql = 'SELECT count(id) AS total FROM purchase_returns';
                                            $result = mysqli_query($con, $sql);
                                            $values = mysqli_fetch_assoc($result);
                                            $num_rows = $values['total'];

                                            echo $num_rows;

                                            ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card mb-5 border-primary">
                        <div class="card-header bg-primary text-white">
                            Users
                        </div>

                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card mb-5 border-primary">
                        <div class="card-header bg-primary text-white">

                            Check-ins

                        </div>

                        <div class="card-body">
                            <div id="pie_chart" style="align-items: center;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card mb-5 border-primary">
                        <div class="card-header bg-primary text-white">
                            Location
                        </div>

                        <div class="card-body">
                            <div id="donutchart" style="align-items: center;"></div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card mb-5 border-primary">
                        <div class="card-header bg-primary text-white">

                            Inventory Item Brands

                        </div>

                        <div class="card-body">
                            <div id="barchart"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 border-primary">

                <div class="card-header bg-primary text-white">

                </div>
                <div class="card-body" style="background-color: #ffffff">
                    <div id="containerlive"></div>

                </div>
            </div>
        </div>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var checkins = <?php echo json_encode($checkins); ?>;
                var options = {
                    chart: {
                        renderTo: 'pie_chart',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                    },
                    title: {
                        text: 'Percentage of status of item check-ins'
                    },
                    tooltip: {
                        pointFormat: '{series.name} <b> {point.percentage.2f}% </b>',
                        percentageDecimals: 1,
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this
                                        .percentage, 2) + ' %';
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Status'
                    }]

                }
                myarray = [];
                $.each(checkins, function(index, val) {
                    myarray[index] = [val.status, val.count];
                });
                options.series[0].data = myarray;
                chart = new Highcharts.Chart(options);
            });


            var users = <?php echo json_encode($users); ?>;

            Highcharts.chart('chart', {
                title: {
                    text: 'New User Growth, 2023'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Number of New Users'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'New Users',
                    data: users
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });


            var products = <?php echo json_encode($products); ?>;

            Highcharts.chart('barchart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Inventory Item Brands'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        'ABSEN',
                        'LINSO',
                        'SHENZHEN',
                        'TRT',
                        'SHANGHAI',
                        'SHANGHAI ELEC',
                        'LIGHT KING',
                        'LEYARD',
                        'UNILUMIN',
                        'FABULUX',
                        'LEDTOP',
                        'PHILIPS',
                        'VOGELS',
                        'KIOSK',
                        'ADPOD',
                        'SPIDER',
                        'NOVA STAR',
                        'SHUTTLE',
                        'AVER',
                        'YAHAM',
                        'DAKTRONICS',

                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Items'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} </b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Inventory',
                    data: products

                }],
            });


            $(document).ready(function() {
                var order_items = <?php echo json_encode($order_items); ?>;
                var options = {
                    chart: {
                        renderTo: 'donutchart',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        options3d: {
            enabled: true,
            alpha: 45
        }
                    },
                    title: {
                        text: 'Percentage of branch checkouts'
                    },
                    tooltip: {
                        pointFormat: '{series.name} <b> {point.percentage.2f}% </b>',
                        percentageDecimals: 1,
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            innerSize: 100,
                            depth: 45,
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this
                                        .percentage, 2) + ' %';
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Location'
                    }]

                }
                myarray = [];
                $.each(order_items, function(index, val) {
                    myarray[index] = [val.location, val.count];
                });
                options.series[0].data = myarray;
                chart = new Highcharts.Chart(options);
            });




            //LIVE CHART

            Highcharts.chart('containerlive', {
                chart: {
                    type: 'spline',
                    animation: Highcharts.svg, // don't animate in old IE
                    marginRight: 10,
                    events: {
                        load: function() {

                            // set up the updating of the chart each second
                            var series = this.series[0];
                            setInterval(function() {
                                var x = (new Date()).getTime(), // current time
                                    y = Math.random();
                                series.addPoint([x, y], true, true);
                            }, 1000);
                        }
                    }
                },

                time: {
                    useUTC: false
                },

                title: {
                    text: 'Inventory Data'
                },

                accessibility: {
                    announceNewData: {
                        enabled: true,
                        minAnnounceInterval: 15000,
                        announcementFormatter: function(allSeries, newSeries, newPoint) {
                            if (newPoint) {
                                return 'New point added. Value: ' + newPoint.y;
                            }
                            return false;
                        }
                    }
                },

                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150
                },

                yAxis: {
                    title: {
                        text: 'Value'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },

                tooltip: {
                    headerFormat: '<b>{series.name}</b><br/>',
                    pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
                },

                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },

                exporting: {
                    enabled: false
                },

                series: [{
                    name: 'Check-ins',
                    data: (function() {
                        // generate an array of random data
                        var data = [],
                            time = (new Date()).getTime(),
                            i;

                        for (i = -19; i <= 0; i += 1) {
                            data.push({
                                x: time + i * 1000,
                                y: Math.random()
                            });
                        }
                        return data;
                    }())
                }]
            });
        </script>
    </body>



    </html>
@endsection
