<?php
/**
 * DDMediaPathSelector class file
 *
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @package DDMedia
 */

/**
 * DDMediaPathSelector class
 *
 * Displays a widget to select a path
 *
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @package DDMedia
 */
class DDMediaPathSelector extends CWidget
{
    public $cssFile;
    public $basePath;
    public $currentPath;
    public $showHiddenDirs = false;
    public $formActionId='index';
    public $pathFieldId='p';

    private $_links;

    public function init()
    {
        if($this->cssFile===null)
        {
            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'ddmediapathselector.css';
            $this->cssFile=Yii::app()->getAssetManager()->publish($file);
        }
        parent::init();
    }
    public function run()
    {
        $this->registerClientScript();
        $this->render('dDMediaPathSelector', array(
            'links'=>$this->getLinks(),
            'formActionId'=>$this->formActionId,
            'pathFieldId'=>$this->pathFieldId,
        ));
    }
    protected function registerClientScript()
    {
        // TODO: publish CSS or JavaScript file here
        $cs=Yii::app()->clientScript;
        $cs->registerCssFile($this->cssFile);
        // $cs->registerScriptFile($jsFile);
    }

    private function getLinks()
    {
        $relativePath = str_replace($this->basePath.'/','',$this->currentPath);
        if($relativePath==$this->currentPath)
            $relativePath='';
        // echo "<li>relativePath: $relativePath";
        $subDirs = explode('/',$relativePath);
        if($subDirs==array(''))
            $subDirs = array();
        // echo "<h3>subDirs</h3>";
        // var_dump($subDirs);

        // Init arrays
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
            'subDirs'=>DDMediaDirectory::getSubDirs($this->basePath, $this->showHiddenDirs)
        );
        foreach($dirsBreadcrumbs2 as $title=>$subDir) {
            $links[] = array(
                'path'=>urlencode($subDir),
                'link'=>CHtml::link($title,array('index','p'=>urlencode($subDir))),
                'subDir'=>$title,
                'subDirs'=>DDMediaDirectory::getSubDirs($this->basePath.'/'.$subDir, $this->showHiddenDirs)
            );
        }
        return $links;
    }
}
