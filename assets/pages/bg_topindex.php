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
                                 min: 0,
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
                                            $colstd= $row['stdpote'];
                                        }
                                    ?>
                                    {
                                     id :'foo',
                                     value: <?php echo $colstd ?>,
                                     width: 5,
                                     color: 'orange',
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
                                 min:0,
                                tickInterval:5,
                                plotLines: [
                                    <?php 
                                        foreach($stp->result_array() as $row){
                                        $rowstd= $row['stdperf'];
                                        }
                                    ?>
                                    {
                                        id :'y2',
                                        color: 'blue',
                                        dashStyle: 'line',
                                        width: 5,
                                        value: <?php echo $rowstd ?>,
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
                                <?php 
                                $this->load->database();
                                foreach ($tp->result_array() as $row) {
                                     $nm=$row['name'];
                                     $query = $this->db->query("SELECT * FROM hrm_employee a, hrm_potency b, hrm_performancy c WHERE a.name='$nm' and b.pernr=a.pernr and c.pernr=a.pernr");
                                     foreach ($query->result() as $row) {
                                         $cols = $row->key_potency_indicator;
                                         $rows = $row->key_performance_indicator;
                                    }?> 
                                
                                {
                                     name: '<?php echo $nm; ?>',
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
 

