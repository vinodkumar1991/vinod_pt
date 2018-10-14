<?php
/* @var $this MPSUSERController */
/* @var $model MPSUSER */

$this->breadcrumbs=array(
	'Mpsusers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSUSER', 'url'=>array('index')),
	array('label'=>'Manage MPSUSER', 'url'=>array('admin')),
);
?>

<h1>Create MPSUSER</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>