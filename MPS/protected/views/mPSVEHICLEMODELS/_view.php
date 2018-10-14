<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $data MPSVEHICLEMODELS */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('models_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->models_id), array('view', 'id'=>$data->models_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('models_name')); ?>:</b>
	<?php echo CHtml::encode($data->models_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('makes_id')); ?>:</b>
	<?php echo CHtml::encode($data->makes_id); ?>
	<br />


</div>