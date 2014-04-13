<?php 
$this->layout = "//layouts/print";
$project=Yii::App()->session['project'];
$packages = Package::model()->getPackages($project);
$heading=1;
$objects = Object::model()->getProjectObjects(Yii::app()->session['project']);
$actors = Actor::model()->getProjectActors(Yii::app()->session['project']);
$model=Project::model()->findbyPK($project);


?>
<h1>Requirements Model</h1>

<h2> <?php echo $model->name;?></h2>

<h3> <?php echo $model->company->name;?></h3>



  
    
<?php $releases = Release::model()->findAll('project_id='.Yii::app()->session['project']);

?>
         <?php if (count($releases)){?>
<h3>Release History</h3>
<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Status</th>
                <th>Date</th>
     
	</tr>
	</thead>
   
        <tbody>

        <?php foreach($releases as $release) {
            
            if($release['id']<= Yii::App()->session['release']){ ?>
        <tr class="odd">  
        <td>   
        <?php echo $release['number']; ?> 
        </td>
   
<td>   
       <?php echo Release::$status[$release['status']];?>
        </td>
    
    <td>   
        <?php echo $release['create_date'];?>
        </td>
              
        </tr> <?php 
        }} ?>
</table>
    
    <?php 
        }
    if (count($objects)):?>
