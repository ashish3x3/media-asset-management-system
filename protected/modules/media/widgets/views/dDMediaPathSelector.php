<form id="dirForm" method="get" action="<?php echo Yii::app()->createUrl($formActionId); ?>">
<input type="hidden" id="r" name="r" value="media" />
<input type="hidden" id="<?php echo $pathFieldId; ?>" name="<?php echo $pathFieldId; ?>" size="20" />
<table class="media-dir-nav">
    <tr valign="top">
<?php foreach($links as $i=>$link) : ?>
<?php
    echo "\t\t".'<td nowrap="nowrap" style="vertical-align:top">'."\n";
    echo "\t\t\t".$link['link']."<br />\n";
    if(count($link['subDirs'])>0) {
        echo "\t\t\t".'<select size="3" onchange="if(jQuery(this).val()!=\'\') {jQuery(\'#p\').val(this.value);jQuery(\'#dirForm\').submit();}">'."\n";
        // echo '<option value="">'.(isset($link['subDir']) ? $link['subDir'] : '(Base Path)').'</option>';
        // echo '<option value="">-</option>';
        foreach($link['subDirs'] as $subDir) {
            $value='';
            if(isset($link['path']))
                $value = $link['path'].'/';
            echo "\t\t\t\t".'<option value="'.$value.$subDir.'">'.$subDir."</option>\n";
        }
        echo "\t\t\t</select>\n";
    }
    echo "\t\t</td>\n";
    if(isset($links[$i+1]))
        echo "\t\t\t<td style=\"font-weight:bold;padding: 0 3px 0 3px;vertical-align:top\">/</td>\n";
?>
<?php endforeach; ?>
    </tr>
</table>
</form>
