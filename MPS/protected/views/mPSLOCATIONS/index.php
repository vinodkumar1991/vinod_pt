<?php
/* @var $this MPSLOCATIONSController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpslocations',
);

$this->menu=array(
	array('label'=>'Create MPSLOCATIONS', 'url'=>array('create')),
	array('label'=>'Manage MPSLOCATIONS', 'url'=>array('admin')),
);
?>

<h1>Mpslocations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>