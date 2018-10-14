<?php
/* @var $this MPSCOUNTRIESController */
/* @var $model MPSCOUNTRIES */

$this->breadcrumbs=array(
	'Mpscountries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSCOUNTRIES', 'url'=>array('index')),
	array('label'=>'Create MPSCOUNTRIES', 'url'=>array('create')),
	array('label'=>'View MPSCOUNTRIES', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MPSCOUNTRIES', 'url'=>array('admin')),
);
?>

<h1>Update MPSCOUNTRIES <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>