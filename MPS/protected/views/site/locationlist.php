<script type="text/javascript">
 function deletedata(id)
 {
  var delval=id;
  var del=confirm("Are you sure you want to delete");
  if(del===true)
  { 
   
        var jqxhr = $.ajax({
                type: "POST",
                url: "deleterec",
                data: {delval:delval},
                beforeSend:function()
                {
                // show image here

                }
        }).done(function(data)
        {
                alert('Record deleted successfully!');
                var form=document.createElement('form');
                form.setAttribute('method','post');
                form.setAttribute('action','locationslist');
                document.body.appendChild(form);
                form.submit();
        });  //end of ajax
  }
   
	

  }
   
 
 
  function editdata(id)
 {
 var editval=id;
 alert(editval);
  var edit=confirm("Are you sure you want to edit");
  if(edit===true)
  { 
   //alert("fdsf");
        var jqxhr = $.ajax({
                type: "POST",
                url: "edit",
                data: {editval:editval},
                beforeSend:function()
                {
                // show image here

                }
        }).done(function(data)
        {
                alert('Record edited successfully!');
                var form=document.createElement('form');
                form.setAttribute('method','post');
                form.setAttribute('action','../site/editsave');
                document.body.appendChild(form);
                form.submit();
        });  //end of ajax
  }
 }
</script>                                
                                <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/dashboard">Create Location</a></li>
                                        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/locationslist">Locations List</a></li>
                                    </ul>
                                <!-- Tab panes -->
                                    <div class="tab-content">
                                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>SI No.</th>
                                                    <th>Country</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Area</th>
                                                    <th>Zip Code</th>
                                                    <th>Location Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach($arealist as $arealist)
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $arealist['ID']; ?></td>
                                                    <td><?php echo $arealist['COUNTRYNAME']; ?></td>
                                                    <td><?php echo $arealist['STATENAME']; ?></td>
                                                    <td><?php echo $arealist['CITYNAME']; ?></td>
                                                    <td><?php echo $arealist['AREANAME']; ?></td>
                                                    <td><?php echo $arealist['ZIPCODE']; ?></td>
                                                    <td><?php echo $arealist['LOCATIONNAME']; ?></td>
                                                    <td align="center">
                                                        <a onclick="editdata(<?php echo $arealist['ID'];?>)" href="#" class="edit-u" title="Delete"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <a onclick="deletedata(<?php echo $arealist['ID'];?>)" href="#" title="Edit" class="delete-u"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                             
                                        </table>
                                </div>
                           <!-- </div>
                        </div>
                    </div>
                </div>
            </div>
