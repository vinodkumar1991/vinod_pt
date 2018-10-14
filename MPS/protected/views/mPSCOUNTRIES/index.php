<?php
/* @var $this MPSCOUNTRIESController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpscountries',
);

$this->menu=array(
	array('label'=>'Create MPSCOUNTRIES', 'url'=>array('create')),
	array('label'=>'Manage MPSCOUNTRIES', 'url'=>array('admin')),
);
?>

<h1>Mpscountries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>