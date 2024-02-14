<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */

  class Install_actions extends Base_model
  {
      function is_installed()
      {
          return ((defined('INSTALLED')) AND (INSTALLED===TRUE));
      }
      
      private function check_database()
      {
          @mysql_connect($this->input->post('database_host'),$this->input->post('database_user'),$this->input->post('database_password'));
          
          if (mysql_errno()!=0)
          {
              $this->set_error(mysql_error());
              return FALSE;
          }
          
          @mysql_select_db($this->input->post('database_name'));
          
          if (mysql_errno()!=0)
          {
              $this->set_error(mysql_error());
              return FALSE;
          }
          
          return TRUE;
      }
      
      function install()
      {
          if (!$this->check_database())
          {
              return FALSE;
          }
          
          $sql=file_get_contents(BASEPATH.'../database.sql');
          $sql=explode(';',$sql);
          foreach($sql as $query)
          {
              if ($query=='')
              {
                  continue;
              }
              @mysql_query($query);
              if (mysql_errno()!=0)
              {
                  $this->set_error(mysql_error());
                  return FALSE;
              }
          }
          
          $this->load->helper('key_generator_helper');
          $salt=generate_key();
          
          mysql_query('INSERT INTO employees (employee_id,email) VALUES(null,"'.$this->input->post('username').'")');
          mysql_query('INSERT INTO users(user_id,user_name,user_password,password_salt,permissions,is_active,employee_id) VALUES(null,"'.$this->input->post('username').'","'.hash('sha512',$salt.$this->input->post('admin_password')).'","'.$salt.'","a:1:{s:12:\"global_admin\";b:1;}",1,1)');
          
          $config_folder=APPPATH.'config/';
          
          $config_file=file_get_contents($config_folder.'constants.php')."\r\ndefine('INSTALLED',TRUE);";
          
          file_put_contents($config_folder.'constants.php',$config_file);
          
          $base_url=$_SERVER['HTTP_ORIGIN'].str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
          
          $config_file=preg_replace(
                       array(
                            "/config\['base_url'\].*?';/si",
                            "/config\['encryption_key'\].*?';/si"
                       ),
                       array(
                           'config[\'base_url\']    = \''.$base_url.'\';',
                           'config[\'encryption_key\']    = \''.generate_key(40).'\';' 
                       ),
                       file_get_contents($config_folder.'config.php')
          );
          
          file_put_contents($config_folder.'config.php',$config_file);
          
          $autoload['model'] = array('');
          
          $config_file=preg_replace(
                       array(
                            "/autoload\['libraries'\] = array\(\);/si"
                       ),
                       array(
                            'autoload[\'libraries\'] = array(\'database\',\'driver\',\'session\');'
                       ),
                       file_get_contents($config_folder.'autoload.php')
          );
          
          file_put_contents($config_folder.'autoload.php',$config_file);
          
          
          $config_file=preg_replace(
                       array(
                            "/'hostname' => '',/si",
                            "/'username' => '',/si",
                            "/'password' => '',/si",
                            "/'database' => '',/si"
                       ),
                       array(
                            '\'hostname\' => \''.$this->input->post('database_host').'\',',
                            '\'username\' => \''.$this->input->post('database_user').'\',',
                            '\'password\' => \''.$this->input->post('database_password').'\',',
                            '\'database\' => \''.$this->input->post('database_name').'\','
                       ),
                       file_get_contents($config_folder.'database.php')
          );
          
          file_put_contents($config_folder.'database.php',$config_file);
          
          return TRUE;
      }
      
      function check_compability()
      {
          $errors=array();
          if (!file_exists(BASEPATH.'../.htaccess'))
          {
              $errors[]=$this->lang->line('.htaccess file is missing in root folder');
          }
          
          foreach(array('config.php','database.php','constants.php','autoload.php','routes.php') as $file)
          {
            if (!is_writable(BASEPATH.'../application/config/'.$file))
            {
                $errors[]=sprintf($this->lang->line($this->lang->line('File "%s" is not writeable')),'application/config/'.$file);
            }
          }
          
          if (!extension_loaded('mcrypt'))
          {
              $errors[]=$this->lang->line('Please make sure mcrypt and openssl libraries are loaded and enabled');
          }
          
          $this->set_error($errors);
          
          return (count($errors)>0)?FALSE:TRUE;
      }
  }
?>