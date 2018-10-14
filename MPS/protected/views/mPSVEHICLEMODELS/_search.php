<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $model MPSVEHICLEMODELS */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'models_id'); ?>
		<?php echo $form->textField($model,'models_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'models_name'); ?>
		<?php echo $form->textField($model,'models_name',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'makes_id'); ?>
		<?php echo $form->textField($model,'makes_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->