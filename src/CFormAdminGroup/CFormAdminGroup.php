<?php
/**
* A form for editing groups as an admin.
*
*/
class CFormAdminGroup extends CForm {

  /**
   * Constructor
   */
  public function __construct($object, $group) {
    parent::__construct();
    $this->AddElement(new CFormElementText('acronym', array('readonly'=>true, 'value'=>$group['acronym'])))
         ->AddElement(new CFormElementText('name', array('value'=>$group['name'], 'required'=>true)))
         ->AddElement(new CFormElementSubmit('save', array('callback'=>array($object, 'DoGroupSave'))));
         
    $this->SetValidation('name', array('not_empty'));
  }
 
}
