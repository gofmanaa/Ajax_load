<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 15.03.2015
 * Time: 15:29
 */

Yii::app()->clientScript->registerScript('render_view', "
    function view( v )
    {
        v = v || 'tiles';
        $.ajax({
            url: '" . Yii::app()->createAbsoluteUrl('//object/list_tiles') ."',
            data : { view : v },
            type: 'POST',
            success: function(data)  {
              $.fn.yiiListView.update('all_objects', { data:$(this).serialize() }) ;
            }
        });
        return false;
    }
        function refresh(id)
        {
            $('#view'+id ).append( '<a>Click for Mark Information</a>' );
        return false;
        }

    ", CClientScript::POS_END);
echo "<pre>";
print_r( Yii::app()->user->getState('object_main_view'));
echo "</pre>";

if(Yii::app()->user->getState('object_main_view') == 'tiles')
    $mainItemsCssClass =  'tiles';
else
    $mainItemsCssClass = 'list';
$widget =  $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'enablePagination' => true,
    'itemView'=>'_view_'.$mainItemsCssClass,
    'ajaxUpdate' => true,
    'template' => '{items}',
    'id'=>'all_objects',
    'htmlOptions'=>array('class'=>$mainItemsCssClass)
)); ?>
<div class="grid-view-footer">
    <div class="paginationholder">
        <div id="pagination">
            <?php $widget->renderPager(); ?>
        </div>
    </div>
</div>
<div>
    <?php echo CHtml::link('V1$L', '#',array('onclick'=>"return  view('list'); ")) ?>
    <?php echo CHtml::link('V2$T', '#',array('onclick'=>"return  view('tiles'); ")) ?>
</div>
