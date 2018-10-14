<div class="table-responsive">
    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>UserName</th>
                <th>Customer Name</th>
		<th>Customer Code</th>                                                
                <th>Email ID</th>
                <th>Mobile No</th>
		<th>verified_token</th>
                <th>Status</th>
                <th>Created Date</th>              
            </tr>
        </thead>
        <tbody> 
        <?php 
        // print_r($arrCustomers);die();
        if(!empty($arrCustomers)){
            $i=1;
            foreach($arrCustomers as $row){ ?>
                <tr>    
                    <td><?php echo $i?></td>
                    <td><?php echo isset($row['username']) ? $row['username'] : NULL;?></td>
                    <td><?php echo isset($row['first_name']) ? $row['first_name'] : NULL;?></td>
		    <td><?php echo isset($row['customer_code']) ? $row['customer_code'] : NULL;?></td>
                    
                    <td><?php echo isset($row['email']) ? $row['email'] : NULL;?></td>
                    <td><?php echo isset($row['phone']) ? $row['phone'] : NULL;?></td>
		     <td><?php echo isset($row['verify_token']) ? $row['verify_token'] : NULL;?></td>
                       <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $row['status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                   
                        
                    <td><?php echo isset($row['created_date']) ? $row['created_date'] : NULL;?></td>       
                </tr>
           <?php $i++;}
        }?>
        </tbody>
    </table>
</div>                                    
                             
       
