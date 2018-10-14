<?php
/* @var $this EmpDelController */
/* @var $model EmpDel */

$this->breadcrumbs=array(
	'Emp Dels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EmpDel', 'url'=>array('index')),
	array('label'=>'Create EmpDel', 'url'=>array('create')),
	array('label'=>'Update EmpDel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmpDel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpDel', 'url'=>array('admin')),
);
?>

<h1>View EmpDel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nm',
	),
)); ?>
