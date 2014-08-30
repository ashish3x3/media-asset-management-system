<?php
/**
 * DDMediaDirectory class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media.models
 */

/**
 * Model for managin directories.
 */
class DDMediaDirectory
{
    // {{{ *** Members ***
    public $dir;
    public $showHiddenFiles=false;
    private $_logTag='application.modules.media.models.DDmediaDirectory';
    // }}} 
    // {{{ *** Methods ***
    // {{{ __construct
    function __construct($dir=null)
    {
        if($dir!==null) {
            $this->dir = self::pathToUnix($dir);
            if(!is_dir($this->dir)) {
                throw new CHttpException(500, "{$this->dir} is not a directory");
            }
        }
    } // }}}
    // {{{ listContent
    public function listContent()
    {
        Yii::log("Directory: {$this->dir}", 'info', $this->_logTag);
        if ($handle = opendir($this->dir)) {
            $dirs = $files = array();
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                $entryPath = $this->dir.'/'.$entry;
                Yii::log("Entry: $entry", 'info', $this->_logTag);
                if(is_dir($entryPath)) {
                    $entryPathReal = $this->pathToUnix(realpath($entryPath));
                    // Directory
                    if(substr($entry,0,1)=='.' and !in_array($entry,array('.','..'))) {
                        if($this->showHiddenFiles==true)
                            $dirs[$entryPathReal] = $this->getMediaStats($entryPath);
                    } else {
                        $dirs[$entryPathReal] = $this->getMediaStats($entryPath);
                    }
                } else {
                    $file = new DDMediaFile($entryPath);
                    // File
                    // dot file/hidden?
                    if(substr($entry,0,1)=='.') {
                        if($this->showHiddenFiles==true)
                            $files[$entryPath] = $file->getMediaStats();
                    } else {
                        $files[$entryPath] = $file->getMediaStats();
                    }
                }
            }
            ksort($dirs);
            ksort($files);

            closedir($handle);
            return array('dirs'=>$dirs, 'files'=>$files);
        }

    } // }}}
    // {{{ getSubDirs
    public static function getSubDirs($dir, $showHiddenDirs=false)
    {
        if ($handle = opendir($dir)) {
            $dirs =array();
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if($entry!=='.' and $entry !=='..' and is_dir($dir.'/'.$entry)) {
                    if(substr($entry,0,1)=='.') {
                        if($showHiddenDirs==true)
                            $dirs[] = $entry;
                    } else {
                        $dirs[] = $entry;
                    }
                }
            }
            sort($dirs);
            return $dirs;
        }
    } // }}}
    // {{{ countItems
    public function countItems($dir)
    {
        Yii::log("Directory: {$dir}", 'info', $this->_logTag);
        if ($handle = opendir($dir)) {
            $dirs = $files = array();
            /* This is the correct way to loop over the directory. */
            $count = 0;
            while (false !== ($entry = readdir($handle))) {
                // DEBUG echo "<li>$entry ";
                if(substr($entry,0,1)=='.' and !in_array($entry,array('.','..'))) {
                    if($this->showHiddenFiles==true)
                        $count++;
                } else {
                    if(!in_array($entry,array('.','..')))
                        $count++;
                }
                // DEBUG echo $count;
            }
            closedir($handle);
            return $count;
        }
    } // }}}
    // {{{ getMediaStats
    public function getMediaStats($entryPath)
    {
        return array(
            'type'=>'directory',
            'path'=>$entryPath,
            'name'=>basename($entryPath),
            'size'=>$this->countItems($entryPath),
            'mimeType'=>'',
            'mTime'=>'',
        );
    } // }}}
    // {{{ pathToUnix
    public static function pathToUnix($dir)
    {
        return str_replace("\\", '/', $dir);
    } // }}} 
    // {{{ pathToWindows
    public static function pathToWindows($dir)
    {
        return str_replace("/", "\\", $dir);
    } // }}} 
    // {{{ rrmdir
    /**
     *  recursively remove a directory
     */
    public static function rrmdir($dir) 
    {
        if (!is_file($dir)) { 
            $objects = @scandir($dir); 
            if($objects===false)
                return false;
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                } 
            } 
            reset($objects); 
            rmdir($dir); 
        } else {
            return @unlink($dir);
        }
        return !is_dir($dir);
    } // }}} 
    // }}} End Methods
}
