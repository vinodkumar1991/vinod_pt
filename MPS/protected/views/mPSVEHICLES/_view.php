<?php
/* @var $this MPSVEHICLESController */
/* @var $data MPSVEHICLES */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('makes_id')); ?>:</b>
	<?php echo CHtml::encode($data->makes_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('models_id')); ?>:</b>
	<?php echo CHtml::encode($data->models_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maker_model_name')); ?>:</b>
	<?php echo CHtml::encode($data->maker_model_name); ?>
	<br />


</div>