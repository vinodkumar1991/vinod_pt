<?php
/* @var $this MPSVEHICLESController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsvehicles',
);

$this->menu=array(
	array('label'=>'Create MPSVEHICLES', 'url'=>array('create')),
	array('label'=>'Manage MPSVEHICLES', 'url'=>array('admin')),
);
?>

<h1>Mpsvehicles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>