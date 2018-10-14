<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $model MPSVEHICLEMODELS */

$this->breadcrumbs=array(
	'Mpsvehiclemodels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSVEHICLEMODELS', 'url'=>array('index')),
	array('label'=>'Manage MPSVEHICLEMODELS', 'url'=>array('admin')),
);
?>

<h1>Create MPSVEHICLEMODELS</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>