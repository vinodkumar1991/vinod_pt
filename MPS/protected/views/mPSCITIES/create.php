<?php
/* @var $this MPSCITIESController */
/* @var $model MPSCITIES */

$this->breadcrumbs=array(
	'Mpscities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSCITIES', 'url'=>array('index')),
	array('label'=>'Manage MPSCITIES', 'url'=>array('admin')),
);
?>

<h1>Create MPSCITIES</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>