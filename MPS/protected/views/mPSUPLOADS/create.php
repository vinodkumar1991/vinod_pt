<?php
/* @var $this MPSUPLOADSController */
/* @var $model MPSUPLOADS */

$this->breadcrumbs=array(
	'Mpsuploads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSUPLOADS', 'url'=>array('index')),
	array('label'=>'Manage MPSUPLOADS', 'url'=>array('admin')),
);
?>

<h1>Create MPSUPLOADS</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>