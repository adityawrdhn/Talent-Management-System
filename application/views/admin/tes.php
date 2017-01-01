<?php $con = mysqli_connect("localhost", "root", "", "hris");
                                if (!$con) {
                                    die('Could not connect: ' . mysql_error());
                                }
                                $this->load->database();
                                foreach ($tp->result_array() as $row) {
                                     $name=$row['name'];
                                     $query = $this->db->query("SELECT * FROM hrm_employee a, hrm_potency b, hrm_performancy c WHERE a.name='$name' and b.pernr=a.pernr and c.pernr=a.pernr");
                                     foreach ($query->result() as $row) {
                                         $cols = $row->key_potency_indicator;
                                         $rows = $row->key_performance_indicator;
                                    }?> 
                                
                                {
                                     name: '<?php echo $name; ?>',
                                     data: [[<?php echo $cols;?>,<?php echo $rows;?>]]
                                },
                                     <?php } ?>