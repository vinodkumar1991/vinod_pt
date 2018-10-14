<?php
/* @var $this MPSVEHICLEMAKESController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsvehiclemakes',
);

$this->menu=array(
	array('label'=>'Create MPSVEHICLEMAKES', 'url'=>array('create')),
	array('label'=>'Manage MPSVEHICLEMAKES', 'url'=>array('admin')),
);
?>

<h1>Mpsvehiclemakes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>