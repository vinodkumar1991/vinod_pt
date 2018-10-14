<?php
/* @var $this MPSVEHICLESController */
/* @var $model MPSVEHICLES */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'makes_id'); ?>
		<?php echo $form->textField($model,'makes_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'models_id'); ?>
		<?php echo $form->textField($model,'models_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maker_model_name'); ?>
		<?php echo $form->textField($model,'maker_model_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->