<h2><?php echo $heading; ?>. Objects</h2>
<?php $heading++; ?>
        <?php foreach($objects as $object):?>
        
        <h3>OB-<?php echo str_pad($object['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $object['name'];?></h3>
        <?php echo $object['description'];?>
             
        <?php endforeach ?>
        

        <?php foreach($objects as $object):
$objectproperties=  Objectproperty::model()->getObjectProperty($object['object_id']);

  if (count($objectproperties)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Ref</th>
                    <th>Name</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($objectproperties as $objectproperty):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $objectproperty['number'];?>
                    </td>
                    <td>   
                        <?php echo $objectproperty['name'];?>
                    </td>
                    <td>   
                        <?php echo $objectproperty['description'];?>
                    </td>                  
                   

                  
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
 endforeach ?>
        
    <?php endif; ?>







<?php 


    if (count($actors)):?>
<h2><?php echo $heading; ?>. Actors</h2>
<?php $heading++; ?>
        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Aliases</th>

                </tr>
            </thead>
            
            <tbody>
            <?php foreach($actors as $actor):?>
                <tr class="odd">  
                    <td>   
                       
                            <?php echo $actor['name'];?>
                       
                    </td>
                    <td>   
                        <?php echo $actor['description'];?>
                    </td>   
                       <td>   
                        <?php echo $actor['alias'];?>
                    </td>                  
                    

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;?>




  <?php  if (count($packages)): ?>
 
  <h2><?php echo $heading; ?>. Packages and Usecases</h2>
<?php $heading++; ?>
  <?php foreach($packages as $package): ?>
   <h3>
        Package PA-<?php echo $package['number'];?> <?php echo $package['name'];?>
   </h3>
                      

<?php
$usecases = Usecase::model()->getPackageUsecases($package['id']); 
$actors = Actor::model()->getPackageActors($package['id']);
?>

  
<?php
//echo'<pre>';
//print_r($actors);
//echo'</pre>';
?>

  

  <?php
if (count($usecases)): 
$number=count($usecases);
$numberactors=count($actors);


$ucheight=($number*100)+100; 
$actorheight=($numberactors*200)+100;
$imheight=($ucheight>$actorheight)?$ucheight : $actorheight ;

$im = imagecreatetruecolor(600, $imheight);
imageantialias ( $im , 'true' );
$white = imagecolorallocate( $im, 255, 255, 255 );


$black = imagecolorallocate( $im, 0, 0, 0 );


imagefill($im,0,0,$white);
imageline ($im,0,0,600,0,$black);
imageline ($im,0,0,0,$imheight,$black);
imageline ($im,0,$imheight-1,600,$imheight-1,$black);
imageline ($im,599,$imheight-1,599,0,$black);
$font = 'images/arial.ttf';
$actorimage = imagecreatefrompng("images/actor.png");
$xsystemimage= imagecreatefrompng("images/xsystem.png");
$elipse = imagecreatefrompng("images/elipse.png");

imagettftext($im, 14, 0, 10, 30, $black, $font, $package['name']);
$yactor=array();


// ACTORS
for($i=0; $i<=$numberactors-1; $i++){
$actor=$actors[$i];
$yactor[$actor['actor_id']]=(($imheight/($numberactors+1))*$i)+100;
$sprite=($actor['type']==0)?$actorimage:$xsystemimage;
imagecopyresized($im, $sprite, 50, $yactor[$actor['actor_id']], 0, 0, 50, 100,230,460);

imagettftext($im, 14, 0, 50,$yactor[$actor['actor_id']]+115, $black, $font, $actor['name']);

}


for($i=0; $i<=$number-1; $i++){
$uc=$usecases[$i];

 $x=300-(pow((($i+1)-($number/2)),2)*10);
 $y=(($i+1)*100)-100+(($imheight-($number*100))/2);
 $linestart=(($number/2)*100)-50;
 $ytext = (($i+1)*100)+30;
 $xtext = $x+25;
 $elipsecentre=$y-50;
$ucnumber='UC-'.str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT);
$text=$uc['name'];

imagecopyresized($im, $elipse, $x, $y, 0, 0, 200, 100,500,250);

imagettftext($im, 10, 0, $x+30, $y+40, $black, $font, $ucnumber);
imagettftext($im, 10, 0, $x+30, $y+55, $black, $font, $text);


//find UC actors
$ucactors = Usecase::model()->getUsecaseActors($uc['id']);
for($a=0; $a<=count($ucactors)-1; $a++){
$ucactor=$ucactors[$a];
imageline ($im,100,$yactor[$ucactor['actor_id']]+35,$x,$y+50,$black);
}

}  


// Output the image
imagepng($im,"images/".$package['id']."test.png");
// Free up memory
imagedestroy($im);

endif;
?>


<br />
<img src="/images/<?php echo $package['id'] ?>test.png">

 <?php   endforeach;
    endif; ?>  




<?php  if (count($packages)): ?>
        

<h2><?php echo $heading; ?>. Use Case Descriptions</h2>
<?php $heading++; ?>

<?php 
foreach($packages as $package){
$packusecases = Usecase::model()->getPackageUsecases($package['id']);

 ?>

              
<h3>Package PA-<?php echo $package['number'];?> <?php echo $package['name'];?></h3>
               
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
          
 
<?php } // END LOOP THROUGH PACKAGES?>
            
            
   

<?php endif; // END IF THERE ARE PACKAGES?> 

<?php 
$rules = Rule::model()->getProjectRules($project);
if (count($rules)):?>

<h2><?php echo $heading; ?>. Business Rule Register</h2>
<?php $heading++; ?>


<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Title</th>
                <th>Rule Detail</th>


	</tr>
	</thead>
        <tbody>

        <?php foreach($rules as $rule) {?>
        <tr class="odd">  
    <td>         BR-<?php echo str_pad($rule['number'], 3, "0", STR_PAD_LEFT); ?> 
  
    </td>
   
    <td>   
       
            <?php echo $rule['title']; ?>
    </td>
    
    <td>   
        <?php echo $rule['text'];?>
        </td>
              


        </tr>
<?php
        }?>
    
        
   	</tbody>
</table>

<?php     endif; ?>






<?php 

$ifacedetails = Iface::model()->getProjectIfaces(Yii::app()->session['project']);

if (count($ifacedetails)):?>

<h2><?php echo $heading; ?>. Interfaces</h2>
<?php $heading++; ?>
<?php foreach($ifacedetails as $ifacedetail):?>
<h3> IF-<?php echo str_pad($ifacedetail['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $ifacedetail['name'];?></h3>
<?php echo $ifacedetail['type'];?><br /><br />

<img src="/uploads/images/<?php echo $ifacedetail['file'];?>" width="600"><br />
<?php endforeach ?>
<?php endif;?>









<?php 
$forms = Form::model()->getProjectForms(Yii::app()->session['project']);

if (count($forms)):?>
<h2><?php echo $heading; ?>. Forms</h2>
<?php $heading++; ?>

<?php foreach($forms as $form): ?>

        <table class="table">
          
            
            <tbody>
           
                
                <tr class="odd">  
                    <td colspan="6">   

                        <h3> UF-<?php echo str_pad($form['number'], 3, "0", STR_PAD_LEFT); ?> 

  
                        <?php echo $form['name']; ?></h3>
                        
                    </td>
                                   </tr>
     <?php $fields = Formproperty::model()->getFormProperty($form['form_id']); ?>
     <?php if (count($fields)):?>
                                   
            
                <tr>
                  <td><strong> Number</strong></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Type</strong></td>
                    <td><strong>Validation</strong></td>
                    <td><strong>Required</strong></td>
                    
                </tr>
           
                                   
     <?php foreach($fields as $field): ?>
                    <tr class="odd">  
                    <td>   
                     <?php echo $field['number'];?>
                    
                    <td>   
                        <?php echo $field['name'];?>
                    </td>
                    <td>   
                        <?php echo $field['description'];?>
                    </td>                  
                    <td>   
                        <?php echo $field['type'];?>
                    </td>                    
                    <td>   
                        <?php echo $field['valid'];?>
                    </td> 
                    <td>   
                        <?php echo ($field['required']==1)?'Yes':'No';?>
                    </td>        
                      
                  </tr>
        <?php endforeach ?>          
 <?php endif; ?>                  
 
           
            </tbody>
        </table>
 <?php endforeach ?>
    <?php endif; ?>