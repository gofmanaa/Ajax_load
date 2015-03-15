<?php
/* @var $this ObjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Objects',
);

$this->menu=array(
	array('label'=>'Create Object', 'url'=>array('create')),
	array('label'=>'Manage Object', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('render_object_view',"
$( document ).ready(function() {
        console.log( 'index document loaded' );
            $.ajax({
            type: 'post',
            url: '" . Yii::app()->createAbsoluteUrl('/object/index',array('Object_page'=>isset($_GET['Object_page'])?((int)$_GET['Object_page']):0)) ."',
            success: function(html){
                $('.ajax').html(html);
                console.log( '_index document loaded' );
            }
            });


        return false;
});");


?>

<h1>Objects</h1>

<div class="ajax">
    Loading...
</div>
