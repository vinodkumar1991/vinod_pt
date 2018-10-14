<?php
/* @var $this MPSAREASController */
/* @var $model MPSAREAS */

$this->breadcrumbs=array(
	'Mpsareases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSAREAS', 'url'=>array('index')),
	array('label'=>'Manage MPSAREAS', 'url'=>array('admin')),
);
?>

<h1>Create MPSAREAS</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>