<?php 
/**
 * DDMediaAction class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media.models
 */

/**
 * Form Model for managing directory/file actions.
 */
class DDMediaAction extends CFormModel
{
    // {{{ *** Members ***
    public $path;
    public $selectedItems;
    public $selectedItemsOld;
    public $mediaType;
    public $action;
    public $p1;
    public $uploadedFile;
    // }}} 
    // {{{ rules
    public function rules()
    { 
        return array(
            array('path, mediaType, action','required'),
            array('action','checkActionParams'),
            array('selectedItems, selectedItemsOld, p1', 'safe'),
            array('uploadedFile','file','on'=>'upload'),
        );
    } // }}}
    // {{{ checkActionParams
    public function checkActionParams($attribute, $params=array())
    {
        switch($this->action)
        {
            case 'rename':
                if(trim($this->p1)=='') {
                    $this->addError('p1', 'Please enter the new name');
                }
                break;
            case 'move':
                if(trim($this->p1)=='') {
                    $this->addError('p1', 'Please enter the destination');
                }
                break;
            case 'newdir':
                if(trim($this->p1)=='') {
                    $this->addError('p1', 'Please enter the new directory name');
                }
                break;
        }
    } // }}}
    // {{{ attributeLabels
    public function attributeLabels()
    {
        return array(
            'path'              => Yii::t('MediaModule.main','Path'),
            'selectedItems'     => Yii::t('MediaModule.main','Selected Items'),
            'selectedItemsOld'  => Yii::t('MediaModule.main','Selected Items (old)'),
            'mediaType'         => Yii::t('MediaModule.main','Media Type'),
            'action'            => Yii::t('MediaModule.main','Action'),
            'p1'                => Yii::t('MediaModule.main','Parameter 1'),
            'uploadedFile'      => Yii::t('MediaModule.main','Upload File'),
        );
    } // }}}
    // {{{ doAction
    public function doAction()
    {
        $result = false;
        switch($this->action)
        {
            case 'rename': // {{{ 
                $result = true;
                $items = preg_split('/^\R$/', $this->selectedItems, -1, PREG_SPLIT_NO_EMPTY);
                foreach($items as $srcItem) {
                    $src = $this->path.'/'.$srcItem;
                    $dest = $this->path.'/'.$this->p1;
                    if($this->isWindows()) {
                        $src    = DDMediaDirectory::pathToWindows($src);
                        $dest   = DDMediaDirectory::pathToWindows($dest);
                    }
                    $result = $result && @rename($src, $dest);
                }
                $this->selectedItemsOld = join(', ', preg_split('/^\R$/', $this->selectedItems, -1, PREG_SPLIT_NO_EMPTY) );
                break; // }}} 
            case 'copy': // {{{
                $result = true;
                $items = preg_split('/^\R$/', $this->selectedItems, -1, PREG_SPLIT_NO_EMPTY);
                foreach($items as $srcItem) {
                    $src = $this->path.'/'.$srcItem;
                    $dest = $this->path.'/'.$this->p1;
                    if($this->isWindows()) {
                        $src    = DDMediaDirectory::pathToWindows($src);
                        $dest   = DDMediaDirectory::pathToWindows($dest);
                    }
                    $result = $result && $this->rcopy($src, $dest);
                }
                $this->selectedItemsOld = join(', ', preg_split('/^\R$/', $this->selectedItems, -1, PREG_SPLIT_NO_EMPTY) );
                break; // }}} 
            case 'delete': // {{{
                $result = true;
                $items = explode("\n", $this->selectedItems);
                foreach($items as $srcItem) {
                    $path = $this->path.'/'.$srcItem;
                    if($this->isWindows()) {
                        $path    = DDMediaDirectory::pathToUnix($path);
                    }
                    $result0 = DDMediaDirectory::rrmdir($path);
                    $result = $result && $result0;
                }
                break; // }}}
            case 'move': // {{{ 
                $result = true;
                $items = explode("\n", $this->selectedItems);
                foreach($items as $srcItem) {
                    $src    = $this->path.'/'.$srcItem;
                    $dest   = realpath($this->path.'/'.$this->p1).'/'.$srcItem;
                    if($this->isWindows()) {
                        $src    = DDMediaDirectory::pathToWindows($src);
                        $dest   = DDMediaDirectory::pathToWindows($dest);
                    }
                    $result = $result && @rename($src, $dest);
                }
                break; // }}} 
            case 'upload': // {{{ 
                var_dump($this->attributes);
                $this->uploadedFile=CUploadedFile::getInstance($this,'uploadedFile');
                $fileName = $this->selectedItemsOld = $this->uploadedFile->name;
                // Check if file already exists?
                $filePathAndName = $this->path.'/'.basename($fileName);
                $i=0;
                $add = $i==0 ? '' : '.'.($i+1);
                while(is_file($filePathAndName.$add))
                    $add = '.'.(++$i+1);
                $result = $this->uploadedFile->saveAs($this->path.'/'.basename($fileName).$add);
                $this->selectedItems = $this->path.'/'.basename($fileName).$add;
                break; // }}} 
            case 'newdir': // {{{ 
                $newDir = $this->path.'/'.$this->p1;
                if(!is_dir($newDir))
                    $result = @mkdir($newDir, 0770);
                if(is_dir($newDir))
                    $result = true;
                break; // }}} 
        }
        return $result;
    } // }}}
    // {{{ isWindows
    public function isWindows()
    {
        return strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN';
    } // }}} 
    // {{{ removes files and non-empty directories
    public static function rrmdir($dir) 
    {
        echo "<li>dir: ".$dir;
        echo "<li>realpath(dir): ".realpath($dir);
        if (is_dir(realpath($dir.'/'))) {
            echo " is dir";
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    echo "<li>file: $dir/$file".
                        $this->rrmdir("$dir/$file");
                }
            }
            rmdir($dir);
        } else {
            echo " is not a dir";
            if (file_exists($dir)) {
                unlink($dir);
            }
        }
        return true;
    } // }}} 
    // {{{ copies files and non-empty directories
    public function rcopy($src, $dst) 
    {
        if (file_exists($dst)) $this->rrmdir($dst);
        if (is_dir($src)) {
            mkdir($dst);
            $files = scandir($src);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rcopy("$src/$file", "$dst/$file"); 
        }
        else if (file_exists($src)) copy($src, $dst);
        return true;
    } // }}}
}
