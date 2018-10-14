<?php
/* @var $this MPSLOCATIONSController */
/* @var $data MPSLOCATIONS */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_code')); ?>:</b>
	<?php echo CHtml::encode($data->country_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_code')); ?>:</b>
	<?php echo CHtml::encode($data->state_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_code')); ?>:</b>
	<?php echo CHtml::encode($data->city_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_code')); ?>:</b>
	<?php echo CHtml::encode($data->area_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->zipcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_name')); ?>:</b>
	<?php echo CHtml::encode($data->location_name); ?>
	<br />


</div>