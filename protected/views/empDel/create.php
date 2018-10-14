<?php
/* @var $this EmpDelController */
/* @var $model EmpDel */

$this->breadcrumbs=array(
	'Emp Dels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpDel', 'url'=>array('index')),
	array('label'=>'Manage EmpDel', 'url'=>array('admin')),
);
?>

<h1>Create EmpDel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>