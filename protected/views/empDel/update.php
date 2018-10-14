<?php
/* @var $this EmpDelController */
/* @var $model EmpDel */

$this->breadcrumbs=array(
	'Emp Dels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpDel', 'url'=>array('index')),
	array('label'=>'Create EmpDel', 'url'=>array('create')),
	array('label'=>'View EmpDel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EmpDel', 'url'=>array('admin')),
);
?>

<h1>Update EmpDel <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>