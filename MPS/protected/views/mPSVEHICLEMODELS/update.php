<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $model MPSVEHICLEMODELS */

$this->breadcrumbs=array(
	'Mpsvehiclemodels'=>array('index'),
	$model->models_id=>array('view','id'=>$model->models_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSVEHICLEMODELS', 'url'=>array('index')),
	array('label'=>'Create MPSVEHICLEMODELS', 'url'=>array('create')),
	array('label'=>'View MPSVEHICLEMODELS', 'url'=>array('view', 'id'=>$model->models_id)),
	array('label'=>'Manage MPSVEHICLEMODELS', 'url'=>array('admin')),
);
?>

<h1>Update MPSVEHICLEMODELS <?php echo $model->models_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>