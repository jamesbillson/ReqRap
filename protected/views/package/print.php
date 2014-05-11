
        

<h2><?php echo $heading; ?>. Use Case Analysis</h2>
<?php $heading++; ?>

<?php 
foreach($packages as $package){
$packusecases = Usecase::model()->getPackageUsecases($package['package_id']);

 //if (count($packusecases)>0){ ?>

              
<h3>Package PA-<?php echo $package['number'];?> <?php echo $package['name'];?> Usecase Diagram</h3>

<?php $this->renderPartial('/package/printdiagram',array('package'=>$package));  ?>

<h4>&nbsp;</h4>
<h3>Package PA-<?php echo $package['number'];?> <?php echo $package['name'];?> Usecase Descriptions</h3>           


<?php foreach($packusecases as $uc){ ?>

<h4>UC-<?php echo str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $uc['name'];?></h4>


  <table class="table">

      <tbody>

         <tr class="odd">
             <td width="30%"><b> Description </b></td>
             <td><?php echo $uc['description']; ?></td>
          </tr>
          
          <tr class="odd">
              <td> <b> Preconditions</b></td> 
              <td>   <?php echo $uc['preconditions']; ?></td>
          </tr>


    <?php 
$actors = Actor::model()->getActors($uc['usecase_id']); // get the requirements with answers

  if (count($actors)):?>

          <tr class="odd">
             <td><b><?php echo(count($actors)>1)?'Actors':'Actor';  ?></b></td> 
             <td> 
                  <?php foreach($actors as $actor) : ?>  
                  <?php echo $actor['name'];?> <br />
                  <?php endforeach ?> 
              </td> 
           </tr>
  
  <?php endif;  ?>

  
  <?php $this->renderPartial('/flow/print', array('usecase'=>$uc['id'],'actors'=>$actors)); 
  
  


$rules = Usecase::model()->getLinkedObjects($uc['usecase_id'],1,16);

  if (count($rules)):?>

          <tr class="odd">
              <td><b>Business Rules</b></td>
              <td>
        <?php foreach($rules as $rule) : // Go through each un answered question??>
                  BR-<?php echo str_pad($rule['number'], 4, "0", STR_PAD_LEFT); ?>
        <?php echo $rule['title'];?>
         <br />
        <?php endforeach ?>       
              </td>
          </tr>

  <?php endif;  ?>

      
   
       <?php 
$interfaces = Iface::model()->getIfaces($uc['usecase_id']); 



if (count($interfaces)){
      $lastcat='';
      ?>
          <tr><td><b>Interfaces</b></td>
 <td>
        <?php foreach($interfaces as $iface) :?>
             <?php 
              if($lastcat!=$iface['type']){ 
              echo '<b>'.$iface['type'].'</b><br />'; 
              $lastcat=$iface['type']; 
              }
                   echo 'UI-'.str_pad($iface['typenum'], 2, "0", STR_PAD_LEFT).'-'.str_pad($iface['number'], 3, "0", STR_PAD_LEFT);
                   echo ' '.$iface['name'];?>
                <br />
        <?php endforeach ?>       
 </td></tr>

  <?php }  ?>

     
       <?php 
$forms = Usecase::model()->getLinkedObjects($uc['usecase_id'],2,14) ;
if (count($forms)):?>
          <tr><td><b>Forms</b></td><td>
            <?php foreach($forms as $form) : 
                echo 'UF-'.str_pad($form['number'], 3, "0", STR_PAD_LEFT);?> 
                <?php echo $form['name'];?>
            <?php endforeach ?>       
          </td></tr>

<?php endif; // end count of results ?>    
         
                  </tbody>
        
  </table>         
<?php } // END LOOP THROUGH USE CASES ?>   
          
 
<?php }  

             // }
// END LOOP THROUGH PACKAGES?>
            
 