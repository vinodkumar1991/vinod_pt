<?php
/* @var $this MPSCOUNTRIESController */
/* @var $model MPSCOUNTRIES */

$this->breadcrumbs=array(
	'Mpscountries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSCOUNTRIES', 'url'=>array('index')),
	array('label'=>'Manage MPSCOUNTRIES', 'url'=>array('admin')),
);
?>

<h1>Create MPSCOUNTRIES</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>