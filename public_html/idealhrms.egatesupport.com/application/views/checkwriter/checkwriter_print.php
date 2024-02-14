<link href="css/print_employee_id.css" rel="stylesheet">

	<?php
	//echo "<pre>";
	//print_R($cherwriterdaa);
		$amount=  str_replace(',','', $cherwriterdaa['cherwriterdaa'][0]['amount']);
	 $check_date= $cherwriterdaa['cherwriterdaa'][0]['check_date'];
	 $payto= $cherwriterdaa['cherwriterdaa'][0]['check_pay_to'];
	if (strpos($amount, ".") !== false) {
   $amountsplit =explode('.',$amount);
   $cents =end($amountsplit);
   if($cents=='00')
   {
	   $cents='';
   }
}
	

 // recursive fn, converts three digits per pass
function convertTri($num, $tri) {
	

  //global $ones, $tens, $triplets;
  $ones = array(
 "",
 " One",
 " Two",
 " Three",
 " Four",
 " Five",
 " Six",
 " Seven",
 " Eight",
 " Nine",
 " Ten",
 " Eleven",
 " Twelve",
 " Thirteen",
 " Fourteen",
 " Fifteen",
 " Sixteen",
 " Seventeen",
 " Eighteen",
 " Nineteen"
);
 
$tens = array(
 "",
 "",
 " Twenty",
 " Thirty",
 " Forty",
 " Fifty",
 " Sixty",
 " Seventy",
 " Eighty",
 " Ninety"
);
 
$triplets = array(
 "",
 " Thousand",
 " Million",
 " Billion",
 " Trillion",
 " Quadrillion",
 " Quintillion",
 " Sextillion",
 " Septillion",
 " Octillion",
 " Nonillion"
);

  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
 
  // init the output string
  $str = "";
 // echo $x;
 
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " Hundred";

  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
 
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];

  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }
 
// returns the number as an anglicized string
function convertNum($num) {
$num = (int) $num;    // make sure it's an integer
 
 if ($num < 0)
  return "negative".convertTri(-$num, 0);
 
 if ($num == 0)
  return "zero";
 
 return convertTri($num, 0);
}
 
 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);
 
  return $sign * (int) ($val * pow(10.0, $scale));
 }

?>
<style>


@page{ sheet-size: 205mm 75mm; }



</style>


<div class="center_wrap" style="margin:50px;">
<div class="pay" style="padding-top:2px;">
<h4 style="margin-bottom:0px;text-align:right;font-size:14px;margin-right:-5px;"><?php echo $check_date;?></h4>
</div>
<div class="phil" style="margin-top:-6px;float:left; width:50%;font-size:14px;font-weight:bold;">
<p style="margin-left:5px;margin-bottom:-5px;"><?php echo strtoupper($payto);?></p>
</div>

<div class="money" style="width:50%;float:left; text-align:right;">
<h4 style="margin-bottom:0px;font-size:14px;margin-right:-5px;"><?php echo number_format($amount,2);?></h4>
</div>
<p style="margin-left:3px;margin-top:6px;font-size:14px; font-weight:bold;position: relative;"><?php echo convertNum($amount);?>  Pesos  <?php  if($cents!=""){echo "and".' '. $cents.'/100';};?></p>
</div>




