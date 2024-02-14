<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Attachments_actions extends Base_model
  {
      function get_attachments($object,$type)
      {
		 // echo $type;
          return $this->db
                      ->select('*')
                      ->where(array('type'=>$type,'object'=>$object))
                      ->get('attachments')
                      ->result_array();
      }
      
      private function save_attachment($type,$object)
      {
          $this->db->insert('attachments',array(
                    'object'=>$object,
                    'type'=>$type,
                    'mime'=>$this->upload->file_type,
                    'extenstion'=>str_replace('.','',$this->upload->file_ext),
                    'file'=>$this->upload->orig_name,
                    'location'=>$this->upload->file_name,
                    'uploaded'=>date('Y-m-d H:i:s')                    
          ));
          
          return $this->db->insert_id();
      }
	  private function update_attachment($type,$object,$attachment_id)
      {
         
		  $data =array('object'=>$object,
                    'type'=>$type,
                    'mime'=>$this->upload->file_type,
                    'extenstion'=>str_replace('.','',$this->upload->file_ext),
                    'file'=>$this->upload->orig_name,
                    'location'=>$this->upload->file_name,
                    'uploaded'=>date('Y-m-d H:i:s') );
		   $suss=  $this->db->update('attachments', $data, array('attachment_id' => $attachment_id));
          
          return true;
      }
	  
	   private function save_attachment2($type,$object)
      {
          $this->db->insert('attachments',array(
                    'object'=>$object,
                    'type'=>$type,
                    'mime'=>$this->upload->file_type,
                    'extenstion'=>str_replace('.','',$this->upload->file_ext),
                    'file'=>$this->upload->orig_name,
                    'location'=>$this->upload->file_name,
                    'uploaded'=>date('Y-m-d H:i:s')                    
          ));
          
          return $this->db->insert_id();
      }
      
	function upload_attachments3($type,$object,$mnthdate,$foldername)
		{
		
		
			$files=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files;
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments/'.$foldername,
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
		   $new_name = $_FILES['new_attachments']['name'];
		  $config['file_name'] = $new_name;
		 
		 $gname = $_POST['form_id'];
 
$q= $this->db
                      ->select('*')
                      ->where('form_id',$gname)
                      ->get('bir_forms')
                      ->result_array();
    $pd = $q[0]['form_name'];
  
		 // $ree=$config['file_name'];
			foreach($new_name as $index=>$name){
				
				$ds=date("Y-m-d");
				$ff= explode('.',$name);
				$extt= end($ff);
				
				 $fname= $mnthdate.'_'.$pd .'_From_'.$name;
				$_FILES['new_attachment']=array(
					'name'=>$fname,
					'type'=>$_FILES['new_attachments']['type'][$index],
					'tmp_name'=>$_FILES['new_attachments']['tmp_name'][$index],
					'error'=>$_FILES['new_attachments']['error'][$index],
					'size'=>$_FILES['new_attachments']['size'][$index]
				);
             
				if (!$this->upload->do_upload('new_attachment'))
				{
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files;
	}	  	 
	
	
	function upload_attachments_not_bir($type,$object)
		{
		
			$files=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files;
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments',
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
		   $new_name = $_FILES['new_attachments']['name'];
		  $config['file_name'] = $new_name;
		 
		 $gname = $_POST['form_id'];
 
$q= $this->db
                      ->select('*')
                      ->where('form_id',$gname)
                      ->get('bir_forms')
                      ->result_array();
    $pd = $q[0]['form_name'];
  
		 // $ree=$config['file_name'];
			foreach($new_name as $index=>$name){
				
				$ds=date("Y-m-d");
				$ff= explode('.',$name);
				$extt= end($ff);
				
				 $fname= 'F__'. $ds .'.'.$extt;
				$_FILES['new_attachment']=array(
					'name'=>$fname,
					'type'=>$_FILES['new_attachments']['type'][$index],
					'tmp_name'=>$_FILES['new_attachments']['tmp_name'][$index],
					'error'=>$_FILES['new_attachments']['error'][$index],
					'size'=>$_FILES['new_attachments']['size'][$index]
				);
             
				if (!$this->upload->do_upload('new_attachment'))
				{
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files;
	}
	
	/***************************New file upload code******************************/
	
	
	function upload_attachments_not_birg($type,$object)
		{
			// echo '<pre>';
		// print_r($_FILES);
		// echo '</pre>';
		// echo '<pre>';
		// print_r($this->config->item('attachment_files'));
		// echo '</pre>';
	// echo 	$this->config->item('max_file_size');
		// die("dfd");
				$files=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files;
			
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments',
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
			foreach($_FILES['new_attachments']['name'] as $index=>$name)
			{
				$_FILES['new_attachment']=array(
					'name'=>$name,
					'type'=>$_FILES['new_attachments']['type'][$index],
					'tmp_name'=>$_FILES['new_attachments']['tmp_name'][$index],
					'error'=>$_FILES['new_attachments']['error'][$index],
					'size'=>$_FILES['new_attachments']['size'][$index]
				);
             
				if (!$this->upload->do_upload('new_attachment'))
				{
					// echo "<pre>";
					// print_R($this->upload);
					// echo "dfsr";
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
            // echo $this->upload->file_ext;
				$files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files;
	}
	
	
	/***************************New file upload code******************************/
	
	
	function upload_attachments4($type,$object,$mnthdate,$foldername)
		{
		// echo'<pre>';
		// print_r($type);
		// print_r($object);
		// echo'</pre>';
		// die('rhtrhrt');
			$files2=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files2;
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments'.$foldername,
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
		  $new_names = $_FILES['new_attachments2']['name'];
		  $config['file_name'] = $new_names;
		 
		 $gname = $_POST['form_id'];
 
$qg= $this->db
                      ->select('*')
                      ->where('form_id',$gname)
                      ->get('bir_forms')
                      ->result_array();
    $pdss = $qg[0]['form_name'];
	
			foreach( $new_names as $index2=>$name)
			{
				
				$dss=date("Y-m-d");
				$ffp= explode('.',$name);
				$extt= end($ffp);
				
				 //$pname= 'P_'. $pdss .'_'. $dss .'.'.$extt;
				 $pname= $mnthdate.'_'.$pdss .'_Payment_'.$name;
				$_FILES['new_attachment2']=array(
					'name'=>$pname,
					'type'=>$_FILES['new_attachments2']['type'][$index2],
					'tmp_name'=>$_FILES['new_attachments2']['tmp_name'][$index2],
					'error'=>$_FILES['new_attachments2']['error'][$index2],
					'size'=>$_FILES['new_attachments2']['size'][$index2]
				);
             
				if (!$this->upload->do_upload('new_attachment2'))
				{
					$files2['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files2['files']['success'][]=array('id'=>$this->save_attachment2($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files2;
	}
	
	function upload_attachments($type,$object,$empname,$foldername)
		{
		
		// echo "<pre>";
		// print_r($_FILES);
		// echo $empname;
		// echo $type;
		// echo $object;
		// echo $foldername;
		// echo $foldername;
		// die("here");
		// die("swdfaqwe");
		if($foldername =='EmployeeContract')
			{
			//	$flname=  $ename.'- contract-'.date('Ymd');
				$uploadpathn = BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='201File')
			{
			//	$filename ='201-'.$empname.'-'.$name,
				$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='ProductImages')
			{
			//	$filename ='201-'.$empname.'-'.$name,
				$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}elseif($foldername=='Leaveform')
			{
			//	$filename ='201-'.$empname.'-'.$name,
				$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			else
			{
				//$flname =$name;
				$uploadpathn= BASEPATH.'../files/attachments/';
			}
// echo $uploadpathn;
// die("sdf");
			$files=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files;
			}

          
			$this->load->library('upload',array(
				'upload_path'=>$uploadpathn,
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
			
         // echo "<pre>";
		 // print_r($_FILES);
		 // die("here");
			foreach($_FILES['new_attachments']['name'] as $index=>$name)
			{
				if($foldername =='EmployeeContract')
			{
				$flname=  $empname.'-contract-'.date('Ymd').'-'.$name;
				//$uploadpathn = BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='201File')
			{
				$flname ='201-'.$empname.'-'.$name;
				//$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='Leaveform')
			{
				$flname =$empname.'-'.date('Ymd').'-'.$name;
				//$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			else
			{
				$flname =$name;
				//$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
				
				$_FILES['new_attachment']=array(
					'name'=>$flname,
					'type'=>$_FILES['new_attachments']['type'][$index],
					'tmp_name'=>$_FILES['new_attachments']['tmp_name'][$index],
					'error'=>$_FILES['new_attachments']['error'][$index],
					'size'=>$_FILES['new_attachments']['size'][$index]
				);
             
				if (!$this->upload->do_upload('new_attachment'))
				{
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files;
	}
	function upload_product_attachments($type,$object,$empname,$foldername,$at_id)
		{
		
		// echo "<pre>";
		// print_r($_FILES);
		// echo $empname;
		// echo $type;
		// echo $object;
		// echo $foldername;
		// echo $foldername;
		// die("here");
		// die("swdfaqwe");
		if($foldername =='EmployeeContract')
			{
			//	$flname=  $ename.'- contract-'.date('Ymd');
				$uploadpathn = BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='201File')
			{
			//	$filename ='201-'.$empname.'-'.$name,
				$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='ProductImages')
			{
			//	$filename ='201-'.$empname.'-'.$name,
				$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			else
			{
				//$flname =$name;
				$uploadpathn= BASEPATH.'../files/attachments/';
			}
// echo $uploadpathn;
// die("sdf");
			$files=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files;
			}

          
			$this->load->library('upload',array(
				'upload_path'=>$uploadpathn,
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
			
         // echo "<pre>";
		 // print_r($_FILES);
		 // die("here");
			foreach($_FILES['new_attachments']['name'] as $index=>$name)
			{
				if($foldername =='EmployeeContract')
			{
				$flname=  $empname.'-contract-'.date('Ymd').'-'.$name;
				//$uploadpathn = BASEPATH.'../files/attachments/'.$foldername;
			}
			elseif($foldername=='201File')
			{
				$flname ='201-'.$empname.'-'.$name;
				//$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
			else
			{
				$flname =$name;
				//$uploadpathn= BASEPATH.'../files/attachments/'.$foldername;
			}
				
				$_FILES['new_attachment']=array(
					'name'=>$flname,
					'type'=>$_FILES['new_attachments']['type'][$index],
					'tmp_name'=>$_FILES['new_attachments']['tmp_name'][$index],
					'error'=>$_FILES['new_attachments']['error'][$index],
					'size'=>$_FILES['new_attachments']['size'][$index]
				);
             
				if (!$this->upload->do_upload('new_attachment'))
				{
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             if($at_id!=0)
			 {
				 $files['files']['success'][]=array('id'=>$this->update_attachment($type,$object, $at_id),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			 }
			 else
			 {
				$files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			 }
			}
          
		return $files;
	}
	
	function upload_attachmentsm($type,$object)
		{
		
		// echo "<pre>";
		// print_r($_FILES);
		// die("swdfaqwe");
			$files=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files;
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments',
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
			foreach($_FILES['new_attachmentsm']['name'] as $index=>$name)
			{
				$_FILES['new_attachmentsm']=array(
					'name'=>$name,
					'type'=>$_FILES['new_attachmentsm']['type'][$index],
					'tmp_name'=>$_FILES['new_attachmentsm']['tmp_name'][$index],
					'error'=>$_FILES['new_attachmentsm']['error'][$index],
					'size'=>$_FILES['new_attachmentsm']['size'][$index]
				);
             
				if (!$this->upload->do_upload('new_attachmentsm'))
				{
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files;
	}
	
	
	
	
	function upload_attachments2($type,$object)
		{
		// echo'<pre>';
		// print_r($type);
		// print_r($object);
		// echo'</pre>';
		// die('rhtrhrt');
			$files2=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files2;
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments',
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
			foreach($_FILES['new_attachments2']['name'] as $index2=>$name)
			{
				$_FILES['new_attachment2']=array(
					'name'=>$name,
					'type'=>$_FILES['new_attachments2']['type'][$index2],
					'tmp_name'=>$_FILES['new_attachments2']['tmp_name'][$index2],
					'error'=>$_FILES['new_attachments2']['error'][$index2],
					'size'=>$_FILES['new_attachments2']['size'][$index2]
				);
             
				if (!$this->upload->do_upload('new_attachment2'))
				{
					$files2['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files2['files']['success'][]=array('id'=>$this->save_attachment2($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files2;
	}
      
	  
	  function upload_attachments2m($type,$object)
		{
		// echo'<pre>';
		// print_r($type);
		// print_r($object);
		// echo'</pre>';
		// die('rhtrhrt');
			$files2=array('files'=>array('success'=>array(),'failed'=>array()));
          
			if (count($_FILES)==0)
			{
				return $files2;
			}
          
			$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/attachments',
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				//'encrypt_name'=>TRUE
			));
         
			foreach($_FILES['new_attachments2m']['name'] as $index2=>$name)
			{
				$_FILES['new_attachment2m']=array(
					'name'=>$name,
					'type'=>$_FILES['new_attachments2m']['type'][$index2],
					'tmp_name'=>$_FILES['new_attachments2m']['tmp_name'][$index2],
					'error'=>$_FILES['new_attachments2m']['error'][$index2],
					'size'=>$_FILES['new_attachments2m']['size'][$index2]
				);
             
				if (!$this->upload->do_upload('new_attachment2m'))
				{
					$files2['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
             
				$files2['files']['success'][]=array('id'=>$this->save_attachment2($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
			}
          
		return $files2;
	}
      
      private function get_attachment($attachment_id)
      {
		  // echo'<pre>';
		  // print_r($attachment_id);
		  // echo'</pre>';
		  // die('rgrg');
		  // die('rgrg');
          return $this->db
                      ->select('*')
                      ->where('attachment_id',$attachment_id)
                      ->get('attachments')
                      ->row_array();
      }
      
      function remove_attachment($attachment_id,$check_permission=FALSE)
      {
          $attachment=$this->get_attachment($attachment_id);
          
          if (($check_permission) AND (!call_user_func(array($this,'check_'.$attachment['type']),$attachment['object'])))
          {
              return FALSE;
          }
          
          if (file_exists(BASEPATH.'../files/attachments/'.$attachment['location']))
          {
              @unlink(BASEPATH.'../files/attachments/'.$attachment['location']);
              $this->db->delete('attachments',array('attachment_id'=>$attachment_id));
          }
      }
      
      function download_attachment($attachment_id,$check_permission=FALSE)
      {
		  $this->load->helper('download');
		//  die('fvvf');
          $attachment=$this->get_attachment($attachment_id);
          if (($check_permission) AND (!call_user_func(array($this,'check_'.$attachment['type']),$attachment['object'])))
          {
              return FALSE;
          }
          
         // return $attachment;
           // echo "<pre>";
		   // print_R($attachment);
		   // die("here");
          
          
          if (!in_array($attachment['extenstion'],array('png','pdf','jpg','jpeg','gif','bmp','mmap', 'PNG','PDF','JPG','JPEG','GIF','BMP','MMAP')))
          {
              header('Content-Description: File Transfer');
              header('Content-Disposition: attachment; filename='.$attachment["file"]);
          }
          
          header('Content-Type: '.$attachment['mime']);
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Content-Transfer-Encoding: binary');
		  header('Content-Disposition: attachment; filename='.$attachment["file"]);
          header('Expires: 0');
          header('Pragma: public');
          readfile(BASEPATH.'../files/attachments/'.$attachment['file']);
          exit;
          return TRUE;





      }
      
      private function check_license($license_id)
      {
          return $this->db
                      ->select('license_id')
                      ->where(array('license_id'=>$license_id,'employee_id'=>$this->session->current->userdata('employee_id')))
                      ->get('employees_licenses')
                      ->num_rows()>0;
      }
      
      private function check_message($message_id)
      {
          return $this->db
                      ->select('message_id')
                      ->join('mailbox_employees','mailbox_employees.thread_id = mailbox_messages.thread_id','LEFT')
                      ->where(array('message_id'=>$message_id,'employee_id'=>$this->session->current->userdata('employee_id')))
                      ->get('mailbox_messages')
                      ->num_rows()>0;
      }
      
      
      function remove_attachments($type,$object)
      {
          $files=$this->db
                      ->select('*')
                      ->where(array('type'=>$type,'object'=>$object))
                      ->get('attachments')
                      ->result_array();
          
          foreach($files as $attachment)
          {
              if (file_exists(BASEPATH.'../files/attachments/'.$attachment['location']))
              {
                  @unlink(BASEPATH.'../files/attachments/'.$attachment['location']);
                  $this->db->delete('attachments',array('attachment_id'=>$attachment['attachment_id']));
              }
          }
      }
  }
?>