<?php
/**
 * MediaModule class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media
 */

/**
 * Web module for managing media (files and folders).
 */
class MediaModule extends CWebModule
{
    // {{{ *** Members ***
    public $logTag = 'application.modules.media';

    public $baseDir;

    public $tableCssClass;
    
    // getAssetsUrl()
    //    return the URL for this module's assets, performing the publish operation
    //    the first time, and caching the result for subsequent use.
    private $_assetsUrl;
 
    // }}} 
    // {{{ *** Methods ***
    // {{{ init
	public function init()
    {
        Yii::log("Media Module init", 'info',$this->logTag);
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'media.models.*',
			'media.components.*',
        ));
        //register translation messages from module dbadmin
        //so no need do add to config/main.php
        Yii::app()->setComponents(
            array('messages' => array(
                    'class'=>'CPhpMessageSource',
                    'basePath'=>'protected/modules/media/messages',
        )));
        
	} // }}} 
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('media.assets') );
        return $this->_assetsUrl;
    }
    // {{{ beforeControllerAction
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
    } // }}} 
    // }}} End Methods
}
