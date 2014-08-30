<?php
/**
 * DefaultController class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media.controllers
 */

/**
 * Controller for managing file/folder related actions.
 */
class DefaultController extends Controller
{
    // {{{ *** Members ***
    public $layout = '//layouts/column2';
    // }}} 
    // {{{ *** Methods ***
    // {{{ actionIndex
	public function actionIndex()
    {
        $msg = '';
        $mediaAction = new DDMediaAction;
        // $basePath = DDMediaDirectory::pathToUnix(realpath(Yii::app()->basePath.'/../files'));
        // Get base path from module settings
        $basePath = DDMediaDirectory::pathToUnix(realpath($this->module->baseDir));
        // DEBUG echo "<li>basePath: $basePath";
        /*
        if(!is_dir($basePath))
            throw new CHttpException(500, 'Directory '.$basePath.' is not a valid directory');
         */
        $defaultPath = '.';
        $path = isset($_GET['p']) ? urldecode($_GET['p']) : '.';
        $currentPath = DDMediaDirectory::pathToUnix(realpath($basePath.'/'.$path));
        // DEBUG echo "<li>currentPath: $currentPath";
        if($currentPath==$basePath) {
            if(isset($_GET['p']))
                Yii::app()->user->setFlash('error',"Can't change above base dir $basePath/$defaultPath");
            $path = $defaultPath;
        } else {
            $path = str_replace($basePath.'/','',$currentPath);
        }
        // DEBUG echo "<li>path: $path";
        $currentPath = DDMediaDirectory::pathToUnix(realpath($basePath.'/'.$path.'/'));

        if(!isset($_POST['DDMediaAction'])) {
            $mediaAction->selectedItems =' ';
            $mediaAction->mediaType     = 'file';
            $mediaAction->path          = $currentPath;
        } else {
            $mediaAction->attributes    = $_POST['DDMediaAction'];
            $mediaAction->scenario      = $mediaAction->action;
            $mediaAction->path          = $basePath.'/'.$mediaAction->path;
            // DEBUG var_dump($mediaAction->attributes);
            if($mediaAction->validate()) {
                $result = $mediaAction->doAction();
                if($result==true) {
                    $mediaAction->mediaType = $mediaAction->mediaType=='directory' ? Yii::t('MediaModule.main', 'directory') : Yii::t('MediaModule.main', 'file');
                    switch($mediaAction->action)
                    {
                        case 'rename':
                            Yii::app()->user->setFlash('success',Yii::t('MediaModule.main','The {mediaType} <em>{name}</em> has been renamed to <em>{p1}</em>.',array('{mediaType}'=>$mediaAction->mediaType,'{name}'=>$mediaAction->selectedItemsOld,'{p1}'=>$mediaAction->p1)));
                            break;
                        case 'copy':
                            Yii::app()->user->setFlash('success',Yii::t('MediaModule.main','The {mediaType} <em>{name}</em> has been copied to <em>{p1}</em>.',array('{mediaType}'=>$mediaAction->mediaType,'{name}'=>$mediaAction->selectedItemsOld,'{p1}'=>$mediaAction->p1)));
                            break;
                        case 'delete':
                            Yii::app()->user->setFlash('success',Yii::t('MediaModule.main','The {mediaType} <em>{name}</em> has been deleted.',array('{mediaType}'=>$mediaAction->mediaType,'{name}'=>$mediaAction->selectedItemsOld)));
                            break;
                        case 'move':
                            Yii::app()->user->setFlash('success',Yii::t('MediaModule.main','The {mediaType} <em>{name}</em> has been moved to <em>{path}/{p1}</em>.',array(
                                '{mediaType}'=>$mediaAction->mediaType,
                                '{name}'=>$mediaAction->selectedItemsOld,
                                '{path}'=>$mediaAction->path,
                                '{p1}'=>$mediaAction->p1)));
                            break;
                        case 'upload':
                            Yii::app()->user->setFlash('success',Yii::t('MediaModule.main','The file <em>{originalName}</em> has been uploaded as <em>{newName}</em>.',array('{originalName}'=>$mediaAction->selectedItemsOld, '{newName}'=>basename($mediaAction->selectedItems))));
                            break;
                        case 'newdir':
                            Yii::app()->user->setFlash('success',Yii::t('MediaModule.main','The directory <em>{p1}</em> has been created.',array('{p1}'=>$mediaAction->p1)));
                            break;
                    }
                } else {
                    Yii::app()->user->setFlash('error',sprintf("<b>Error!</b><br />Couldn't do action <em>%s</em> on item <em>%s</em>",$mediaAction->action, $mediaAction->path));
                }

            }
        }

        // DEBUG var_dump(array('basePath'=>$basePath, 'defaultPath'=>$defaultPath, 'GET[path]'=>urldecode($_GET['p']), 'path'=>$path, 'currentPath'=>$currentPath));
        try {
            $dir = new DDMediaDirectory($basePath.'/'.$path);
            $files = $dir->listContent();
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
            $dir = new DDMediaDirectory($basePath.'/'.$defaultPath);
            $files = $dir->listContent();
        }
        $this->render('index', array(
            'mediaAction'=>$mediaAction, 
            'basePath'=>$basePath, 
            'path'=>$path, 
            'currentPath'=>$currentPath, 
            'files'=>$files, 
            'msg'=>$msg
        ));
    } // }}}
    // {{{ actionThumbnail
    /**
     * Returns a preview icon for a file or folder
     *
     * @param string $_GET['path'] Path to file/folder
     */
    public function actionThumbnail()
    {
        $file = urldecode($_GET['path']);
        /*
        $mimeType = mime_content_type($file);
        if(preg_match("/image\/(.*)/",$mimeType,$matches)) {
            $this->imagePreview($file, isset($_GET['x']) ? (int)$_GET['x'] : 100);
        } else {
            $this->imagePreview($file, 100);
        }
         */
        $this->imagePreview($file, isset($_GET['x']) ? (int)$_GET['x'] : 100);
    } // }}} 
    // {{{ actionPreview
    public function actionPreview()
    {
        $file = urldecode($_GET['path']);
        $mimeType = mime_content_type($file);
        if(preg_match("/image\/(.*)/",$mimeType,$matches)) {
            $this->imagePreview($file, isset($_GET['x']) ? (int)$_GET['x'] : 100);
        } elseif(preg_match("/text\/plain/",$mimeType,$matches)) {
            ob_end_clean();
            echo $this->renderPartial('textPreview',array('path'=>$file));
            die;
            Yii::app()->end();
        } else {
            $this->imagePreview($file, 0);
        }

    } // }}}
    // {{{ actionDownload
    public function actionDownload()
    {
        while(@ob_end_clean()){};
        $filePath = urldecode($_GET['path']);
        $fp = fopen($filePath, 'rb');
        // send the right headers
        header("Cache-Control: ");
        header("Pragma: "); 
        header("Content-Type: application/octet-stream"); //mime_content_type($filePath));
        header("Content-Length: " . filesize($filePath));
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header("Content-Transfer-Encoding: binary\n");
        // dump the picture and stop the script
        fpassthru($fp);
        fclose($fp);
        Yii::app()->end();
        die;
    } // }}}
    // {{{ imagePreview
    public function imagePreview($image=null, $x=0, $y=0, $src_x=0, $src_y=0, $src_w=0, $src_h=0, $resize=0, $aspectratio=1)
    {
        $argKeys = array('image', 'x', 'y', 'src_x', 'src_y', 'src_w', 'src_h', 'resize', 'aspectratio');
        error_reporting(E_ALL ^ E_NOTICE);
        $types = array (1 => "gif", "jpeg", "png", "swf", "psd", "wbmp");

        // Set file name
        if(!isset($image)) {
            die('Es wurde kein Bild angegeben!');
        } else {
             if(!file_exists($image))
                 die('Die angegebene Datei konnte nicht auf dem Server gefunden werden!');
        }

        // Do we have a folder?
        if(is_dir($image)) {
            header('Content-Type: image/png');
            readfile('images/filetypeicons/folder.png');
            die;
        }

        // Do we have a non-image file?
        $mimeType = mime_content_type($image);
        if(strpos($mimeType,'image/')===false) {
            // No image
            if(preg_match("/\.([^\.]+)$/",$image,$matches)){
                $extension = $matches[1];
                $iconPath = dirname(__FILE__).'/../../../../'.str_replace(Yii::app()->baseUrl.'/', '',$this->module->assetsUrl).'/filetypeicons';
                $extensionIcon = $iconPath.'/'.$this->getFileIconByExtension($extension);
                if(!file_exists($extensionIcon))
                    $extensionIcon=$iconPath.'/fileicon_bg.png';
                header('Content-Type: image/png');
                readfile($extensionIcon);
                die;
            }
        }

        if(
        (is_null($x) && is_null($y))  
        ) {
           die('Fehlende(r) oder ungültige(r) Größenparameter!');
        }

        $cacheSubDir = '.thumbs';
        $fileDir = dirname($image);
        $cacheDir = $fileDir.'/'.$cacheSubDir;
        // Create thumbs dir?
        if(!is_dir ($cacheDir))
            @mkdir($cacheDir, 0777);

        $imagedata = getimagesize($image);

        if(!isset($imagedata[2]) || $imagedata[2] == 4 || $imagedata[2] == 5)
            die('Bei der angegebenen Datei handelt es sich nicht um ein Bild!');

        if($x==0)
            $x = floor ($y * $imagedata[0] / $imagedata[1]);

        if($y==0)
            $y = floor ($x * $imagedata[1] / $imagedata[0]);

        if ($aspectratio) {
             if ($imagedata[0] > $imagedata[1]) { // Breite > Höhe
                  $y = floor ($x * $imagedata[1] / $imagedata[0]); // Neue Breite * Verh. H/B
             } else if ($imagedata[1] > $imagedata[0]) {
                  $x = floor ($y * $imagedata[0] / $imagedata[1]); // Neue Höhe * Verh. B/H
             }
        }
        // src_w
        if($src_w==0)
            $src_w = $imagedata[0];
        // src_h
        if($src_h==0)
            $src_h = $imagedata[1];

        $dst_x = 0;
        $dst_y = 0;

        $myArgs = func_get_args();
        $tmp = array();
        for($i=1; $i<count($myArgs); $i++) {
            $tmp[] = $argKeys[$i].'='.$myArgs[$i];
        }
        $thumbfile = md5(join('&',$tmp)).'_'.basename($image);

        if (file_exists ($cacheDir.'/'.$thumbfile)) {
             $thumbdata = getimagesize ($cacheDir.'/'.$thumbfile);
             $thumbdata[0] == $x && $thumbdata[1] == $y
                  ? $iscached = true
                  : $iscached = false;
        } else {
             $iscached = false;
        }

        if (!$iscached) {
             ($imagedata[0] > $x || $imagedata[1] > $y) ||
             (($imagedata[0] < $x || $imagedata[1] < $y) && $resize)
                  ? $makethumb = true
                  : $makethumb = false;
        } else {
             $makethumb = false;
        }

        Header( "Content-Type: image/".$types[$imagedata[2]] );

        if ($makethumb) {
             $image = call_user_func("imagecreatefrom".$types[$imagedata[2]], $image);
             $thumb = imagecreatetruecolor ($x, $y);
             // imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h ) 
             imagecopyresized (
                 $thumb,    // destination image
                 $image,    // source image 
                 $dst_x,    // dest. x
                 $dst_y,    // dest. y
                 $src_x,    // source x
                 $src_y,    // source y
                 $x,        // dest. width
                 $y,        // dest. height
                 $src_w, 
                 $src_h
             );
             call_user_func("image".$types[$imagedata[2]], $thumb, $cacheDir.'/'.$thumbfile);
             imagedestroy ($image);
             imagedestroy ($thumb);
             $image = $cacheDir.'/'.$thumbfile;
        } else {
             $iscached
                  ? $image = $cacheDir.'/'.$thumbfile
                  : $image = $image;
        }
        Header( "Content-Length: ".filesize($image) );
        $image = fopen ($image, "rb");
        fpassthru ($image);
        fclose ($image);
        die;
    } // }}}
    // {{{ getFileIconByExtension
    /**
     * Returns an icon filename by file extension
     *
     * @param string $extension Extension (e.g. 'xls', 'css', 'txt' ...)
     * @return string Filetype icon name (e.g. 'excel.png')
     */
    private function getFileIconByExtension($extension)
    {
        $icons = array(
            'zip'=>'compressed',
            'css'=>'css',
            'ini'=>'developer',
            'php'=>'developer',
            'vb'=>'developer',
            'bash'=>'developer',
            'sh'=>'developer',
            'xlsb'=>'excel',
            'xlsx'=>'excel',
            'xls'=>'excel',
            //'fileicon_bg',
            //'fireworks',
            'flv'=>'flash',
            'swf'=>'flash',
            //'folder',
            'htm'=>'html',
            'html'=>'html',
            //'illustrator',
            'jpg'=>'image',
            'png'=>'image',
            'keynote',
            'avi'=>'movie',
            'mp4'=>'movie',
            'avi'=>'movie',
            'divx'=>'movie',
            'mpg'=>'movie',
            'mpeg'=>'movie',
            'mp3'=>'music',
            'wav'=>'music',
            'csv'=>'numbers',
            // 'pages',
            'pdf'=>'pdf',
            'psd'=>'photoshop',
            'pptx'=>'powerpoint',
            'ppt'=>'powerpoint',
            'txt'=>'text',
            'md'=>'text',
            'mkd'=>'text',
            'markdown'=>'text',
            //'unknown',
            'doc'=>'word',
            'docx'=>'word',
        );
        if(array_key_exists($extension, $icons))
            return $icons[$extension].'.png';
        else
            return 'unknown.png';
    } // }}} 
    // }}} End Methods
}
// {{{ myPar
function myPar($array)
{
    if(!DEBUG) return;
    if(!is_array($array)) {
        echo "$array<br/>";
    } else {
        var_dump($array);
    }
} // }}} 
