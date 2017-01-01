<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $judul; ?></title>
  <!-- <link href="<?php echo base_url(); ?>asset/css/style.css" rel="stylesheet"> -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css'); ?>">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/fontello.css'); ?>" > -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css'); ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css'); ?>">
    
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
    <link  rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
    <script src="<?php echo base_url('assets/js/jquery-1.10.1.min.js'); ?>"></script>


    <script type="text/javascript">
    $(function () {
       function draggablePlotLine(axis, plotLineId) {
                var clickX, clickY;

                var getPlotLine = function () {
                    for (var i = 0; i < axis.plotLinesAndBands.length; i++) {
                        if (axis.plotLinesAndBands[i].id === plotLineId) {
                            return axis.plotLinesAndBands[i];
                        }
                    }
                };
                
                var getValue = function() {
                    var plotLine = getPlotLine();
                    var translation = axis.horiz ? plotLine.svgElem.translateX : plotLine.svgElem.translateY;
                    var new_value = axis.toValue(translation) - axis.toValue(0) + plotLine.options.value;
                    new_value = parseInt(Math.max(axis.min, Math.min(axis.max, new_value)));
                    // parseInt(c);
                    return new_value;
                };

                var drag_start = function (e) {
                    $(document).bind({
                        'mousemove.line': drag_step,
                            'mouseup.line': drag_stop
                    });

                    var plotLine = getPlotLine();
                    clickX = e.pageX - plotLine.svgElem.translateX;
                    clickY = e.pageY - plotLine.svgElem.translateY;
                    if (plotLine.options.onDragStart) {
                        plotLine.options.onDragStart(getValue());
                    }
                };

                var drag_step = function (e) {
                    var plotLine = getPlotLine();
                    var new_translation = axis.horiz ? e.pageX - clickX : e.pageY - clickY;
                    var new_value = axis.toValue(new_translation) - axis.toValue(0) + plotLine.options.value;
                    new_value = Math.max(axis.min, Math.min(axis.max, new_value));
                    new_translation = axis.toPixels(new_value + axis.toValue(0) - plotLine.options.value);
                    plotLine.svgElem.translate(
                        axis.horiz ? new_translation : 0,
                        axis.horiz ? 0 : new_translation);

                    if (plotLine.options.onDragChange) {
                        plotLine.options.onDragChange(new_value);
                    }
                };

                var drag_stop = function () {
                    $(document).unbind('.line');

                    var plotLine = getPlotLine();
                    var plotLineOptions = plotLine.options;
                    //Remove + Re-insert plot line
                    //Otherwise it gets messed up when chart is resized
                    if (plotLine.svgElem.hasOwnProperty('translateX')) {
                        plotLineOptions.value = getValue()
                        axis.removePlotLine(plotLineOptions.id);
                        axis.addPlotLine(plotLineOptions);

                        if (plotLineOptions.onDragFinish) {
                            plotLineOptions.onDragFinish(plotLineOptions.value);
                        }
                    }

                    getPlotLine().svgElem
                        .css({'cursor': 'pointer'})
                        .translate(0, 0)
                        .on('mousedown', drag_start);
                };
                drag_stop();
            }
                        function toast(chart, text) {
                chart.toast = chart.renderer.label(text, 100, 120)
                    .attr({
                        fill: Highcharts.getOptions().colors[0],
                        padding: 10,
                        r: 5,
                        zIndex: 8
                    })
                    .css({
                        color: '#FFFFFF'
                    })
                    .add();

                setTimeout(function () {
                    chart.toast.fadeOut();
                }, 2000);
                setTimeout(function () {
                    chart.toast = chart.toast.destroy();
                }, 2500);
            }

            /**
             * Custom selection handler that selects points and cancels the default zoom behaviour
             */
            function selectPointsByDrag(e) {

                // Select points
                Highcharts.each(this.series, function (series) {
                    Highcharts.each(series.points, function (point) {
                        if (point.x >= e.xAxis[0].min && point.x <= e.xAxis[0].max &&
                                point.y >= e.yAxis[0].min && point.y <= e.yAxis[0].max) {
                            point.select(true, true);
                        }
                    });
                });

                // Fire a custom event
                Highcharts.fireEvent(this, 'selectedpoints', { points: this.getSelectedPoints() });

                return false; // Don't zoom
            }

            /**
             * The handler for a custom event, fired from selection event
             */
            function selectedPoints(e) {
                // Show a label
                toast(this, '<b>' + e.points.length + ' points selected.</b>' +
                    '<br>Click on empty space to deselect.');
            }

            /**
             * On click, unselect all points
             */
            function unselectByClick() {
                var points = this.getSelectedPoints();
                if (points.length > 0) {
                    Highcharts.each(points, function (point) {
                        point.select(false);
                    });
                }
            };

             
             var chart;
             
             $(document).ready(function () {
                     // $.getJSON("dataline.php", function(json) {
                     chart = new Highcharts.Chart({
                             chart: {
                                 renderTo: 'mygraph',
                                 type: 'scatter',
                                 showverticalline: 1,
                                 events: {
                                    selection: selectPointsByDrag,
                                    // selectedpoints: selectedPoints,
                                    click: unselectByClick
                                 },
                                 zoomType:'xy',
                                 height:500,
                                 // events: {
                                 //    // selection: selectPointsByDrag,
                                 //    selectedpoints: getValue
                                 //    // click: unselectByClick
                                 // }
                             },
                             title: {
                                 text: 'Talent Pool'
                             },
                             subtitle: {
                                 text: 'KAI'
                             },
                             xAxis: {
                                gridLineWidth: 1,
                                 // min: 0,
                 // max: 100,
                                tickInterval:5,

                                 title: {
                                     enabled: true,
                                     text: 'competency'
                                 },
                                 endOnTick: true,
                                 showLastLabel: true,
                                 gridLineWidth: 1,
                                 startOnTick: 'true',
                                 plotLines: [
                                    <?php 
                                        foreach($stp->result_array() as $row){
                                            $colstd= $row['stdcompetency'];
                                        }
                                    ?>
                                    {
                                     id :'foo',
                                     value: <?php echo $colstd ?>,
                                     width: 5,
                                     color: 'orange',
                                     // label: {
                                     //        // align: 'right',
                                     //        rotation: 0,

                                     //        style: {
                                     //            fontStyle: 'italic'
                                     //        },
                                     //        text: 'competency',
                                     //        // x: 10,
                                     //        y:15
                                     //    },
                                       zIndex: 3,
                                       onDragStart: function (new_value) {
                                         $("#x_value").text(parseInt(new_value) + ' (Not changed yet)');
                                       },
                                       onDragChange: function (new_value) {
                                         $("#x_value").text(parseInt(new_value) + ' (Dragging)');
                                       },
                                       onDragFinish: function (new_value) {
                                         $("#x_value").text(parseInt(new_value));
                                         var varJS = parseInt(new_value);
                                         document.form1.valuec.value = varJS;
                                       }
                                 }]
                             },
                             yAxis: {
                                 title: {
                                     text: 'performance'
                                 },
                                 startOnTick: 'true',
                                 gridLineWidth: 1,
                                 // min:0,
                                tickInterval:5,
                                plotLines: [
                                    <?php 
                                        foreach($stp->result_array() as $row){
                                        $rowstd= $row['stdperformance'];
                                        }
                                    ?>
                                    {
                                        id :'y2',
                                        color: 'blue',
                                        dashStyle: 'line',
                                        width: 5,
                                        value: <?php echo $rowstd ?>,
                                        // value: 80,
                                        // label: {
                                        //     align: 'right',
                                        //     style: {
                                        //         fontStyle: 'italic'
                                        //     },
                                        //     text: 'Performances',
                                        //     x: -10
                                        // },
                                        zIndex: 3,
                                        onDragStart: function (new_value) {
                                            $("#y_value").text(parseInt(new_value) + ' (Not changed yet)');
                                        },
                                        onDragChange: function (new_value) {
                                            $("#y_value").text(parseInt(new_value) + ' (Dragging)');
                                        },
                                        onDragFinish: function (new_value) {
                                            $("#y_value").text(parseInt(new_value));
                                            var varJS = parseInt(new_value);
                                            document.form1.valuep.value = varJS;
                                            // document.form1.valuep1.value = varJS;
                                        }
                                    }]
                             },
                             tooltip: {
                                 formatter: function () {
                                     return '<b>' + this.series.name + '</b><br/>' +
                                         this.x + ': ' + this.y;
                                 },
                             },
                            legend: {
                                enabled: false
                            },
                            series: [
                                <?php $con = mysqli_connect("localhost", "root", "", "dbline");
                                if (!$con) {
                                    die('Could not connect: ' . mysql_error());
                                }
                                $this->load->database();
                                foreach ($tp->result_array() as $row) {
                                     $name=$row['nama'];
                                     $query = $this->db->query("Select * from talent_pool where nama='$name'");
                                     foreach ($query->result() as $row) {
                                         $cols = $row->value1;
                                         $rows = $row->value2;
                                    }?> 
                                
                                {
                                     name: '<?php echo $name; ?>',
                                     data: [[<?php echo $cols;?>,<?php echo $rows;?>]]
                                },
                                     <?php } ?>

                             ]
                         },

             function(chart) {
               draggablePlotLine(chart.xAxis[0], 'foo');
               draggablePlotLine(chart.yAxis[0], 'y2');
               console.log('ready');
               $slider = $('#slider');
                $slider.slider({
                min: chart.axes[0].min,
                max: chart.axes[0].max,
                slide : function(event, ui){
                    var plotX = chart.xAxis[0].toPixels(ui.value, false);
                    $('#slider_bar').remove();
                    chart.renderer.path(['M', plotX, 75, 'V', plotX, 300]).attr({
                        'stroke-width': 1,
                        stroke: 'rgba(223, 83, 83, .5)',
                        id : 'slider_bar'
                    })
                    .add();  
                }
            }); 
                         });

                 });
         });

  </script>

  <script src="<?php echo base_url('assets/js/highcharts.js'); ?>"></script>

  <script src="<?php echo base_url('assets/js/exporting.js'); ?>"></script>


</head>

      

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper fixed">
    <header class="main-header">
        <!-- Logo -->
          <a href="<?php echo base_url(); ?>admin/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">SIA<b></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">SI<b>AKAD</b></span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $nama; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                      <p>
                        <?php echo $nama; ?>
                      </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                      <div class="col-xs-4 text-center">
                        <a href="#"><?php echo $status; ?></a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">-</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">@<?php echo $username; ?></a>
                      </div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="<?php echo base_url(); ?>admin/akun" class="btn btn-default btn-flat">Pengaturan</a>
                      </div>
                      <div class="pull-right">
                        <a href="<?php echo base_url(); ?>web/logout" class="btn btn-default btn-flat">Keluar</a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                  <a href="#" data-toggle="control-sidebar"><i class="icon-cog"></i></a>
                </li>
              </ul>
            </div>
          </nav>
        </header>