<?php
/* @var $this MPSSTATESController */
/* @var $model MPSSTATES */

$this->breadcrumbs=array(
	'Mpsstates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSSTATES', 'url'=>array('index')),
	array('label'=>'Manage MPSSTATES', 'url'=>array('admin')),
);
?>

<h1>Create MPSSTATES</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>