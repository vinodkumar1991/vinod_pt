<div class="table-responsive">
    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Customer Name</th>                                               
                <th>Code</th>                                          
                <th>Email ID</th>
                <th>Mobile No</th>
                <th>Description</th>
                <th>Created Date</th>              
            </tr>
        </thead>
        <tbody> 
        <?php 
        if(isset($arrEnquiry) && !empty($arrEnquiry)){
            $i=1;
            foreach($arrEnquiry as $row){ ?>
                <tr>    
                    <td><?php echo $i?></td>
                    <td><?php echo isset($row['name']) ? $row['name'] : NULL;?></td>
                    <td><?php echo isset($row['code']) ? $row['code'] : NULL;?></td>
                    <td><?php echo isset($row['email']) ? $row['email'] : NULL;?></td>
                    <td><?php echo isset($row['phone']) ? $row['phone'] : NULL;?></td>
                    <td><?php echo isset($row['description']) ? $row['description'] : NULL;?></td>
                    <td><?php echo isset($row['created_date']) ? $row['created_date'] : NULL;?></td>       
                </tr>
           <?php $i++;}
        }?>
        </tbody>
    </table>
</div>                                    
                             
       