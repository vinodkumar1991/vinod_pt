<?php
/* @var $this MPSCOUNTRIESController */
/* @var $model MPSCOUNTRIES */

$this->breadcrumbs=array(
	'Mpscountries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MPSCOUNTRIES', 'url'=>array('index')),
	array('label'=>'Create MPSCOUNTRIES', 'url'=>array('create')),
	array('label'=>'Update MPSCOUNTRIES', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MPSCOUNTRIES', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MPSCOUNTRIES', 'url'=>array('admin')),
);
?>

<h1>View MPSCOUNTRIES #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sortname',
		'name',
	),
)); ?>
