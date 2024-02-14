<script>
    $('document').ready(function(){
		
	
	
        $('#employee').magicSuggest({
			allowFreeEntries:1,
            data:'reports/find_employee',
            maxSelection:1
			     });

$($('#employee').magicSuggest()).on(
  'selectionchange', function(e, cb, s){
     var allemp = (cb.getValue());
	 
	 
	 
  }
);
		
    })
</script>

<?php
  $empname =$_GET['xy'];?>

  <?php $empid = $_GET['id'];?>

<?php  

 $empdepart =$_GET['de']; 
 
 ?>
 
 <p id="empnamee"><?php 
  $empdipart= $empname.' '.'<span> ['.$empdepart.'] </span>' ;
 
    $newdep = strip_tags($empdipart);
  ?></p>
 
 
 
<?php if($empname ==''){ ?>

<div class="form-group">


    <label for="employees"><?= $this->lang->line('Employee')?></label>
	
    <input type="text" id="employee"   name="employee">
	</div>
	
	
<?php } 
else    { ?>
	
<input type ="hidden"  name="employee" id="employee"  value="<?php echo $empid ;?>">
<div class="ms-ctn form-control " class="col-lg-6">
<input type ="text"  value="<?php echo $empname;?> " readonly>


</div>
<?php }?>
 
 <style>
 p#empnamee {
    margin: 0px;
}
 </style>
 
