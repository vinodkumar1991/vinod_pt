<?php
/* @var $this MPSVEHICLESController */
/* @var $model MPSVEHICLES */

$this->breadcrumbs=array(
	'Mpsvehicles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MPSVEHICLES', 'url'=>array('index')),
	array('label'=>'Create MPSVEHICLES', 'url'=>array('create')),
	array('label'=>'Update MPSVEHICLES', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MPSVEHICLES', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSVEHICLES', 'url'=>array('admin')),
);
?>

<h1>View MPSVEHICLES #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'makes_id',
		'models_id',
		'year',
		'maker_model_name',
	),
)); ?>
