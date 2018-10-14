<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $model MPSVEHICLEMODELS */

$this->breadcrumbs=array(
	'Mpsvehiclemodels'=>array('index'),
	$model->models_id,
);

$this->menu=array(
	array('label'=>'List MPSVEHICLEMODELS', 'url'=>array('index')),
	array('label'=>'Create MPSVEHICLEMODELS', 'url'=>array('create')),
	array('label'=>'Update MPSVEHICLEMODELS', 'url'=>array('update', 'id'=>$model->models_id)),
	array('label'=>'Delete MPSVEHICLEMODELS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->models_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSVEHICLEMODELS', 'url'=>array('admin')),
);
?>

<h1>View MPSVEHICLEMODELS #<?php echo $model->models_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'models_id',
		'models_name',
		'makes_id',
	),
)); ?>
