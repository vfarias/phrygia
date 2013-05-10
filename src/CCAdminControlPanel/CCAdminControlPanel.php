<?php
/**
* Admin Control Panel to manage admin stuff.
*
* @package LydiaCore
*/
class CCAdminControlPanel extends CObject implements IController {

	public $selectedUser;
	public $selectedGroup;
  /**
  * Constructor
  */
  public function __construct() {
    parent::__construct();
  }


  /**
  * Show profile information of the user.
  */
  public function Index() {
  	  $this->views->SetTitle('ACP: Admin Control Panel');
  	  $this->views ->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'users' => $this->user->ListAllUsers(array('order-by'=>'name', 'order-order'=>'DESC')),
                  'groups' => $this->user->ListAllGroups(array('order-by'=>'name', 'order-order'=>'DESC')),
                ));
  }
  
 /**
  * View and edit user profile.
  *
   * @param $acronym string the acronym of the user.
  */
  public function EditUser($acronym){
  	  //manage users
  	  $users = $this->user->ListAllUsers();
  	  foreach($users as $val){
  	  	  if($val['acronym']==($acronym)){
  	  	  	   $this->selectedUser = $val;
  	  	  	    $this->selectedUser['groups'] = $this->db->ExecuteSelectQueryAndFetchAll(CMUser::SQL('get group memberships'), array($this->selectedUser['id']));
  	  	  }
  	  }
  	  $form = new CFormAdminProfile($this, $this->selectedUser);
  	  if($form->Check() === false) {
  	  	  $this->AddMessage('notice', 'Some fields did not validate and the form could not be processed.');
  	  	  $this->RedirectToController('edituser', $acronym);
    }
  	  $this->views->SetTitle('ACP: Admin Control Panel');
  	  $this->views ->AddInclude(__DIR__ . '/edit.tpl.php', array(
                  'user' => $this->selectedUser,
                  'profile_form'=>$form->GetHTML(),
                ));
  }
  
  /**
   * View and edit group profile.
   *
   * @param $acronym string the acronym of the group.
   */
    public function EditGroup($acronym){
  	  //manage users
  	  $groups = $this->user->ListAllGroups();
  	  foreach($groups as $val){
  	  	  if($val['acronym']==($acronym)){
  	  	  	   $this->selectedGroup = $val;
  	  	  	    $this->selectedGroup['users'] = $this->db->ExecuteSelectQueryAndFetchAll(CMUser::SQL('get group content'), array($this->selectedGroup['id']));
  	  	  }
  	  }
  	  $form = new CFormAdminGroup($this, $this->selectedGroup);
  	  $userform = new CFormAddGroupMember($this);
  	  
  	  if($userform->Check() === false || $form->Check() === false) {
  	  	  $this->AddMessage('notice', 'Some fields did not validate and the form could not be processed.');
  	  	  $this->RedirectToController('editgroup', $acronym);
    }
  	  $this->views->SetTitle('ACP: Admin Control Panel');
  	  $this->views ->AddInclude(__DIR__ . '/editgroup.tpl.php', array(
                  'group' => $this->selectedGroup,
                  'profile_form'=>$form->GetHTML(),
                  'user_form'=>$userform->GetHTML(),
                ));
  }
  
  public function CreateGroup(){
  	$form = new CFormGroupCreate($this);
    if($form->Check() === false) {
      $this->AddMessage('notice', 'You must fill in all values.');
      $this->RedirectToController('Create');
    }
    $this->views->SetTitle('Create group')
                ->AddInclude(__DIR__ . '/create.tpl.php', array('form' => $form->GetHTML()));  
  }
 
   /**
   * Save updates to profile information.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoProfileSave($form) {
    $this->selectedUser['name'] = $form['name']['value'];
    $this->selectedUser['email'] = $form['email']['value'];
    $ret = $this->Save();
    $this->AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
    $this->RedirectToController('edituser', $this->selectedUser['acronym']);
  }
  
  
  
  
   /**
   * Save updates to password.
   *
   * @param $form CForm the form that was submitted.
   */
  public function DoChangePassword($form) {
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->AddMessage('error', 'Password does not match or is empty.');
    } else {
    $ret = $this->ChangePassword($form['password']['value']);
    $this->AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
    }
    $this->RedirectToController('edituser', $this->selectedUser['acronym']);
  }
  
   /**
   * Deletes profile
   *
   * @param $acronym string the acronym of the user to delete.
   */
  public function DoDelete($acronym){
  	$this->db->ExecuteQuery('DELETE FROM User WHERE acronym=?;', array($acronym));
  	$ret = $this->db->RowCount() === 1;
  	$this->AddMessage($ret, 'User deleted.', 'Failed to delete user.');    
  	$this->RedirectToController('index');
  }
  
  /**
   * Save updates to group information.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoGroupSave($form) {
    $this->selectedGroup['name'] = $form['name']['value'];
    $ret = $this->SaveGroup();
    $this->AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
    $this->RedirectToController('editgroup', $this->selectedGroup['acronym']);
  }

    
  /**
   * Perform a creation of a group as callback on a submitted form.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoCreateGroup($form) {   
    if($this->user->CreateGroup($form['acronym']['value'], $form['name']['value'])) {
      $this->AddMessage('success', "{$form['name']['value']} have successfully been created.");
      $this->RedirectToController('editgroup', $form['acronym']['value']);
    } else {
      $this->AddMessage('notice', "Failed to create group.");
      $this->RedirectToController('create');
    }
  }
  
  /**
   * Add user to a group as callback on a submitted form.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoAddUser($form) { 
  	  $users = $this->user->ListAllUsers();
  	  foreach($users as $val){
  	  	  if($val['acronym']==$form['acronym']['value']){
  	  	  	   $user = $val['id'];
  	  	  }
  	  }
  	  $ret = $this->SaveGroupMembers($user);
  	  $this->AddMessage($ret, 'User added', "Failed to add user.");
  	  $this->RedirectToController('editgroup',$this->selectedGroup['acronym']);
  }
  
     /**
   * Deletes group
   *
   * @param $acronym string the acronym of the group to delete.
   */
  public function DoDeleteGroup($acronym){
  	$this->db->ExecuteQuery('DELETE FROM Groups WHERE acronym=?;', array($acronym));
  	$ret = $this->db->RowCount() === 1;
  	$this->AddMessage($ret, 'Group deleted.', 'Failed to delete group.');    
  	$this->RedirectToController('index');
  }
  
  
  
  
  /**
  * Save user profile to database and update user profile in session.
  *
  * @returns boolean true if success else false.
  */
  private function Save() {
    $this->db->ExecuteQuery(CMUser::SQL('update profile'), array($this->selectedUser['name'], $this->selectedUser['email'], $this->selectedUser['id']));
    return $this->db->RowCount() === 1;
  }
  
  /**
  * Save group profile to database and update group profile in session.
  *
  * @returns boolean true if success else false.
  */
  private function SaveGroup() {
    $this->db->ExecuteQuery(CMUser::SQL('update group'), array($this->selectedGroup['name'], $this->selectedGroup['id']));
    return $this->db->RowCount() === 1;
  }
  
  /**
  * Save group profile to database and update group profile in session.
  *
  * @returns boolean true if success else false.
  */
  private function SaveGroupMembers($user) {
    $this->db->ExecuteQuery(CMUser::SQL('insert into user2group'), array($user, $this->selectedGroup['id']));
    return $this->db->RowCount() === 1;
  }
  
  /**
  * Change user password.
  *
  * @param $password string the new password
  * @returns boolean true if success else false.
  */
  private function ChangePassword($password) {
    $this->db->ExecuteQuery(CMUser::SQL('update password'), array($password, $this->selectedUser['id']));
    return $this->db->RowCount() === 1;
  }
  
} 
