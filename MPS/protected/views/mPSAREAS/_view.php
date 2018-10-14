<?php
/* @var $this MPSAREASController */
/* @var $data MPSAREAS */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->area_code), array('view', 'id'=>$data->area_code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_code')); ?>:</b>
	<?php echo CHtml::encode($data->city_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_name')); ?>:</b>
	<?php echo CHtml::encode($data->area_name); ?>
	<br />


</div>