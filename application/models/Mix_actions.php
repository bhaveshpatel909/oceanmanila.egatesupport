<?php 
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
    
  class Mix_actions extends Base_model
  {
      function get_resign_reasons()
      {
          return $this->db
                      ->select('*')
                      ->where('is_active',1)
                      ->order_by('reason_name')
                      ->get('resign_reasons')
                      ->result_array();
      }
      
      function get_reason($reason_id)
      {
          return $this->db
                      ->select('*')
                      ->where('reason_id',$reason_id)
                      ->get('resign_reasons')
                      ->row_array();
      }
      
      function save_reason()
      {
          $data=array(
            'reason_name'=>$this->input->post('reason_name')
          );
          
          if ($this->input->post('reason_id')=='0')
          {
              $this->db->insert('resign_reasons',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('resign_reasons',$data,array('reason_id'=>$this->input->post('reason_id')));
          return TRUE;
      }
      
      function delete_reason($reason_id)
      {
          $this->db->update('resign_reasons',array('is_active'=>0),array('reason_id'=>$reason_id));
      }
      
      function get_processing_errors()
      {
          return $this->db
                      ->select('*')
                      ->order_by('error_date')
                      ->get('processing_errors')
                      ->result_array();
      }
      
      function delete_processing_errors()
      {
          $this->db->truncate('processing_errors');
          $this->db->update('events',array('has_error'=>0,'busy_by'=>0),array('has_error'=>1));
      }
      
      function get_punch_clock()
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->order_by('record_id','DESC')
                      ->limit(5)
                      ->get('punch_clock')
                      ->result_array();
      }
      
      function update_clock_comments()
      {
          $this->db
               ->where('employee_id',$this->session->current->userdata('employee_id')) 
               ->where('end_time IS NULL',NULL,FALSE)
               ->update('punch_clock',array('comments'=>$this->input->post('comments')));
      }
      
      function complete_clock()
      {
		  
		  
		 $starttime=  $this->db
                      ->select('start_time')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->order_by('record_id','DESC')
                      ->limit(1)
                      ->get('punch_clock')
                      ->result_array();
					  // echo "<pre>";
					  // print_R($starttime);
					  // die("fdgsd");
		    $cstarttime=$this->getcompanystarttime('overtime');
			$cendtime=$this->getcompanystarttime('work_end');
			$timeout_allowance=$this->getcompanystarttime('timeout_allowance');
		
			   // echo "<pre>";
			   // print_R($cstarttime);
			   // die("adsfe");
			   $cstart= $cstarttime[0]['setting_value'];
			   $cend= $cendtime[0]['setting_value'];
			   $timeout_all= $timeout_allowance[0]['setting_value'];
			   
			   
			    $currenttime= date("H:i");
			   // die("dgsdfg");
			
			
			

  $overfirstTime = '+'.$cstart;

 $endTime = $cend;

 $firstTime = $currenttime;


 $compayend = str_replace(':', '', $cend);
  
 $currentclock = str_replace(':', '', $currenttime);
 
 $date1 = date('Y-m-d', strtotime($starttime[0]['start_time']));
$date2 = date('Y-m-d');
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);

 if($currentclock <= $compayend)
 {
	// echo "dfgs";
	// die("here");
	 $overtime= '';
	  $end_work = date('Y-m-d H:i:s');
	  if($timestamp1 < $timestamp2)
		{
			 $remarks= 'Auto Time Out';
		}
		else
		{
			
			$remarks= 'Manual Time Out';
		}
					
 }
 else
 {
	 // echo "dfgsdd";
	// die("hereeee");
	 //$endTime = strtotime('+60 minutes', strtotime($cend));
// echo $secondTime= date('H:i', $endTime);
  $selectedTime = $cend;
  
$endTime = strtotime($overfirstTime." minutes", strtotime($selectedTime));
 $secondTime = date('H:i', $endTime);
  $dtime =$firstTime;

				 $atime= $secondTime;

				 // $test = $cstart;
				// replace semicolon with empty ''
				 $now = str_replace(':', '', $dtime);

				  $comp = str_replace(':', '', $atime);

				 

				list($firstMinutes, $firstSeconds) = explode(':', $firstTime);
				list($secondMinutes, $secondSeconds) = explode(':', $secondTime);

				$firstSeconds += ($firstMinutes * 60);
				$secondSeconds += ($secondMinutes * 60);
				  $difference = $secondSeconds - $firstSeconds;
				 
				 $difference1 = $firstSeconds - $secondSeconds;

				  // $hours = floor($difference / 3600);
				  $hours = floor($difference1 / 60);

				  $minutes = $difference1 % 60;	
				  /***************For TimeOut allowance*************/
				// echo $currenttime;
				// echo "<br/>";
				 // echo $cend;
				  list($firstMinutess, $firstSecondss) = explode(':', $currenttime);
				list($secondMinutess, $secondSecondss) = explode(':', $cend);

				$firstSecondss += ($firstMinutess * 60);
				$secondSecondss += ($secondMinutess * 60);
				 // $differences = $secondSecondss - $firstSecondss;
				 
				  $difference11 = $firstSecondss - $secondSecondss;

				  // $hours = floor($difference / 3600);
				   $hourss = floor($difference11 / 60);

				   $minutess = $difference11 % 60;
				 /*************************End time Out allowance**********************/
				 $this->session->current->userdata('employee_id');

				 
				$remarks='';
				$overtime='';
				$longnow = date('H:i');
				//echo "<br/>";
				 $ttt = $hourss.$minutess;
				 $hhhhh = floor($timeout_all / 60).($timeout_all -   floor($timeout_all / 60) * 60);
				 $hhhhhout = floor($timeout_all / 60).':'.($timeout_all -   floor($timeout_all / 60) * 60);
				  $cstarthhh = floor($cstart / 60).'.'.($cstart -   floor($cstart / 60) * 60);
				
				if($ttt < $hhhhh)

				{
					//echo "gjhg";
					$timeoutt ='Work end time out';
					$remarks= 'Manual Time Out';
					$overtime ='' ;
					$date = date('Y-m-d');
					$end_work_overtime = "";
					 $end_work = date('Y-m-d H:i:s');
				}
				elseif($ttt > $hhhhh)
				{
					
					//echo "gfhfg";
					 $date = date('Y-m-d');
					 // echo  $currenttime;
					 // echo "<br/>";
					 // echo  $hhhhhout;
					 // echo "<br/>"; 
					 // echo  $cend;
					 // echo "<br/>";
					list($firstMinut, $firstSecond) = explode(':', $currenttime);
				list($secondMinut, $secondSecond) = explode(':', $hhhhhout);
				list($secondMinutcend, $secondSecondcend) = explode(':', $cend);

				$firstSecond += ($firstMinut * 60);
				$secondSecond += ($secondMinut * 60);
				$secondSecondcend += ($secondMinutcend * 60);
				 // $differences = $secondSecondss - $firstSecondss;
				 
				//  $difference11 = $firstSecond - ($secondSecond + $secondSecondcend);
				  $difference11 = $firstSecond - $secondSecond ;
//echo $difference11;
				  // $hours = floor($difference / 3600);
				  $h = floor($difference11 / 60);

				  $m = $difference11 % 60;
				  
				  if($ttt > $cstarthhh)
					{
						$tout = $date .' '. $h.':'.$m.':00';
					$remarks= 'Overtime';
					$overtime = $hours.':'.$minutes;
					 $end_work = date('Y-m-d H:i:s');
					 $timeoutt = $tout;
					}
					else
					{
						$tout = $date .' '. $h.':'.$m.':00';
					$remarks= 'Overtime';
					$overtime = '';
					 $end_work = date('Y-m-d H:i:s');
					 $timeoutt = $tout;
						
					}
					 
				}
				
				else
				{
					//echo "fghf";
					$remarks= 'Manual Time Out';
					$overtime ='' ;
					$date = date('Y-m-d');
					 $end_work_overtime = "";
					  $end_work = date('Y-m-d H:i:s');
					   $timeoutt= '';
				}
	 
	 
 }

// echo $timeoutt;
 echo $overtime;
// die("fgtr");
      }
	  
	   function complete_clock_2()
      {
		  
		  
		 $starttime=  $this->db
                      ->select('start_time')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->order_by('record_id','DESC')
                      ->limit(1)
                      ->get('punch_clock')
                      ->result_array();
					  // echo "<pre>";
					  // print_R($starttime);
					  // die("fdgsd");
		   $cstarttime=$this->getcompanystarttime('overtime');
		    $cendtime=$this->getcompanystarttime('work_end');
		   $timeout_allowance=$this->getcompanystarttime('timeout_allowance');
		
			   // echo "<pre>";
			   // print_R($cstarttime);
			   // die("adsfe");
			   $cstart= $cstarttime[0]['setting_value'];
			    $cend= $cendtime[0]['setting_value'];
			   
			    $timeout_all= $timeout_allowance[0]['setting_value'];
			   $currenttime= date("H:i");
			
			
			

  $overfirstTime = '+'.$cstart;

 //$endTime = $cend;

 $firstTime = $currenttime;

 $compayend = str_replace(':', '', $cend);

 $currentclock = str_replace(':', '', $currenttime);
 
 $date1 = date('Y-m-d', strtotime($starttime[0]['start_time']));
$date2 = date('Y-m-d');
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);

 if($currentclock <= $compayend)
 {
	//echo "cdxg"; 
	 $overtime= '';
	  $end_work = date('Y-m-d H:i:s');
	  if($timestamp1 < $timestamp2)
		{
			 $remarks= 'Auto Time Out';
		}
		else
		{
			
			$remarks= 'Manual Time Out';
		}
					
 }
 else
 {
	 //echo "fh";
	 //echo "sdfad";
	// die("sdfasd");
	 //$endTime = strtotime('+60 minutes', strtotime($cend));
//echo $secondTime= date('H:i', $cend);
//echo "<br/>";
  $overfirstTime;
  $selectedTime = $cend;
// echo "<br/>";
 $oendTime = strtotime($overfirstTime." minutes", strtotime($selectedTime));
//echo "<br/>";
 $secondTime = date('H:i', $oendTime);
 $dtime =$firstTime;

				 $atime= $secondTime;

				 // $test = $cstart;
				// replace semicolon with empty ''
				 $now = str_replace(':', '', $dtime);

				  $comp = str_replace(':', '', $atime);

				 

				list($firstMinutes, $firstSeconds) = explode(':', $firstTime);
				list($secondMinutes, $secondSeconds) = explode(':', $secondTime);

				$firstSeconds += ($firstMinutes * 60);
				$secondSeconds += ($secondMinutes * 60);
				  $difference = $secondSeconds - $firstSeconds;
				 
				 $difference1 = $firstSeconds - $secondSeconds;

				  // $hours = floor($difference / 3600);
				  $hours = floor($difference1 / 60);

				  $minutes = $difference1 % 60;
				 
				/***************For TimeOut allowance*************/
				 // echo $currenttime;
				 //echo "<br/>";
				 // echo $cend;
				  list($firstMinutess, $firstSecondss) = explode(':', $currenttime);
				list($secondMinutess, $secondSecondss) = explode(':', $cend);

				$firstSecondss += ($firstMinutess * 60);
				$secondSecondss += ($secondMinutess * 60);
				 // $differences = $secondSecondss - $firstSecondss;
				 
				  $difference11 = $firstSecondss - $secondSecondss;

				  // $hours = floor($difference / 3600);
				  $hourss = floor($difference11 / 60);

				  $minutess = $difference11 % 60;
				 /*************************End time Out allowance**********************/
				 $this->session->current->userdata('employee_id');

				 
				$remarks='';
				$overtime='';
				$longnow = date('H:i');
				$ttt = $hourss.$minutess;
				 $hhhhh = floor($timeout_all / 60).($timeout_all -   floor($timeout_all / 60) * 60);
				 $hhhhhout = floor($timeout_all / 60).':'.($timeout_all -   floor($timeout_all / 60) * 60);
				 $cstarthhh = floor($cstart / 60).'.'.($cstart -   floor($cstart / 60) * 60);
				
				if($ttt < $hhhhh)

				{
					//echo "gjhg";
					$timeoutt ='Work end time out';
					$remarks= 'Manual Time Out';
					$overtime ='' ;
					$date = date('Y-m-d');
					$end_work_overtime = "";
					 $end_work = date('Y-m-d H:i:s');
				}
				elseif($ttt > $hhhhh)
				{
					
					//echo "gfhfg";
					 $date = date('Y-m-d');
					 // echo  $currenttime;
					 // echo "<br/>";
					 // echo  $hhhhhout;
					 // echo "<br/>"; 
					 // echo  $cend;
					 // echo "<br/>";
					list($firstMinut, $firstSecond) = explode(':', $currenttime);
				list($secondMinut, $secondSecond) = explode(':', $hhhhhout);
				list($secondMinutcend, $secondSecondcend) = explode(':', $cend);

				$firstSecond += ($firstMinut * 60);
				$secondSecond += ($secondMinut * 60);
				$secondSecondcend += ($secondMinutcend * 60);
				 // $differences = $secondSecondss - $firstSecondss;
				 
				//  $difference11 = $firstSecond - ($secondSecond + $secondSecondcend);
				  $difference11 = $firstSecond - $secondSecond ;
//echo $difference11;
				  // $hours = floor($difference / 3600);
				  $h = floor($difference11 / 60);

				  $m = $difference11 % 60;
				  
				  if($ttt > $cstarthhh)
					{
						$tout = $date .' '. $h.':'.$m.':00';
					$remarks= 'Overtime';
					$overtime = $hours.':'.$minutes;
					 $end_work = date('Y-m-d H:i:s');
					 $timeoutt = $tout;
					}
					else
					{
						$tout = $date .' '. $h.':'.$m.':00';
					$remarks= 'Overtime';
					$overtime = '';
					 $end_work = date('Y-m-d H:i:s');
					 $timeoutt = $tout;
						
					}
					 
				}
				
				else
				{
					//echo "fghf";
					$remarks= 'Manual Time Out';
					$overtime ='' ;
					$date = date('Y-m-d');
					 $end_work_overtime = "";
					  $end_work = date('Y-m-d H:i:s');
					   $timeoutt= '';
				}
	 
	 
 }

 //echo $overtime;
//echo $timeoutt;
 //echo $end_work;
//die("sdfaes");
// if($overtime)
// {
// echo $overtime;
// }
// elseif($this->input->post('comments')!="")
// {

			$this->db
               ->where('employee_id',$this->session->current->userdata('employee_id')) 
			   ->where('end_time IS NULL',NULL,FALSE)
               ->update('punch_clock',array(
			   'comments'=>$this->input->post('comments'),
			   'end_time'=>$end_work,
			   'overtime_remark' => $remarks,
			   'time_out' => $timeoutt,
			   'overtime'=> $overtime,
			   'ipaddress_out'=> $_SERVER['REMOTE_ADDR'],
			   )
			   );
//}
      }
	
	
      
      function get_latest_clock()
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->limit(1)
                      ->order_by('end_time','DESC')
                      ->get('punch_clock')
                      ->result_array();
      }
	  function settingsas()
      {
          return $gbg = $this->db
                      ->select('*')
                       ->where('employee_id',$this->session->current->userdata('employee_id'))
                      // ->limit(1)
                      // ->order_by('end_time','DESC')
                      ->get('employees')
                      ->result_array();
      }
      
      function start_clock()
      {
		 $is_exist=$this->get_latest_clock();
          // if ((isset($is_exist[0]) AND !is_null($is_exist[0]['end_time'])) OR (count($is_exist)==0))
          // {
			   $gb=$this->settingsas();
			   $cstarttime=$this->getcompanystarttime('work_start');
			   $gen_pen_time=$this->getcompanystarttime('overtime');
			   
			   // die("adsfe");
			   $cstart= $cstarttime[0]['setting_value'];
			   $gpenalitytime= $gen_pen_time[0]['setting_value'];
			// echo  $hrmint= = date('H:i');
			//echo $dateee = date('Y-m-d H:i:s');
			//$date = date('Y-m-d');
					//echo  $starttime = $date .' '. $cstart.':00';
					//die("dgvdsf");
			 $currenttime= date("H:i");
			//die("here");
			//echo strtotime($currenttime);
			 //strtotime($cstarttime);
			///$time="00:12:30"; //5 minutes
			
			

 $firstTime = $cstart;
$secondTime = $currenttime;

list($firstMinutes, $firstSeconds) = explode(':', $firstTime);
list($secondMinutes, $secondSeconds) = explode(':', $secondTime);

 $firstSeconds += ($firstMinutes * 60);
 $secondSeconds += ($secondMinutes * 60);
 $difference = $firstSeconds - $secondSeconds;


$test = $cstart;
// replace semicolon with empty ''
$comp = str_replace(':', '', $firstTime);

 $now = str_replace(':', '', $currenttime);


$longnow = date('H:i');

// compare strings
// if($comp < $now)
// {
    // echo $test.' is less than '.$longnow;
// }
// else
// {
    // echo $test.' is greater than '.$longnow; 
// }
// die("dfsgf");

	
			$remarks='';
			if($comp < $now)


				{
					//echo "sdas";
					//die("xcad");
				 //do some work
				 //echo "late attendance";
				 $date = date('Y-m-d H:i:s');
				 if($gb[0]['late_time']!="")
				 {
				  $exact =  '+'.$gb[0]['late_time'].'minute';
				  $date = strtotime($date);
				 $date = strtotime( $exact, $date);
					$lastd = date('Y-m-d H:i:s', $date);
					  $starttime=  date('Y-m-d H:i:s');
					  $remarks = 'Late Attendance';
				 }
				 else
				 {
					 echo $gpenalitytime;
					 $exact =  '+'.$gpenalitytime.'minute';
					$date = strtotime($date);
					$date = strtotime( $exact, $date);
					$lastd = date('Y-m-d H:i:s', $date);
						$starttime=  date('Y-m-d H:i:s');
						$remarks = 'Late Attendance';
					 
				 }
					
						
						//$date = "2017-06-16 08:40:00";
					
				}
				else
				{
					//echo "dsafd";
					//die("dsaf");
					
					 $date = date('Y-m-d');
					
					 $lastd = $date .' '. $cstart.':00';
					 $starttime= date('Y-m-d H:i:s');
					 $remarks= '';
					 
				}
			
			 // echo $lastd;
			 // echo $starttime;
			
		 // die("here");
              $this->db->insert('punch_clock',array(
                'employee_id'=>$this->session->current->userdata('employee_id'),
                'start_time'=>$starttime,
                'penality_time'=>$lastd,
				'remarks' => $remarks,
				'ipaddress_in' => $_SERVER['REMOTE_ADDR'],
				'ipaddress_out' => '',
              ));
			
			  
          //} 
		 
      }
	  function getcompanystarttime($key)
	  {
		  return  $this->db
                      ->select('*')
                       ->where('setting_key',$key)
                      // ->limit(1)
                      // ->order_by('end_time','DESC')
                      ->get('settings')
                      ->result_array();
		  
	  }
      
      function get_unsent_emails()
      {
          return $this->db
                       ->where(array('busy_by'=>0,'has_error'=>0)) 
                       ->count_all_results('events');
      }
	  
	  
	  
	  
