<?php /*
 To diplay the permissions linked to each role
*/?>
<p id="subsectionheading">Permissions linked to the above selected Role</p>
<div class="hint">(Please note: If no Role is selected, the Permissions of the top-most Role are displayed.)</div>
 
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'child-grid',
    'dataProvider'=>$child_model->searchIncludingPermissions($parentID),
    'filter'=>$child_model,
    'columns'=>array(
        
        array(
            'name'=>'rid',
            'value'=>'($data->relPermission)?$data->
                relPermission->rid:""', /* Test for
                empty related fields not to crash the program */
            'header'=>'Permission Description',
            //'filter' => CHtml::activeTextField($child_model,
            //'desc'),
        ),
        array(
            'name'=>'pid',
            'value'=>'($data->relPermission)?$data->
                relPermission->pid:""', /* Test for
                empty related fields not to crash the program */
            'header'=>'Permission Description',
            //'filter' => CHtml::activeTextField($child_model,
            //'desc'),
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'viewButtonUrl' => 'array("Permissions/view",
            "id"=>$data->pid)',
            'updateButtonUrl' => 'array("Permissions/update",
            "id"=>$data->pid)',
            'deleteButtonUrl' => 'array("Permissions/delete",
            "id"=>$data->pid)',
        ),
    ),
));
?>