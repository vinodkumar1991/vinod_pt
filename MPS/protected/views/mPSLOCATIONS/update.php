<?php
/* @var $this MPSLOCATIONSController */
/* @var $model MPSLOCATIONS */

$this->breadcrumbs=array(
	'Mpslocations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSLOCATIONS', 'url'=>array('index')),
	array('label'=>'Create MPSLOCATIONS', 'url'=>array('create')),
	array('label'=>'View MPSLOCATIONS', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MPSLOCATIONS', 'url'=>array('admin')),
);
?>

<h1>Update MPSLOCATIONS <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>