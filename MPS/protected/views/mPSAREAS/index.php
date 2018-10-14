<?php
/* @var $this MPSAREASController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsareases',
);

$this->menu=array(
	array('label'=>'Create MPSAREAS', 'url'=>array('create')),
	array('label'=>'Manage MPSAREAS', 'url'=>array('admin')),
);
?>

<h1>Mpsareases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>