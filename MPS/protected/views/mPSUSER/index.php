<?php
/* @var $this MPSUSERController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mpsusers',
);

$this->menu=array(
	array('label'=>'Create MPSUSER', 'url'=>array('create')),
	array('label'=>'Manage MPSUSER', 'url'=>array('admin')),
);
?>

<h1>Mpsusers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
