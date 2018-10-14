<?php
/* @var $this MPSUSERController */
/* @var $model MPSUSER */

$this->breadcrumbs=array(
	'Mpsusers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MPSUSER', 'url'=>array('index')),
	array('label'=>'Create MPSUSER', 'url'=>array('create')),
	array('label'=>'Update MPSUSER', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MPSUSER', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSUSER', 'url'=>array('admin')),
);
?>

<h1>View MPSUSER #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'password',
		'role_id',
	),
)); ?>
