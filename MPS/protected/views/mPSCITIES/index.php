<?php
/* @var $this MPSCITIESController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpscities',
);

$this->menu=array(
	array('label'=>'Create MPSCITIES', 'url'=>array('create')),
	array('label'=>'Manage MPSCITIES', 'url'=>array('admin')),
);
?>

<h1>Mpscities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>