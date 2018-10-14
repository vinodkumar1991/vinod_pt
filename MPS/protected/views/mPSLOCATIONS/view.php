<?php
/* @var $this MPSLOCATIONSController */
/* @var $model MPSLOCATIONS */

$this->breadcrumbs=array(
	'Mpslocations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MPSLOCATIONS', 'url'=>array('index')),
	array('label'=>'Create MPSLOCATIONS', 'url'=>array('create')),
	array('label'=>'Update MPSLOCATIONS', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MPSLOCATIONS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSLOCATIONS', 'url'=>array('admin')),
);
?>

<h1>View MPSLOCATIONS #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country_code',
		'state_code',
		'city_code',
		'area_code',
		'zipcode',
		'location_name',
	),
)); ?>
