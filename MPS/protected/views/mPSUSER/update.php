<?php
/* @var $this MPSUSERController */
/* @var $model MPSUSER */

$this->breadcrumbs=array(
	'Mpsusers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSUSER', 'url'=>array('index')),
	array('label'=>'Create MPSUSER', 'url'=>array('create')),
	array('label'=>'View MPSUSER', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MPSUSER', 'url'=>array('admin')),
);
?>

<h1>Update MPSUSER <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>