<?php

class ChangePasswordForm extends CFormModel
{
  public $currentPassword;
  public $newPassword;
  public $newPassword_repeat;
  private $_user;
  
  public function rules()
  {
    return array(
      array(
        'currentPassword', 'compareCurrentPassword'
      ),
      array(
        'currentPassword, newPassword, newPassword_repeat', 'required',
        'message'=>'Introduzca su {attribute}.',
      ),
      array(
        'newPassword_repeat', 'compare',
        'compareAttribute'=>'newPassword',
        'message'=>'La contraseña nueva no coincide.',
      ),
      
    );
  }
  
  public function compareCurrentPassword($attribute,$params)
  {
    if( crypt($this->currentPassword,'salt') !== $this->_user->password )
    {
      $this->addError($attribute,'La contraseña actual es incorrecta');
    }
  }
  
  public function init()
  {
    $this->_user = User::model()->findByAttributes( array( 'username'=>Yii::app()->User->username ) );
  }
  
  public function attributeLabels()
  {
    return array(
      'currentPassword'=>'Contraseña actual',
      'newPassword'=>'Nueva contraseña',
      'newPassword_repeat'=>'Nueva contraseña (Repetir)',
    );
  }
  
  public function changePassword()
  {
    $this->_user->password = $this->newPassword;
    if( $this->_user->save() )
      return true;
    return false;
  }
}