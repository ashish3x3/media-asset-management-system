<?php
/**
 * DDMediaFile class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media.models
 */

/**
 * Model for managing files.
 */
class DDMediaFile
{
    // {{{ *** Members ***
    public $filePath;
    // }}} 
    // {{{ *** Methods ***
    // {{{ __construct
    public function __construct($filePath)
    {
        if(!is_file($filePath))
            throw new CHttpException(500, "$filePath is not a valid file path");
        $this->filePath = $filePath;
    } // }}} 
    // {{{ getFileMTime
    public function getFileMTime($filePath=null) 
    { 
        if($filePath==null) {
            if(is_null($this->filePath))
                throw new CHttpException(500, "filePath not set");
            else
                $filePath = $this->filePath;
        }
        $time = filemtime($filePath); 

        $isDST = (date('I', $time) == 1); 
        $systemDST = (date('I') == 1); 

        $adjustment = 0; 

        if($isDST == false && $systemDST == true) 
            $adjustment = 3600; 
        
        else if($isDST == true && $systemDST == false) 
            $adjustment = -3600; 

        else 
            $adjustment = 0; 

        return ($time + $adjustment); 
    } // }}} 
    // {{{ getMediaStats
    public function getMediaStats()
    {
        $size = filesize($this->filePath);
        return array(
            'type'=>'file',
            'path'=>$this->filePath,
            'name'=>basename($this->filePath),
            'size'=>$size,
            'sizeFormatted'=>$this->getSizeFormatted($size),
            'mimeType'=>mime_content_type($this->filePath),
            'mTime'=>$this->getFileMTime($this->filePath),
        );
    } // }}} 
    // {{{ getSizeFormatted
    public function getSizeFormatted($a_bytes)
    {
         if ($a_bytes < 1024) {
             return $a_bytes .' B';
         } elseif ($a_bytes < 1048576) {
             return round($a_bytes / 1024, 2) .' KiB';
         } elseif ($a_bytes < 1073741824) {
             return round($a_bytes / 1048576, 2) . ' MiB';
         } elseif ($a_bytes < 1099511627776) {
             return round($a_bytes / 1073741824, 2) . ' GiB';
         } elseif ($a_bytes < 1125899906842624) {
             return round($a_bytes / 1099511627776, 2) .' TiB';
         } elseif ($a_bytes < 1152921504606846976) {
             return round($a_bytes / 1125899906842624, 2) .' PiB';
         } elseif ($a_bytes < 1180591620717411303424) {
             return round($a_bytes / 1152921504606846976, 2) .' EiB';
         } elseif ($a_bytes < 1208925819614629174706176) {
             return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
         } else {
             return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
         }
    } // }}} 
    // }}} End Methods
}
if(!function_exists('mime_content_type')) {
    function mime_content_type($filename)
    {
        if(!is_file($filename))
            return false;
        $finfo = new finfo(FILEINFO_MIME);
        $mime_type = $finfo->file($finfo, $filename);
        finfo_close($finfo);
		//$finfo = new finfo(FILEINFO_MIME);
		//$mime_type = finfo_file($finfo, $filename);
		//finfo_close($finfo); 
        return $mime_type;
    }
}
