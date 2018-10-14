<?php
/* @var $this MPSSTATESController */
/* @var $model MPSSTATES */

$this->breadcrumbs=array(
	'Mpsstates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MPSSTATES', 'url'=>array('index')),
	array('label'=>'Create MPSSTATES', 'url'=>array('create')),
	array('label'=>'Update MPSSTATES', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MPSSTATES', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSSTATES', 'url'=>array('admin')),
);
?>

<h1>View MPSSTATES #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'country_id',
	),
)); ?>
