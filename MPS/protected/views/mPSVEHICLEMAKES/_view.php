<?php
/* @var $this MPSVEHICLEMAKESController */
/* @var $data MPSVEHICLEMAKES */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('makes_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->makes_id), array('view', 'id'=>$data->makes_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('makes_name')); ?>:</b>
	<?php echo CHtml::encode($data->makes_name); ?>
	<br />


</div>