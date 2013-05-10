<?php
/**
* Holding a instance of CPhrygia to enable use of $this in subclasses.
*
* @package PhrygiaCore
*/
class CObject {

	/**
	* Members
	*/
	protected $phr;
	protected $config;
	protected $request;
	protected $data;
	protected $db;
	protected $views;
	protected $session;
	protected $user;
	
   /**
    * Constructor
    */
    protected function __construct($phr=null) {
   	if(!$phr){
    $phr = CPhrygia::Instance();
    }
    $this->phr 		= &$phr;
    $this->config   = &$phr->config;
    $this->request  = &$phr->request;
    $this->data     = &$phr->data;
    $this->db 	    = &$phr->db;
    $this->views 	= &$phr->views;
    $this->session	= &$phr->session;
    $this->user		= &$phr->user;
  }
  
  	protected function RedirectTo($urlOrController=null, $method=null, $arguments=null) {
    $this->phr->RedirectTo($urlOrController, $method, $arguments);
  }
  

	/**
	* Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
	*
	* @param string method name the method, default is index method.
	*/
	protected function RedirectToController($method=null, $arguments=null) {
    $this->phr->RedirectToController($method, $arguments);
  }
  
  	/**
  	* Redirect to a controller and method. Uses RedirectTo().
  	*
  	* @param string controller name the controller or null for current controller.
  	* @param string method name the method, default is current method.
  	*/
  	protected function RedirectToControllerMethod($controller=null, $method=null, $arguments=null) {
  		$this->phr->RedirectToControllerMethod($controller, $method, $arguments);
  }
  
	/**
	* Save a message in the session. Uses $this->session->AddMessage()
	*
	* @param $type string the type of message, for example: notice, info, success, warning, error.
	* @param $message string the message.
	* @param $alternative string the message if the $type is set to false, defaults to null.
	*/
	protected function AddMessage($type, $message, $alternative=null) {
		return $this->phr->AddMessage($type, $message, $alternative);
  }
  	/**
  	* Create an url. Uses $this->request->CreateUrl()
  	*
  	* @param $urlOrController string the relative url or the controller
  	* @param $method string the method to use, $url is then the controller or empty for current
  	* @param $arguments string the extra arguments to send to the method
  	*/
  	protected function CreateUrl($urlOrController=null, $method=null, $arguments=null) {
  		return $this->phr->CreateUrl($urlOrController, $method, $arguments);
  }	

}
