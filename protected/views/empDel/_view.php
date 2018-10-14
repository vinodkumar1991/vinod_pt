<?php
/* @var $this EmpDelController */
/* @var $data EmpDel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm')); ?>:</b>
	<?php echo CHtml::encode($data->nm); ?>
	<br />


</div>