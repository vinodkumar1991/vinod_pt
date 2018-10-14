<?php
/* @var $this MPSUPLOADSController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsuploads',
);

$this->menu=array(
	array('label'=>'Create MPSUPLOADS', 'url'=>array('create')),
	array('label'=>'Manage MPSUPLOADS', 'url'=>array('admin')),
);
?>

<h1>Mpsuploads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>