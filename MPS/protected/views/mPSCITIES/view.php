<?php
/* @var $this MPSCITIESController */
/* @var $model MPSCITIES */

$this->breadcrumbs=array(
	'Mpscities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MPSCITIES', 'url'=>array('index')),
	array('label'=>'Create MPSCITIES', 'url'=>array('create')),
	array('label'=>'Update MPSCITIES', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MPSCITIES', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSCITIES', 'url'=>array('admin')),
);
?>

<h1>View MPSCITIES #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'state_id',
	),
)); ?>
