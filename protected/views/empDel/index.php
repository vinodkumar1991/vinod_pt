<?php
/* @var $this EmpDelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Dels',
);

$this->menu=array(
	array('label'=>'Create EmpDel', 'url'=>array('create')),
	array('label'=>'Manage EmpDel', 'url'=>array('admin')),
);
?>

<h1>Emp Dels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php 

?>

<?php 

?>