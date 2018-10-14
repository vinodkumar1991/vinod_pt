<?php
/* @var $this MPSVEHICLESController */
/* @var $model MPSVEHICLES */

$this->breadcrumbs=array(
	'Mpsvehicles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSVEHICLES', 'url'=>array('index')),
	array('label'=>'Manage MPSVEHICLES', 'url'=>array('admin')),
);
?>

<h1>Create MPSVEHICLES</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>