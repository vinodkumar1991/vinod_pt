<?php
/* @var $this MPSUPLOADSController */
/* @var $model MPSUPLOADS */

$this->breadcrumbs=array(
	'Mpsuploads'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List MPSUPLOADS', 'url'=>array('index')),
	array('label'=>'Create MPSUPLOADS', 'url'=>array('create')),
	array('label'=>'Update MPSUPLOADS', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete MPSUPLOADS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSUPLOADS', 'url'=>array('admin')),
);
?>

<h1>View MPSUPLOADS #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
		'image_name',
		'imagepath',
		'data',
	),
)); ?>
