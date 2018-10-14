<?php
/* @var $this MPSAREASController */
/* @var $model MPSAREAS */

$this->breadcrumbs=array(
	'Mpsareases'=>array('index'),
	$model->area_code=>array('view','id'=>$model->area_code),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSAREAS', 'url'=>array('index')),
	array('label'=>'Create MPSAREAS', 'url'=>array('create')),
	array('label'=>'View MPSAREAS', 'url'=>array('view', 'id'=>$model->area_code)),
	array('label'=>'Manage MPSAREAS', 'url'=>array('admin')),
);
?>

<h1>Update MPSAREAS <?php echo $model->area_code; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>