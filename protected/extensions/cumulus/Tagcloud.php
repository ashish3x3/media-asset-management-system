<?php
/**
 * Tagcloud component.
 * This implements the tag cloud cumulus for yii 
 * ported from wp-cumulus
 * 2010 Jason Clark
 *
 */



class Tagcloud extends CWidget
{
	public $height=600;
	public $width=400;
        public $transparency=false;
        public $color='#ffffff';
        public $mode= 'tags';
        public $tcolor="0x333333";
	public $bgcolor='#ffffff';
        public $distr="true";
        public $tspeed=100;
        public $style=22;
        public $hicolor='0x00cc00';
	public $namefield='name';
	public $urlfield='url';
	public $tags;
        protected $tagcloud;
	protected $assets;
        
       
    function init()
     {
	 if($this->assets===null)
        {
            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
            $this->assets=Yii::app()->getAssetManager()->publish($file);
            $this->registerClientScript();
        }
    }
	
    public function run()
    {
	echo '<div id="flashcontent">This will be shown to users with no Flash or Javascript.</div>
';
	echo $this->getJs($this->tags);
    }
	
     public function getJs($tags)
	{
	 $this->tagcloud='<tags>';
	 $namefield=$this->namefield;
	 $urlfield=$this->urlfield;
		    foreach($tags as $tag)
			{
			if(isset($tag->$urlfield))
			{
			$this->tagcloud .='<a href=\''. $tag->$urlfield .'\'';
			}else{
			    $this->tagcloud .='<a href=\''. '' .'\'';
			}
			
			$this->tagcloud .=' style=\''. $this->style .'\' ';
			$this->tagcloud .=' color=\''. $this->color .'\'';
			$this->tagcloud .=' hicolor=\''. $this->hicolor .'\'';
			if(isset($tag->$namefield))
			{
			$this->tagcloud .='>'.$tag->$namefield;
			}else{
			  $this->tagcloud .='>'.$tag;  
			}
			$this->tagcloud .=' </a>';
			}
	$this->tagcloud .='</tags>';
		
        $js='<script type="text/javascript">'."\n";
	$js .= 'var so = new SWFObject("'.$this->assets.'/tagcloud.swf", "tagcloud", "'. $this->height .'", "'.$this->width .'", "7", "#FFFFFF");'."\n";
	
        if(isset($this->trasparency))
        {
		$js .=' so.addParam("wmode", "transparent");'."\n";
        }
		$js .= 'so.addVariable("tcolor","'.$this->tcolor.'");
		    so.addVariable("mode", "'.$this->mode.'");
		    so.addVariable("distr", "'.$this->distr.'");
		    so.addVariable("tspeed", "'.$this->tspeed.'");
		    so.addVariable("tagcloud","'.$this->tagcloud.'");
		    so.write("flashcontent");'."\n";
		$js .='</script>';
	return $js;
    }  
    
    
    protected function registerClientScript()
    {
        $cs=Yii::app()->clientScript;
	$cs->registerScriptFile($this->assets.'/swfobject.js');
    }
}
