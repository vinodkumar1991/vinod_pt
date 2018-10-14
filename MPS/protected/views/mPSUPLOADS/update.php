<?php
/* @var $this MPSUPLOADSController */
/* @var $model MPSUPLOADS */

$this->breadcrumbs=array(
	'Mpsuploads'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSUPLOADS', 'url'=>array('index')),
	array('label'=>'Create MPSUPLOADS', 'url'=>array('create')),
	array('label'=>'View MPSUPLOADS', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage MPSUPLOADS', 'url'=>array('admin')),
);
?>

<h1>Update MPSUPLOADS <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>