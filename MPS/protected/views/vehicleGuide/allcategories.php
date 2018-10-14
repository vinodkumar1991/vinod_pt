
<script>
function deletep(id)
{
	var edata=id;
	
	var con=confirm("Are you sure you want to delete!");
	if(con==true)
	{
       $.post('../VehicleGuide/Deleteself',{
		  
			id:edata
		},
		function(data)
		{
			
           var form=document.createElement('form');
			form.setAttribute('method','post');
			form.setAttribute('action','../VehicleGuide/allcategories');
			document.body.appendChild(form);
			form.submit();
        });
   }
}   
</script>			

				<ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo $this->createUrl('VehicleGuide/vehicleCategory');?>">Vehicle Guide Category</a></li>
                                        <li><a href="<?php echo $this->createUrl('VehicleGuide/VehicleGuideContent');?>">Add Category Post</a></li>
                                       <li class="active"><a href="<?php echo $this->createUrl('VehicleGuide/allcategories');?>">All Posts</a></li>
                                    </ul>
                                     <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Category Name</th>
                                                <th>Sub Category</th>                                            
                                                <th>Image Path</th>                                            
                                                <th>Created Date</th>                                            
                                                                                         
												 <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											  
											  $i=1;
                    foreach ($vehicle_details as $self_detail) {
                    	
                                              
											   echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
											   <td>'.$self_detail['cat_name'].'</td>
											   <td>'.$self_detail['sub_cat_name'].'</td>
											 <td align="center">
<a href="http://www.metrepersecond.com/MPS/'.$self_detail['img_path'].'" class="imghover"><i class="fa fa-picture-o" aria-hidden="true"></i></a></td>
												
											    <td>'.$self_detail['created_date'].'</td>
												<td><a href="VehicleGuideContent?cat_id='.$self_detail['id'].'" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                                    <a href="#" title="Trash" class="delete-u" onclick="deletep('.$self_detail['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
											   echo '</tr>';
											   
											   $i++;
                             ?> 
							 <?php                  
                    }
					

					
                    ?> 
                    
                                        </tbody>
                                    </table>
                                    </div>
									<script>
$(document).ready(function(){
$container = $('<div/>').attr('id', 'imgPreviewWithStyles').append('<img width="200"/>').hide().css('position', 'absolute').appendTo('body'),

$img = $('img', $container),
    $('a.imghover:not(.brand)').mousemove(function (e) {
    $container.css({
        top: e.pageY + 20 + 'px',
        left: e.pageX + 20 + 'px'
    });

}).hover(function () {

    var link = this;
    $container.show();
    $img.load(function () {
        //$container.removeClass(s.containerLoadingClass);
        $img.addClass('img-rounded');
        $img.show();
        //s.onLoad.call($img[0], link);
    }).attr('src', $(link).prop('href'));
    //alert($(link).prop('href'));
    //s.onShow.call($container[0], link);

}, function () {

    $container.hide();
    $img.unbind('load').attr('src', '').hide();
    //s.onHide.call($container[0], this);

});	
});
</script>					
                   