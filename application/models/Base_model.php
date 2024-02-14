<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */
  class Base_model extends CI_Model
  {
      private $error;
      
      protected function set_error($error)
      {
          $this->error=$error;
      }
      
      function get_error()
      {
          return $this->error;
      }
  }
?>