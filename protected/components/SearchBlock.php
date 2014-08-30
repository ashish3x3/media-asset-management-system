<?php
 
Yii::import('zii.widgets.CPortlet');
 
class SearchBlock extends CPortlet
{
    public $title='Search';
 
    protected function renderContent()
    {
           echo CHtml::beginForm(array('search/search'), 'get', array('style'=> 'inline')) .
        CHtml::textField('q', '', array('placeholder'=> 'search...','style'=>'width:540px;')) .
        CHtml::submitButton('Go!',array('style'=>'width:30px;')).
        
         CHtml::endForm('') ; 
    }
}