<div class="form" id="usereditForm">
<?php $form=$this->beginWidget('CActiveForm', array(
	
)); ?>
	<div>
		<ul id="errorMessages"></ul>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'id'); ?>
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>20,'maxlength'=>20,'id'=>'txtFname')); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->	