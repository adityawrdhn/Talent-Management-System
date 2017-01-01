<?php
    $candidate['active'] = 'Master Data'; // Current Menu Item
    $candidate['ddactive'] = 'Employee'; // Current Menu Item
    include("assets/pages/bg_top.php");
    // include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>
	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
	        Master Data
	        <small>Employee</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
	        <li class="active">Master Data</li>
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <?php echo $this->session->flashdata('sukses'); ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#table-data" data-toggle="tab"><i class="fa fa-table"></i>Data Table</a></li>
                            <li><a href="#add-data" onclick="add_employee()" data-toggle="tab"><i class="fa fa-user-plus"></i>Add Data Employee</a></li>
                            <li class="pull-right header"><i class="fa fa-th-large"></i> Employee Table</li>
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="chart tab-pane active" id="table-data" style="position: relative; ">
                            
                            <div class="box-body table-responsive">
                                <!-- <button class="btn btn-success" onclick="add_employee()"><i class="fa fa-user-plus"></i> Add employee</button> -->
                				<!-- <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button> -->
                                <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                <!-- table-bordered table-striped -->
                                    <thead >
                                        <tr style="color:#b8c7ce;background:#2c3b41;">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Gelar</th>
                                            <th>Birthplace</th>
                                            <th>Birthdate</th>
                                            <th>Group</th>
                                            <th>Sub Group</th>
                                            <th>Personnel Are</th>
                                            <th>Organization Unit</th>
                                            <th>Job</th>
                                            <th>Position</th>
                                            <th>Grade</th>
                                            <th>Pangkat</th>
                                            <th>Golongan</th>
                                            <th>Ruang</th>
                                            <th>Atasan</th>
                                            <th>TMT Kerja</th>
                                            <th>TMT Mutasi</th>
                                            <th>TMT Pensiun</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                              <!-- </div> -->

                            </div>
                          </div>
                          <div class="chart tab-pane" id="add-data" style="position: relative; ">
                            <form method="post" action="<?php echo base_url(); ?>MasterData/saveEmployee" id="formadd">
                              <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pernr</label>
                                            <input type="text" class="form-control" name="pernr" value="<?php echo $getPernr; ?>" class="uneditable-input" readonly="true">
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Employee Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar</label>
                                            <input type="text" class="form-control" name="gelar" placeholder="Gelar">
                                        </div>
                                        <div class="form-group">
                                            <label>Birthplace</label>
                                              <input type="text" class="form-control" name="birthplace" placeholder="Birthplace">
                                        </div>
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" name="birthdate" id="datepicker">
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <label>Employee Group</label>
                                            <select name="persgid" class="form-control select2">
                                                <?php
                                                    foreach($emgroup->result_array() as $emgroup)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $emgroup['persgid']; ?>"><?php echo $emgroup['persgid']." - ".$emgroup['persg_text']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Employee Sub Group</label>
                                            <select name="perssubgid" class="form-control select2">
                                                <?php
                                                    foreach($emsubgroup->result_array() as $emsubgroup)
                                                    {   
                                                        ?>
                                                        <option value="<?php echo $emsubgroup['perssubgid']; ?>"><?php echo $emsubgroup['perssubgid']." - ".$emsubgroup['persubg_text']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Grade</label>
                                              <input type="text" class="form-control" name="grade" value="Q3" class="uneditable-input" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Personnel Area</label>
                                            <select name="persaid" class="form-control select2">
                                                <?php
                                                    foreach($empersa->result_array() as $empersa)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $empersa['persaid']; ?>"><?php echo $empersa['persaid']." - ".$empersa['persa_text']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Organization Unit</label>
                                            <select name="orguid" class="form-control select2">
                                                <?php
                                                    foreach($emorgunit->result_array() as $emorgunit)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $emorgunit['orguid']; ?>"><?php echo $emorgunit['orguid']." - ".$emorgunit['org_text']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Plans</label>
                                            <select name="plans" class="form-control select2">
                                                <?php
                                                    foreach($emplans->result_array() as $emplans)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $emplans['plans']; ?>"><?php echo $emplans['plans']." - ".$emplans['plans_text']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Job</label>
                                            <select name="jobid" class="form-control select2">
                                                <?php
                                                    foreach($emjob->result_array() as $emjob)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $emjob['jobid']; ?>"><?php echo $emjob['jobid']." - ".$emjob['job_text']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pangkat</label>
                                            <select name="pangkat" class="form-control select2">
                                                <?php
                                                    foreach($empangkat->result_array() as $empangkat)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $empangkat['pangkat']; ?>"><?php echo $empangkat['pangkat']." - ".$empangkat['pangkat_text']." - ".$empangkat['golongan'].$empangkat['ruang']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Atasan</label>
                                            <select name="pangkat" class="form-control select2">
                                                <?php
                                                    foreach($employee->result_array() as $employee)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $employee['pernr']; ?>"><?php echo $employee['pernr']." - ".$employee['name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender_key" class="form-control select2">
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT Kerja</label>
                                            <input name="tmt_kerja" class="form-control" id="datepicker2">
                                            <input name="tmt_mutasi" type="hidden" class="form-control">

                                        </div>
                                         <div class="form-group">
                                            <label>TMT Pensiun</label>
                                            <input name="tmt_pensiun" class="form-control" id="datepicker3">
                                        </div>

                                    </div>
                                </div>
                              </div>

                              <div class="box-footer">
                                <input type="submit" value="Simpan Data" class="btn btn-primary"/>
                                <input type="reset" value="Batal" class="btn btn-default">
                                <input type="hidden" name="stts" value="tambah">
                               
                              </div>
                              

                            </form>
                          </div>
                        </div> 
                    </div>
                </div>
            </div>
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

    </div>
	<?php 
    include("assets/pages/bg_footer.php");
    ?>
    
    <!-- endfooter-->
    <script type="text/javascript">

	var save_method; //for save method string
	var table;
	$(document).ready(function() {
	    //datatables
	    table = $('#table').DataTable({ 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [],
            "autoWidth":false,
            // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('MasterData/ajax_list_employee')?>",
	            "type": "POST"
	        },
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	    });
	    //datepicker
	    $('.datepicker').datepicker({
	        autoclose: true,
	        format: "yyyy-mm-dd",
	        todayHighlight: true,
	        orientation: "top",
	        todayBtn: true,
	        todayHighlight: true,  
	    });

	});



	function add_employee()
	{
	    save_method = 'add';
	    $('#formadd')[0].reset(); // reset form on modals
	}

	function editForm(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo base_url('MasterData/ajax_edit_employee')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title

            $('[name="pernr"]').val(data.pernr);
            $('[name="name"]').val(data.name);
            $('[name="gelar"]').val(data.gelar);
            $('[name="birthplace"]').val(data.birthplace);
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="persgid"]').val(data.persgid);
            $('[name="perssubgid"]').val(data.perssubgid);
            $('[name="persaid"]').val(data.persaid);
            $('[name="orguid"]').val(data.orguid);
            $('[name="plans"]').val(data.plans);
            $('[name="jobid"]').val(data.jobid);
            $('[name="pangkat"]').val(data.pangkat);
            $('[name="gender_key"]').val(data.gender_key);
            $('[name="tmt_kerja"]').val(data.tmt_kerja);
            $('[name="tmt_mutasi"]').val(data.tmt_mutasi);
            $('[name="tmt_pensiun"]').val(data.tmt_pensiun);
            $('[name="grade"]').val(data.grade);
            
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
        
	}

	function reload_table()
	{
	    window.location.reload(null,false); //reload datatable ajax 
	}
	function deleteForm(id)
	{
	        // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('MasterData/ajax_edit_employee')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDelete').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                $('.modal-title2').val(data.name);
                $('[name="pernr"]').val(data.pernr); // Set title to Bootstrap modal title
    	    },
	        error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	}
    function deleteEmp()
    {
        $('#btndel').text('deleting...'); //change button text
        $('#btndel').attr('disabled',true); //set button disable 
        var url;
        $.ajax({
            url : "<?php echo base_url('MasterData/ajax_delete_employee')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#ModalDelete').modal('hide');
                    reload_table();
                }

                $('#btndel').text('deleted'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btndel').text('delete'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 

            }
        });
    }
	</script>
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
   <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">employee Form</h3>
            </div>
            <form id="form" method="post" action="<?php echo base_url(); ?>MasterData/saveEmployee" class="form-horizontal">
                <div class="modal-body">
                    <div class="col-lg-6 col-md-6">   
                            
                            <div class="form-group">
                                <label>Pernr</label>
                                
                                    <input type="text" class="form-control" name="pernr" value="" class="uneditable-input" readonly="true">
                                
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                
                                    <input type="text" class="form-control" name="name" value="">
                                
                            </div>
                            <div class="form-group">
                                <label>Gelar</label>
                                    <input type="text" class="form-control" name="gelar" value="">
                            </div>
                            <div class="form-group">
                                <label>Birthplace</label>
                                    <input type="text" class="form-control" name="birthplace" value="">
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" name="birthdate"  value="yyyy-mm-dd"><span class="help-block"></span>
                                    </div>  
                            </div>
                            <div class="form-group">
                                <label>Employee Group</label>
                                    <select name="persgid" class="form-control select2">
                                        <?php
                                            $this->load->database();
                                            $emgroup = $this->db->query("SELECT * FROM HRM_EMGROUP");
                                            foreach($emgroup->result() as $eg)
                                            {
                                                ?>
                                                    <option value="<?php echo $eg->persgid; ?>"><?php echo $eg->persgid." - ".$eg->persg_text; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Employee Sub Group</label>
                                    <select name="perssubgid" class="form-control select2">
                                        <?php
                                            $this->load->database();
                                            $emsubgroup = $this->db->query("SELECT * FROM hrm_emsubgroup");
                                            foreach($emsubgroup->result() as $emsubgroup)
                                            {
                                                ?>
                                                    <option value="<?php echo $emsubgroup->perssubgid; ?>"><?php echo $emsubgroup->perssubgid." - ".$emsubgroup->persubg_text; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                            </div>    
                            <div class="form-group">
                                <label>Grade</label>
                                    <input type="text" class="form-control" name="grade" value="" class="uneditable-input" readonly="true">
                            </div>
                        </div>
                    <!-- </div> -->
                        <div class="col-lg-6 col-md-6">
                        <!-- <div class="modal-body">    -->
                            <div class="form-group">
                                <label>Personnel Area</label>
                                    <select name="persaid" class="form-control select2">
                                    <?php
                                        $this->load->database();
                                        $empersa = $this->db->query("SELECT * FROM hrm_empersa");
                                        foreach($empersa->result() as $empersa)
                                        {
                                            ?>
                                            <option value="<?php echo $empersa->persaid; ?>"><?php echo $empersa->persaid." - ".$empersa->persa_text; ?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                            </div>
                            <div class="form-group">
                                <label>Organization Unit</label>
                                    <select name="orguid" class="form-control select2">
                                    <?php
                                        $this->load->database();
                                        $emorgunit = $this->db->query("SELECT * FROM hrm_emorgunit");
                                        foreach($emorgunit->result() as $emorgunit)
                                        {
                                            ?>
                                            <option value="<?php echo $emorgunit->orguid; ?>"><?php echo $emorgunit->orguid." - ".$emorgunit->org_text; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Plans</label>
                                    <select name="plans" class="form-control select2">
                                    <?php
                                        $this->load->database();
                                        $emplans = $this->db->query("SELECT * FROM hrm_emplans");
                                        foreach($emplans->result() as $emplans)
                                        {
                                            ?>
                                            <option value="<?php echo $emplans->plans; ?>"><?php echo $emplans->plans." - ".$emplans->plans_text; ?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Job</label>
                                    <select name="jobid" class="form-control select2">
                                    <?php
                                        $this->load->database();
                                        $emjob = $this->db->query("SELECT * FROM hrm_emjob");
                                        foreach($emjob->result() as $emjob)
                                        {
                                            ?>
                                            <option value="<?php echo $emjob->jobid; ?>"><?php echo $emjob->jobid." - ".$emjob->job_text; ?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Pangkat</label>
                                    <select name="pangkat" class="form-control select2">
                                    <?php
                                        $this->load->database();
                                        $empangkat = $this->db->query("SELECT * FROM hrm_empangkat");
                                        foreach($empangkat->result() as $empangkat)
                                        {
                                            ?>
                                            <option value="<?php echo $empangkat->pangkat; ?>"><?php echo $empangkat->pangkat." - ".$empangkat->pangkat_text." - ".$empangkat->golongan.$empangkat->ruang; ?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                    <select name="gender_key" class="form-control">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>TMT Kerja</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    <input name="tmt_kerja" class="form-control datepicker" value="yyyy-mm-dd" type="text"><span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>TMT Mutasi</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    <input name="tmt_mutasi" class="form-control datepicker" value="yyyy-mm-dd" type="text"><span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>TMT Pensiun</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    <input name="tmt_pensiun" class="form-control datepicker" value="yyyy-mm-dd" type="text"><span class="help-block"></span>
                                </div>
                            </div>
                        <!-- </div> -->
                    <input type="hidden" name="stts" value="edit">
                   
                    </div>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit"class="btn btn-primary pull-right">Save</button>
                </div>
                
                
            </form>
            <!-- </div> -->
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 
<div class="modal modal-danger fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;"><strong class="modal-title2"></strong></h4>
              </div>
                <form id="form" method="post">        
              <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <input type="hidden" name="pernr" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deleteEmp()"class="btn btn-outline" id="btndel">Delete</a>
              </div>
                </form>
            </div>
        </div>
</div>
</body>
</html>
  