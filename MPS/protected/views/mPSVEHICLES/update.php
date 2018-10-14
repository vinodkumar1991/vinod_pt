<?php
/* @var $this MPSVEHICLESController */
/* @var $model MPSVEHICLES */

$this->breadcrumbs=array(
	'Mpsvehicles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSVEHICLES', 'url'=>array('index')),
	array('label'=>'Create MPSVEHICLES', 'url'=>array('create')),
	array('label'=>'View MPSVEHICLES', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MPSVEHICLES', 'url'=>array('admin')),
);
?>

<h1>Update MPSVEHICLES <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>