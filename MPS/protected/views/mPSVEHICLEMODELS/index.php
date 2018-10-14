<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsvehiclemodels',
);

$this->menu=array(
	array('label'=>'Create MPSVEHICLEMODELS', 'url'=>array('create')),
	array('label'=>'Manage MPSVEHICLEMODELS', 'url'=>array('admin')),
);
?>

<h1>Mpsvehiclemodels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>