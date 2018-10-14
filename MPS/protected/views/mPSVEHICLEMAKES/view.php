<?php
/* @var $this MPSVEHICLEMAKESController */
/* @var $model MPSVEHICLEMAKES */

$this->breadcrumbs=array(
	'Mpsvehiclemakes'=>array('index'),
	$model->makes_id,
);

$this->menu=array(
	array('label'=>'List MPSVEHICLEMAKES', 'url'=>array('index')),
	array('label'=>'Create MPSVEHICLEMAKES', 'url'=>array('create')),
	array('label'=>'Update MPSVEHICLEMAKES', 'url'=>array('update', 'id'=>$model->makes_id)),
	array('label'=>'Delete MPSVEHICLEMAKES', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->makes_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSVEHICLEMAKES', 'url'=>array('admin')),
);
?>

<h1>View MPSVEHICLEMAKES #<?php echo $model->makes_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'makes_id',
		'makes_name',
	),
)); ?>
