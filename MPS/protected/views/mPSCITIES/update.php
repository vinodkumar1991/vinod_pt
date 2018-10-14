<?php
/* @var $this MPSCITIESController */
/* @var $model MPSCITIES */

$this->breadcrumbs=array(
	'Mpscities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSCITIES', 'url'=>array('index')),
	array('label'=>'Create MPSCITIES', 'url'=>array('create')),
	array('label'=>'View MPSCITIES', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MPSCITIES', 'url'=>array('admin')),
);
?>

<h1>Update MPSCITIES <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>