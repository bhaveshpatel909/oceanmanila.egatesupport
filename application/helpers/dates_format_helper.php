<?php
  function dates_format($start_date,$end_date)
  {
      $ci = &get_instance();
      
      $start_date=strtotime($start_date);
      $end_date=strtotime($end_date);
      
      if (date('Y-m-d',$start_date)==date('Y-m-d',$end_date))
      {
          return date($ci->config->item('date_format').' '.$ci->config->item('time_format'),$start_date).' - '.date($ci->config->item('time_format'),$end_date);
      }
      
      return date($ci->config->item('date_format').' '.$ci->config->item('time_format'),$start_date).' - '.date($ci->config->item('date_format').' '.$ci->config->item('time_format'),$end_date);
  }
?>