<?php
/* @var $this MPSAREASController */
/* @var $model MPSAREAS */

$this->breadcrumbs=array(
	'Mpsareases'=>array('index'),
	$model->area_code,
);

$this->menu=array(
	array('label'=>'List MPSAREAS', 'url'=>array('index')),
	array('label'=>'Create MPSAREAS', 'url'=>array('create')),
	array('label'=>'Update MPSAREAS', 'url'=>array('update', 'id'=>$model->area_code)),
	array('label'=>'Delete MPSAREAS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->area_code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSAREAS', 'url'=>array('admin')),
);
?>

<h1>View MPSAREAS #<?php echo $model->area_code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'city_code',
		'area_code',
		'area_name',
	),
)); ?>
