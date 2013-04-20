<?php
/**
* Holding a instance of CPhrygia to enable use of $this in subclasses.
*
* @package PhrygiaCore
*/
class CObject {

   public $config;
   public $request;
   public $data;
   public $db;

   /**
    * Constructor
    */
   protected function __construct() {
    $phr = CPhrygia::Instance();
    $this->config   = &$phr->config;
    $this->request  = &$phr->request;
    $this->data     = &$phr->data;
    $this->db 	    = &$phr->db;
    $this->views 	= &$phr->views;
    $this->session	= &$phr->session;
  }
  
  	protected function RedirectTo($url) {
    $phr = CPhrygia::Instance();
    if(isset($phr->config['debug']['db-num-queries']) && $phr->config['debug']['db-num-queries'] && isset($phr->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }
    if(isset($phr->config['debug']['db-queries']) && $phr->config['debug']['db-queries'] && isset($phr->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }
    if(isset($phr->config['debug']['timer']) && $phr->config['debug']['timer']) {
$this->session->SetFlash('timer', $phr->timer);
    }
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($url));
  }
  

	/**
	* Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
	*
	* @param string method name the method, default is index method.
	*/
	protected function RedirectToController($method=null) {
    $this->RedirectTo($this->request->controller, $method);
  }

}
