<?php
/* @var $this ObjectController */
/* @var $data Object */
echo CHtml::ajaxLink('action ajax',
    CController::createUrl('/object/index'), array(
        'type' => 'POST',
        'data' => array('test'=>52),
        //'success'=>'function(data){ refresh(); }',
        'update' => ".ajax"

    ));
?>

<div class="view" id="view<?php echo $data->id; ?>">
    <div class="row">
        <?php echo CHtml::link('Refresh','#',array('onclick'=>'return refresh('. $data->id .')')) ?>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price1')); ?>:</b>
	<?php echo CHtml::encode($data->price1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price2')); ?>:</b>
	<?php echo CHtml::encode($data->price2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_catalog')); ?>:</b>
	<?php echo CHtml::encode($data->id_catalog); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviews')); ?>:</b>
	<?php echo CHtml::encode($data->reviews); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('new')); ?>:</b>
	<?php echo CHtml::encode($data->new); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale')); ?>:</b>
	<?php echo CHtml::encode($data->sale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />




</div>