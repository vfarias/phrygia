<?php
/**
* Standard controller layout.
*
* @package PhrygiaCore
*/
class CCIndex implements IController {

   /**
    * Implementing interface IController. All controllers must have an index action.
    */
   public function Index() {   
      global $phr;
      $phr->data['title'] = "The Index Controller";
   }

}

