<?php 
$data = Usecase::model()->getProjectUCs($model->id);
$package=0;
$uc=0;
$project_total= 0;
$last_package = '';
$last_uc='';
$project=array();
$item=0;
foreach($data as $line) {
$item++;   

 

if($last_package != $line['packname']) {
            $package ++;
            $project[$package]['total']= 0;
            $project[$package]['name']=$line['packname'];
            $uc=0;
            $last_uc=''; // its a new package - reset Use Case in case the component name is the same
  }             
            //END show the package as header
    
  
  if($last_uc !== $line['name']) {
            $uc ++;
            $project[$package][$uc]['total']= 0;
            $project[$package][$uc]['name']=$line['name'];
           
              } 
  
  
                $project[$package][$uc]['name']= $line['name'];
                $project[$package][$uc]['description']= $line['description'];
                $project[$package][$uc]['id']= $line['id'];
                if(!empty($line['name'])){
                $project[$package][$uc]['total']= $project[$package][$uc]['total'] + 1;
                $project[$package]['total']= $project[$package]['total'] + 1;
                $project_total=$project_total+1;
                }

         $last_package=$line['packname'];
         $last_uc=$line['name'];
      
      
   }
// echo "<pre>";
// print_r($project);
// echo "</pre>";
  
?>
  


<table>

<tr>
   <td> <b>Project Total</b></td> 

   <td colspan=""></td>
<td> <b><?php  echo number_format($project_total, 0, '.', ',') ;?></b></td>
</tr>
    <?php
    
 $w=1;
  $number_packages=count($project);  
   while($w <= $number_packages) 
   {    
       ?>

 <tr>
        <td> <b>Package: <?php  echo $project[$w]['name']." <br>";?></b></td>
        <td></td>
        <td><b><?php  echo number_format($project[$w]['total'], 0, '.', ',') ;?></b></td>
  </tr>
       <?php
        $x=1; 
        $number_ucs=count($project[$w])-2;
        while($x <= $number_ucs)
          {
         ?>
        <tr>
          <td> <a href="/usecase/view/id/<?php echo $project[$w][$x]['id'];?>"><b><?php  echo $project[$w][$x]['name']." <br>";?></b></a></td> 
           <td><?php echo $project[$w][$x]['description']; ?></td>
        <td> <b><?php  echo number_format($project[$w][$x]['total'], 0, '.', ',') ;?></b></td>
      
         </td>


        </tr>
           <?php           
          $x++;
          } ?>
    <?php           
    $w++;
 
 
    }

     ?>
   
</table>
