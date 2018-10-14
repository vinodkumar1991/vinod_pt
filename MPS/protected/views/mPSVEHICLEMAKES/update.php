<?php
/* @var $this MPSVEHICLEMAKESController */
/* @var $model MPSVEHICLEMAKES */

$this->breadcrumbs=array(
	'Mpsvehiclemakes'=>array('index'),
	$model->makes_id=>array('view','id'=>$model->makes_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MPSVEHICLEMAKES', 'url'=>array('index')),
	array('label'=>'Create MPSVEHICLEMAKES', 'url'=>array('create')),
	array('label'=>'View MPSVEHICLEMAKES', 'url'=>array('view', 'id'=>$model->makes_id)),
	array('label'=>'Manage MPSVEHICLEMAKES', 'url'=>array('admin')),
);
?>

<h1>Update MPSVEHICLEMAKES <?php echo $model->makes_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>