<?php
/* @var $this MPSSTATESController */
/* @var $model MPSSTATES */

$this->breadcrumbs=array(
	'Mpsstates'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSSTATES', 'url'=>array('index')),
	array('label'=>'Create MPSSTATES', 'url'=>array('create')),
	array('label'=>'View MPSSTATES', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MPSSTATES', 'url'=>array('admin')),
);
?>

<h1>Update MPSSTATES <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>