<style type="text/css">
<!--
.datahighlight { background-color: #ffdc87 !important; }
.datahighlight2 { background-color: #C3D9FF !important; }
div.ui-dialog form div.simple { margin: 5px 3px 5px 3px; }
div.ui-dialog form div.simple textarea#DDMediaAction_selectedItems { font-size:smaller; }
// -->
</style>
<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
$this->menu = array(
    //array('label'=>'Rename','url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>"showDialog('rename');")),
    //array('label'=>'Move','url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>"showDialog('move');")),
    //array('label'=>'Delete','url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>"showDialog('delete');")),
    array('label'=>Yii::t('MediaModule.main','Create New Dir'),'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>"doShowDialog=true;showDialog('newdir');")),
    array('label'=>Yii::t('MediaModule.main','Upload File'),'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>"doShowDialog=true;showDialog('upload');")),
);
?>

<h1><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Media Browser')); ?></h1>

<?php 
/* DEBUG*/
echo "<li>basePath: ".$basePath; 
echo "<li>path: ".$path; 
echo "<li>currentPath: ".$currentPath; 
/* */
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h2><?php echo str_replace(array($basePath.'/','/'),array('',' / '),$currentPath); ?></h2>

<?php
/*
// echo "<li>basePath: $basePath";
// echo "<li>currentPath: $currentPath";
$relativePath = str_replace($basePath.'/','',$currentPath);
if($relativePath==$currentPath)
    $relativePath='';
// echo "<li>relativePath: $relativePath";
$subDirs = explode('/',$relativePath);
if($subDirs==array(''))
    $subDirs = array();
// echo "<h3>subDirs</h3>";
// var_dump($subDirs);
$dirsBreadcrumbs = $dirsBreadcrumbs2 = $links = array();
foreach($subDirs as $n=>$subDir) {
    $dirsBreadcrumbs[$n] = $subDir;
    if(isset($dirsBreadcrumbs[$n-1]))
        $dirsBreadcrumbs[$n] = $dirsBreadcrumbs[$n-1].'/'.$dirsBreadcrumbs[$n];
}
// echo "<h3>dirsBreadcrumbs</h3>";
// var_dump($dirsBreadcrumbs);
foreach($dirsBreadcrumbs as $n=>$subDir) {
    $dirsBreadcrumbs2[basename($subDir)] = $subDir;
}
// echo "<h3>dirsBreadcrumbs2</h3>";
// var_dump($dirsBreadcrumbs2);
$links[] = array(
    'link'=>CHtml::link(
        Yii::t('MediaModule.main','Base Path'),
        array('index')),
    'subDirs'=>DDMediaDirectory::getSubDirs($basePath)
);
foreach($dirsBreadcrumbs2 as $title=>$subDir) {
    $links[] = array(
        'path'=>urlencode($subDir),
        'link'=>CHtml::link($title,array('index','p'=>urlencode($subDir))),
        'subDir'=>$title,
        'subDirs'=>DDMediaDirectory::getSubDirs($basePath.'/'.$subDir)
    );
}
// echo "<h3>links</h3>";
// var_dump($links);

 */

/*
echo '<form id="dirForm" method="get" action="'.$this->createUrl('index').'">';
echo '<input type="hidden" id="r" name="r" value="media" />';
echo '<input type="hidden" id="p" name="p" size="20" />';
echo '<table class="media-dir-nav"><tr valign="top">';
foreach($links as $i=>$link) {
    echo '<td nowrap="nowrap" style="vertical-align:top">';
    echo $link['link'].'<br />';
    if(count($link['subDirs'])>0) {
        echo '<select size="3" onchange="if(jQuery(this).val()!=\'\') {jQuery(\'#p\').val(this.value);jQuery(\'#dirForm\').submit();}">';
        // echo '<option value="">'.(isset($link['subDir']) ? $link['subDir'] : '(Base Path)').'</option>';
        // echo '<option value="">-</option>';
        foreach($link['subDirs'] as $subDir) {
            $value='';
            if(isset($link['path']))
                $value = $link['path'].'/';
            echo '<option value="'.$value.$subDir.'">'.$subDir.'</option>';
        }
        echo '</select>';
    }
    echo "</td>";
    if(isset($links[$i+1]))
        echo '<td style="font-weight:bold;padding: 0 3px 0 3px;vertical-align:top">/</td>';
}
echo "</tr></table></form>";
 */
?>

<?php $this->widget('media.widgets.DDMediaPathSelector', array('basePath'=>$basePath,'currentPath'=>$currentPath, 'showHiddenDirs'=>false)); ?>

<?php if(trim($msg)!=='') : ?>
<p>
<?php echo $msg; ?>
</p>
<?php endif; ?>

<?php 
// Yii::import('DDVarDumper');
// Yii::app()->clientScript->registerCoreScript('jquery');
// DDVarDumper::dumpAsList($files); 
?>

<table class="media-items<?php echo !is_null($this->module->tableCssClass) ? ' '.$this->module->tableCssClass : ''; ?>">
    <thead>
        <tr>
            <th><input type="checkbox" value="" onclick="toggleAll(this.checked);" /></th>
            <th><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Icon')); ?></th>
            <th><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Name')); ?></th>
            <th><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Date')); ?></th>
            <th><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Type')); ?></th>
            <th><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Size')); ?></th>
            <th><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <!-- {{{ Dirs -->
        <?php foreach($files['dirs'] as $dirPath=>$stats) : ?>
        <?php /* $onclick=""; if(!in_array($stats['name'],array('.', '..'))) */ $onclick=' onclick="selectMedia(\'directory\',\''.$dirPath.'\',\''.$stats['name'].'\');"'; ?>
        <tr class="dirsFilesRows"<?php echo $onclick; ?>>
            <td>
                <?php if(!in_array($stats['name'], array('.','..'))) : ?>
                <input type="checkbox" name="chSelectedItem[]" value="<?php echo $stats['name']; ?>" class="chSelectedItems" />
                <?php endif; ?>
            </td>
            <td class="folder"><?php echo CHtml::image($this->module->assetsUrl.'/filetypeicons/folder.png',$stats['name']); ?></td>
            <td><?php echo CHtml::link($stats['name'],array('index','p'=>urlencode($path.'/'.$stats['name']))); ?></td>
            <td>&ndash;</td>
            <td><?php echo CHtml::encode(Yii::t('MediaModule.main','Directory')); ?></td>
            <td style="white-space:nowrap;font-size:smaller;text-align:right"><?php echo $stats['size']; ?></td>
            <td style="white-space:nowrap;font-size:smaller">
                <?php if(!in_array($stats['name'],array('..'))) : ?>
                <a href="javascript:void(0)" onclick="selectMedia('directory','<?php echo $dirPath; ?>','<?php echo $stats['name']; ?>');showDialog('rename');" title="<?php echo Yii::t('MediaModule.main', 'Rename directory {dir}', array('{dir}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'R')); ?></a>&nbsp;
                <a href="javascript:void(0)" onclick="selectMedia('directory','<?php echo $dirPath; ?>','<?php echo $stats['name']; ?>');showDialog('copy');" title="<?php echo Yii::t('MediaModule.main', 'Copy directory {dir}', array('{dir}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'C')); ?></a>&nbsp;
                <a href="javascript:void(0)" onclick="selectMedia('directory','<?php echo $dirPath; ?>','<?php echo $stats['name']; ?>');showDialog('move');" title="<?php echo Yii::t('MediaModule.main', 'Move directory {dir}', array('{dir}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'M')); ?></a>&nbsp;
                <a href="javascript:void(0)" onclick="selectMedia('directory','<?php echo $dirPath; ?>','<?php echo $stats['name']; ?>');showDialog('delete');" title="<?php echo Yii::t('MediaModule.main', 'Delete directory {dir}', array('{dir}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'X')); ?></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- }}} -->
        <!-- {{{ Files -->
        <?php foreach($files['files'] as $filePath=>$stats) : ?>
        <?php $onclick=""; if(!in_array($stats['name'],array('.', '..'))) $onclick=' onclick="selectMedia(\'file\',\''.$filePath.'\',\''.$stats['name'].'\');"'; ?>
        <tr class="dirsFilesRows"<?php echo $onclick; ?>>
            <td>
                <?php if(!in_array($stats['name'], array('.','..'))) : ?>
                <input type="checkbox" name="chSelectedItem[]" value="<?php echo $stats['name']; ?>" onclick="collectChSelectedItems();" class="chSelectedItems" />
                <?php endif; ?>
            </td>
            <td>
<?php
if(preg_match("/image\/(.*)/",$stats['mimeType'],$matches))
    echo CHtml::image($this->createUrl('thumbnail',array('path'=>urlencode($stats['path']),'x'=>75)));
else
    echo CHtml::image($this->createUrl('thumbnail',array('path'=>urlencode($stats['path']),'x'=>0)), 'File', array( 'style'=>'width: 40px; height: 40px;' ) );
?>
            </td>
            <td>
<?php
if(preg_match("/image\/(.*)/",$stats['mimeType'],$matches))
    echo CHtml::link($stats['name'],'javascript:void(0)',array('onclick'=>"jQuery('#imagePreview').dialog('open');jQuery('#imagePlaceholder').html('".CHtml::image($this->createUrl('thumbnail',array('path'=>urlencode($stats['path']),'x'=>480)))."');"));
elseif(preg_match("/text\/plain/",$stats['mimeType'],$matches)) {
    echo CHtml::link($stats['name'],'javascript:void(0)',array('onclick'=>'
$.ajax({
    url: "'.$this->createUrl('preview',array('path'=>urlencode($stats['path']))).'",
}).done(function(data) { 
    $("#imagePreview").dialog("open");
    $("#imagePreview").html(data);
});')); 
}
else
    echo CHtml::link($stats['name'],array('download','path'=>urlencode($stats['path'])),array('target'=>'_blank')); 
?></td>
            <td><?php echo date("Y-m-d H:i:s",$stats['mTime']); ?></td>
            <td><?php echo $stats['mimeType']; ?></td>
            <td style="white-space:nowrap;font-size:smaller;text-align:right"><?php echo $stats['sizeFormatted']; ?></td>
            <td style="white-space:nowrap;font-size:smaller">
                <a href="javascript:void(0)" onclick="selectMedia('file','<?php echo $filePath; ?>','<?php echo $stats['name']; ?>');showDialog('rename');" title="<?php echo Yii::t('MediaModule.main', 'Rename file {file}', array('{file}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'R')); ?></a>&nbsp;
                <a href="javascript:void(0)" onclick="selectMedia('file','<?php echo $filePath; ?>','<?php echo $stats['name']; ?>');showDialog('copy');" title="<?php echo Yii::t('MediaModule.main', 'Copy file {file}', array('{file}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'C')); ?></a>&nbsp;
                <a href="javascript:void(0)" onclick="selectMedia('file','<?php echo $filePath; ?>','<?php echo $stats['name']; ?>');showDialog('move');" title="<?php echo Yii::t('MediaModule.main', 'Move file {file} to another location', array('{file}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'M')); ?></a>&nbsp;
                <a href="javascript:void(0)" onclick="selectMedia('file','<?php echo $filePath; ?>','<?php echo $stats['name']; ?>');showDialog('delete');" title="<?php echo Yii::t('MediaModule.main', 'Delete file {file}', array('{file}'=>$stats['name'])); ?>"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'X')); ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- }}} -->
        <!-- {{{ Batch Selection Row -->
        <tr>
            <td colspan="7">
                &dArr;&rArr;&nbsp;
                <input type="hidden" name="path" id="path" value="<?php echo $path; ?>" size="20" />
                <select name="batchAction" id="batchAction" onchange="if(this.value!=='') { doBatchJob=true; doShowDialog=true; showDialog(this.value); }">
                    <option value=""><?php echo CHtml::encode(Yii::t('MediaModule.main', '(Batch Action)')); ?></option>
                    <option value="move"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Move')); ?></option>
                    <option value="delete"><?php echo CHtml::encode(Yii::t('MediaModule.main', 'Delete')); ?></option>
                </select>
            </td>
        </tr>
        <!-- }}} -->
    </tbody>
</table>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'imagePreview',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Selected Item',
        'autoOpen'=>false,
        'modal'=>true,
        'position'=>'center',
        'width'=>500,
    ),
)); ?>
<div id="imagePlaceholder" style="width:100%"></div>
<?php $this->endWidget(); ?>

<?php $this->renderPartial('_mediaAction',array('model'=>$mediaAction)); ?>
<?php Yii::app()->clientScript->registerScript('highlightRow',
"$('.dirsFilesRows').hover(function(){
			$(this).children().addClass('datahighlight2');
		},function(){
			$(this).children().removeClass('datahighlight2');
		});
$('.dirsFilesRows td').click(function() {
        $(this).closest('tr').siblings().removeClass('datahighlight2').removeClass('datahighlight');
        $(this).parents('tr').toggleClass('datahighlight2', this.clicked);
    });
"); ?>
<script type="text/javascript">
<!--
    var currentPath = '<?php echo $currentPath; ?>';
    var selectedItem = '.';
    var doBatchJob=false;
    var doShowDialog=false;
    var selectedItems=[];
    function toggleAll(toggle) // {{{ 
    {
        $('.chSelectedItems').each( function() {
            if(this.checked)
                this.checked=false;
            else
                this.checked=true;
        });
    } // }}} 
    // {{{ collectChSelectedItems
    function collectChSelectedItems()
    {
        selectedItems = [];
        $('.chSelectedItems').each( function() {
            if( this.checked ) {
                selectedItems.push( this.value );
            }
        });
        console.log('selectedItems: ' + selectedItems.join("; "));
        jQuery('#DDMediaAction_selectedItems, #DDMediaAction_selectedItemsOld').val(selectedItems.join("\n"));
    } // }}} 
    // {{{ selectMedia
    function selectMedia(mediaType, path, name)
    {
        if(name=='..') 
            doShowDialog=false;
        else
            doShowDialog=true;
        jQuery('#DDMediaAction_mediaType').val(mediaType);
        jQuery('#DDMediaAction_path').val(jQuery('#path').val());
        jQuery('#DDMediaAction_selectedItems, #DDMediaAction_selectedItemsOld').val(name);
        selectedItem = name;
    } // }}} 
    // {{{ showDialog
    function showDialog(action)
    {
        console.log('doShowDialog : ' + doShowDialog);
        console.log('doBatchJob   : ' + doBatchJob);
        if(doShowDialog==false)
            return;
        jQuery('#mydialog').dialog('open');
        if(doBatchJob==false) {
            // Single file
            jQuery('#mydialog').dialog({title:'<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Item: ')); ?>'+selectedItem /* +' &rArr; '+action */ });
            jQuery('#DDMediaAction_selectedItems, #DDMediaAction_selectedItemsOld').val(selectedItem);
        } else {
            // Multiple files - batch job
            collectChSelectedItems();
            jQuery('#mydialog').dialog({title:'<?php echo CHtml::encode(Yii::t('MediaModule.main','Multiple Selection')); ?>'});
            jQuery('#batchAction').val('');
        }
        jQuery('#DDMediaAction_action').val(action);
        jQuery('#mediaActionSubmitButton').val('Submit');
        jQuery('.msg').html('').hide();
        jQuery('#p1Row, #uploadedFileRow').hide();
        switch(action)
        {
            case 'rename': // {{{ 
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Rename')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Enter the new name:')); ?>').show();
                jQuery('#nameRowDisplayOnly, #p1Row').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'New Name')); ?>');
                jQuery('#DDMediaAction_p1').val(selectedItem);
                jQuery('#DDMediaAction_p1').focus().select();
                break; // }}} 
            case 'copy': // {{{ 
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Copy')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Enter the new destination and name:')); ?>').show();
                jQuery('#p1Row').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'New Dest. and Name')); ?>');
                jQuery('#DDMediaAction_p1').val('./'+selectedItem);
                jQuery('#DDMediaAction_p1').focus().select();
                break; // }}} 
            case 'move': // {{{
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Move')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Enter the new location:')); ?>').show();
                if(doBatchJob==false) {
                    jQuery('#DDMediaAction_p1').val('./'+selectedItem);
                } else {
                    jQuery('#DDMediaAction_p1').val('./');
                }
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Destination')); ?>');
                jQuery('#p1Row').show();
                jQuery('#DDMediaAction_p1').show().focus().select();
                break; // }}} 
            case 'delete': // {{{ 
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Delete')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Confirm to delete this item:')); ?>').show();
                jQuery('#nameRowDisplayOnly').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'File to delete')); ?>');
                break; // }}} 
            case 'newdir': // {{{ 
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Create')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Enter the name for the new directory:')); ?>').show();
                jQuery('#DDMediaAction_path').val(jQuery('#path').val());
                jQuery('#selectedItemsRow').hide();
                jQuery('#p1Row').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'New Directory')); ?>');
                jQuery('#DDMediaAction_p1').val('').focus().select();
                break; // }}} 
            case 'upload': // {{{ 
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Upload')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('MediaModule.main', 'Select a file to be uploaded:')); ?>').show();
                jQuery('#DDMediaAction_path').val(jQuery('#path').val());
                jQuery('#selectedItemsRow').hide();
                jQuery('#uploadedFileRow').show();
                jQuery('#DDMediaAction_uploadedFile').focus().select();
                break; // }}} 
        }
        doShowDialog=false;
    } // }}} 
// -->
</script>
