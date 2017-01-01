<?php
    $candidate['active'] = 'performance'; // Current Menu Item
    $candidate['ddactive'] = ''; // Current Menu Item
    include("assets/pages/bg_top.php");
    // include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>
<style type="text/css">
    .ui-sortable li{
        border-radius: 5px;
    }
</style>
	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
	        PERFORMANCE:
	        <small>Balanced Scorecard</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
	        <li class="active">Performance</li>
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <!-- <div class="nav-tabs-custom"> -->

                <div class="col-md-3">
                <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>

                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#create" data-toggle="tab">Create KPI</a></li>
                        <li><a href="#assign" data-toggle="tab">Assign KPI</a></li>
                        <li><a href="#entry" data-toggle="tab">Entry KPI</a></li>
                        <li><a href="#target" data-toggle="tab">Target KPI</a></li>
                        <li><a href="#approve" data-toggle="tab">Approve KPI</a></li>
                    </ul>
                </div>
                </div>
                </div>

                <div class="col-md-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="create">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Create KPI</h3>
                                </div>
                                <form class="form-horizontal">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label for="kpi_name" class="col-sm-2 control-label">Name Of KPI</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" name="kpi_name" placeholder="Name">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="kpi_type" class="col-sm-2 control-label">Type Of KPI</label>

                                      <div class="col-sm-10">
                                        <select name="kpi_type" class="form-control select">
                                            <option value="precentage">Precentage</option>
                                            <option value="integer">Integer</option>
                                            <option value="boolean">Boolean</option>
                                        </select>
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label for="kpi_parent" class="col-sm-2 control-label">KPI Parent</label>

                                      <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" name="kpi_parent" placeholder="Parent"> -->
                                        <select name="kpi_parent" class="form-control select2">
                                                <?php
                                                    foreach($mykpi->result() as $parent)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $parent->KPI_ID; ?>"><?php echo $parent->KPI_ID." - ".$parent->KPI_NAME; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="kpi_finished_target" class="col-sm-2 control-label">KPI Finished Target</label>
                                      
                                      <div class="col-sm-10">
                                        <input name="kpi_finished_target" class="form-control" id="datepicker">
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.box-body -->
                                  <div class="box-footer">
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <button type="submit" class="btn btn-info pull-right">Create</button>
                                  </div>
                                  <!-- /.box-footer -->
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="assign">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Assign</h3>
                                </div>
                                <div class="box-body">
                                    <form action="<?php echo base_url() ?>kpi_assign/assign" role="form" method="POST" class="form-horizontal">
                                        <input type="hidden" name="assign_kpi_id" id="assign_kpi_id"  value="">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Select User</label>
                                            <div class="col-md-10">
                                                    <?php
                                                    $selected = set_value('pernr');
                                                    ?>
                                                    <select id="kpi_userid" name="kpi_userid" class="form-control rounded" onchange="kpidrag(this.value);">
                                                        <option value="0">Select User</option>
                                                        <?php
                                                        if (isset($usergetArr) && $usergetArr != array()) {
                                                            foreach ($usergetArr->result() as $key) {
                                                                $sel = "";
                                                                if ($key->pernr == $selected)
                                                                    $sel = "selected";

                                                                echo "<option value='" . $key->pernr . "' $sel>" . $key->pernr."-".$key->name . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="error"><?php echo form_error('pernr'); ?></span>
                                            </div>
                                        </div>
                                        <div id="center-wrapper">
                                            <div class="dhe-example-section" id="ex-1-3">
                                                <div class="col-md-12 text-center">
                                                    <h4 class="widget-header">Select The KPI To Assign User</h4>
                                                </div>
                                                <div class="dhe-example-section-content">
                                                    <div id="example-1-3" style="margin-left: 20%;">
                                                        <div class="column left first">
                                                            <h4><label class="kpiname">Available KPI :-</label></h4>
                                                            <ul class="sortable-list"  id="left_drag">
                                                                <?php
                                                                if (isset($kpiArr) && $kpiArr != array())
                                                                    foreach ($kpiArr as $kpi) {
                                                                        ?>
                                                                        <li class="sortable-item" id="<?= $kpi['kpi_id'] ?>"><?= $kpi['kpi_name'] ?></li>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <div class="column left">
                                                            <h4><label id="kpi_id_fk" name="kpi_id_fk">Assign KPI :-</label></h4>
                                                            <ul class="sortable-list right_ul" id="right_drag">
                                                            </ul>
                                                        </div>
                                                        <div class="clearer">&nbsp;</div>
                                                    </div>
                                                </div>

                                                <div class="alert alert-danger" id="errorDiv" style="display: none;margin-top: 15px;">
                                                    <i class="fa fa-times-circle"></i> &nbsp;&nbsp;<span id="errortext"></span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <br/>
                                                        <center>
                                                            <input type="submit" class="btn btn-primary" id="btn-get" value="Assign" />
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="entry">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Entry</h3>
                                </div>
                                <div class="box-body">
                                    <form class="form-horizontal">
<!--                        <form action="<?php // echo base_url()                 ?>kpi_approve" role="form" class="form-horizontal" method="post">-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">User Name</label>
                                <div class="col-xs-6">

                                    <?php
                                    if ((isset($data)) && $data[0]->username != '') {
                                        $username = $data[0]->username;
                                    } else {
                                        $username = set_value('username');
                                    }
                                    ?>

                                    <input class="form-control rounded" type="text" id="" name=""  value="<?php echo $username; ?>" disabled="disabled">

                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <h4 class="widget-header">*** Enter The Work For Approve ***</h4>
                            </div>

                            <!--                            <div class="dhe-example-section-header"><br/>
                                                            <h3 class="dhe-h3 dhe-example-title">*** Enter The Work For Approve ***</h3>
                                                        </div>-->

                            <div class="form-group">
                                <center>
                                    <label class="col-xs-3">KPI Name</label>
                                    <label class="col-xs-2">Work</label>
                                    <label class="col-xs-2">Target</label>
                                    <label class="col-xs-2">Comment</label>
                                    <label class="col-xs-2" style="display: none;"></label>
                                </center>
                            </div>




                            <div class="form-group">
                                <?php
                                $kpiname = array();
                                if (isset($get_target) && $get_target != array()) {
                                    for ($i = 0; $i < count($get_target); $i++) {
                                        $kpi_id = $get_target[$i]['kpi_id'];
//                                        echo '<pre>';
//                                        print_r($kpi_id);
//                                        echo '</pre>';
//                                        exit();
                                        $value_of_target = $get_target[$i]['value_of_target'];
                                        $user_id_fk = $get_target[$i]['user_id_fk'];
                                        $update_status = $get_target[$i]['update_status'];
                                        $ups = '';

//                                            echo"<pre>";
//                                            print_r($update_status);
//        
//                                                                                echo"</pre>";
                                        if ($update_status == 1) {
                                            $ups = 'style="border-color: red;"';
                                        }
                                        $trueselected = '';
                                        $falseselected = '';
                                        $trueselecteddb = '';
                                        $falseselecteddb = '';
                                        $comment = '';
                                        $class = 'add';
                                        $lable = 'ADD';
                                        $disabled = '';
                                        if ($value_of_target == 'true') {
                                            $trueselecteddb = 'selected';
                                        } else {
                                            $falseselecteddb = 'selected';
                                        }
                                        $val = '';
                                        if (isset($fetchentry) && $fetchentry != array()) {
                                            if (@$fetchentry[$kpi_id]) {
                                                $val = $fetchentry[$kpi_id]['kpi_value'];
                                                if ($val == 'true') {
                                                    $trueselected = 'selected';
                                                } else {
                                                    $falseselected = 'selected';
                                                }
                                                $class = 'update';
                                                $lable = 'UPDATE';
                                                $disabled = 'disabled';
                                                $comment = $fetchentry[$kpi_id]['comment'];
                                            }
                                        }
                                        ?>
                                        <center>
                                            <label class="col-xs-3"><?= $get_target[$i]['kpi_name'] ?></label></center>

                                        <div class="row bottom-margin">
                                            <?php if ($get_target[$i]['kpi_type'] == 'boolean') {
                                                ?>
                                                <div class="col-xs-2"><select  <?= $disabled ?> class="form-control rounded" id="kpi_<?= $kpi_id ?>"  name=""><option <?= $trueselected ?> value="true">Yes</option><option  <?= $falseselected ?> value="false">No</option></select></div>

                                                <div class="col-xs-2"><select disabled="disabled" class="form-control rounded" id="kpitarget_<?= $kpi_id ?>" <?= $ups ?> name=""><option value="true" <?= $trueselecteddb ?>>Yes</option><option value="false"  <?= $falseselecteddb ?>>No</option></select></div>
                                            <?php } else {
                                                ?>
                                                <div class="col-xs-2">
                                                    <input class="form-control" id="kpi_<?= $kpi_id ?>"  type="text" value="<?= $val ?>" <?= $disabled ?> >
                                                </div>

                                                <div class="col-xs-2">
                                                    <input class="form-control" type="text" <?= $ups ?> id="kpitarget_<?= $kpi_id ?>" placeholder="<?= $value_of_target ?>" value="<?= $value_of_target ?>" disabled="disabled">
                                                </div>
                                            <?php } ?>
                                            <div class="col-xs-2">
                                                <div class="input-group">
                                                    <textarea class="form-control"  <?= $disabled ?> id="comment_<?= $kpi_id ?>" rows="1" type="text" placeholder="Comment..."><?= $comment ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <button id="button_<?= $kpi_id ?>" type="button" class="btn btn-primary <?= $class ?>" onclick="entrykpi('<?= $kpi_id ?>','<?= $user_id_fk ?>')"><?= $lable ?></button>
                                            </div>

                                        </div>




                                        <?php
                                    }
                                }
                                ?>
                            </div>

                        </form>
                
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="target">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Target</h3>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="approve">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Approve</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                <!-- </div> -->
            </div>
        </section>
        </div>
    
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.1
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.instagram.com/adityawrdhn">TMS - Aditya Wardhana</a>.</strong> All rights reserved.
        </br>
        Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik

    </footer>

        
	
	<!--footer -->

    
	<?php 
    include("assets/pages/bg_footer.php");
    ?>
    
    <!-- endfooter-->
  <script>
  $(function () {
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#datepicker2').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#datepicker3').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

  });
</script>  
<script type="text/javascript">

    $(document).ready(function(){
        // Example 1.3: Sortable and connectable lists with visual helper
        $('#example-1-3 .sortable-list').sortable({
            connectWith: '#example-1-3 .sortable-list',
            placeholder: 'placeholder'
            //                    containment: "parent"
        });
        $('#btn-get').click(function(){
            $("#errorDiv").fadeOut("slow");
            var kpi_assign= getItems('#example-1-3');
            if(kpi_assign==''){
                $("#errortext").html("Please Assign atleast one KPI");
                $("#errorDiv").fadeIn("slow");
                return false;
            }
            $("#assign_kpi_id").val(kpi_assign);

        });

    });
    function getItems(exampleNr)
    {
        var columns = [];
        //toArray Serializes the sortable's item id's into an array of string.
        $(exampleNr + ' ul.right_ul li').each(function(k,v){
            //            console.log(v.id);return false;
            columns.push($(this).attr('id'));
            //            columns.push($(this).idsortable('toArray').join(','));
        });

        return columns.join();
    }
</script>
</body>
</html>
  