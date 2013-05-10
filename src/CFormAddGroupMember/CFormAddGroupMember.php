<?php
/**
* A form for adding users to a group.
*
* @package PhrygiaCore
*/
class CFormAddGroupMember extends CForm {

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->AddElement(new CFormElementText('acronym', array('required'=>true)))
         ->AddElement(new CFormElementSubmit('create', array('callback'=>array($object, 'DoAddUser'))));
         
    $this->SetValidation('acronym', array('not_empty'));
  }
 
}
