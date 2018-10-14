<?php
/* @var $this MPSLOCATIONSController */
/* @var $model MPSLOCATIONS */

$this->breadcrumbs=array(
	'Mpslocations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSLOCATIONS', 'url'=>array('index')),
	array('label'=>'Manage MPSLOCATIONS', 'url'=>array('admin')),
);
?>

<h1>Create MPSLOCATIONS</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>