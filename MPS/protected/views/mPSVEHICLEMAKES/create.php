<?php
/* @var $this MPSVEHICLEMAKESController */
/* @var $model MPSVEHICLEMAKES */

$this->breadcrumbs=array(
	'Mpsvehiclemakes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MPSVEHICLEMAKES', 'url'=>array('index')),
	array('label'=>'Manage MPSVEHICLEMAKES', 'url'=>array('admin')),
);
?>

<h1>Create MPSVEHICLEMAKES</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>