/*****************************************************Model of original clock start*************************************************************/	  

    function orget_punch_clock()
      {
          return $this->db
                      ->select('record_id, start_time, end_time, comments')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->order_by('start_time','DESC')
                      ->limit(5)
                      ->get('orpunch_clock')
                      ->result_array();
      }
      
      function orupdate_clock_comments()
      {
          $this->db
               ->where('employee_id',$this->session->current->userdata('employee_id')) 
               ->where('end_time IS NULL',NULL,FALSE)
               ->update('orpunch_clock',array('comments'=>$this->input->post('comments')));
      }
      
      function orcomplete_clock()
      {
          $this->db
               ->where('employee_id',$this->session->current->userdata('employee_id')) 
               ->where('end_time IS NULL',NULL,FALSE)
               ->update('orpunch_clock',array('comments'=>$this->input->post('comments'),'end_time'=>date('Y-m-d H:i:s')));
      }
      
      function orget_latest_clock()
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->limit(1)
                      ->order_by('end_time','DESC')
                      ->get('orpunch_clock')
                      ->result_array();
      }
      
      function orstart_clock()
      {
          $is_exist=$this->get_latest_clock();
          if ((isset($is_exist[0]) AND !is_null($is_exist[0]['end_time'])) OR (count($is_exist)==0))
          {
              $this->db->insert('orpunch_clock',array(
                'employee_id'=>$this->session->current->userdata('employee_id'),
                'start_time'=>date('Y-m-d H:i:s')
              ));
          }
      }
      


/*****************************************************Model of original clock end*************************************************************/	  
	  
	  
	  
	  
  }
?>