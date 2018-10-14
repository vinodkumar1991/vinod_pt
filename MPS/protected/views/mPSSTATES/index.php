<?php
/* @var $this MPSSTATESController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsstates',
);

$this->menu=array(
	array('label'=>'Create MPSSTATES', 'url'=>array('create')),
	array('label'=>'Manage MPSSTATES', 'url'=>array('admin')),
);
?>

<h1>Mpsstates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>