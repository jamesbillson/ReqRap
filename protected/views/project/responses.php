//PROJECT / VIEW
<h1><?php echo $model->company->name; ?></h1>
<h2><?php echo $model->name; ?>
  <a href="/project/update?id=<?php echo $model->id; ?>">
          <i class="icon-cog"></i>
      </a></h2>


<h3>Tender Response</h3>
A list of all the responses from a tenderer.<br />
<br />
 The answers are then visible to the project owner (PM)  <br />  
  <br />  
   <br />  

    <?php 
$data = Tenderqs::model()->tenderResponse($model->id,$resp);

if (count($data))  // some questions have answers
{
$pcsum=0;
$pricesum=0;
$groupstatus=array();
 foreach ($data as $item) {
$pcsum = ($item['type']==2)?$pcsum + $item['content'] :$pcsum ;
$pricesum = ($item['type']==3)?$pricesum + $item['content'] :$pricesum ;
 array_push($groupstatus, $item['status']);          
 }
 $statuses = array_count_values($groupstatus);// count up the number of response statuses
 echo ''.count($groupstatus).' tender response questions.';
 if (isset ($statuses[0])) echo '<br />'.Tenderans::$status[0].' : '.$statuses[0];
 if (isset ($statuses[1])) echo '<br />'.Tenderans::$status[1].' : '.$statuses[1];
 if (isset ($statuses[2]))echo '<br />'.Tenderans::$status[2].' : '.$statuses[2];
 if (isset ($statuses[3])){
     echo '<br />'.Tenderans::$status[3].' : '.$statuses[3].'<br />';
    if ($statuses[3]==count($groupstatus)) {
             
                $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Submit Tender',
                        'url'=>'/project/tendersubmit?id='.$model->id,
                        'type' => 'success',
                        'size' => 'large'
                ));
                    }
 }
 echo '<br />';
                  

 
echo 'PC SUM total $'.number_format($pcsum, 0, '.', ',').'<br />';
echo 'Price Total $'.number_format($pricesum, 0, '.', ',');

}

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Tender Requirements',
	'headerIcon' => 'icon-gift',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       
	

)); 
if (count($data) ):?>

<table class="table">
	<thead>
	<tr>
		<th>Sequence</th>
                <th>Name</th>
		 <th>Answer</th>

                 <th>Actions</th>

	</tr>
	</thead>
        <tbody>

            
        <?php foreach($data as $item) 
         {?>
        <tr class="odd">  
 
                       <td>
      <?php echo $item['sequence'];?> 
      </td> 
            <td>   
        <b><?php echo $item['name'];?></b> (<?php echo Tenderqs::$shorttype[$item['type']];?> ) <br />

      <?php echo $item['description'];?> 
      </td>

 
            <td style="text-align:right;">
                <?php if($item['type']==1)
      {     echo $item['content']; 
      }else{
            echo '$ '.number_format($item['content'], 0, '.', ',');
      } ?> 
      </td> 
      <td>
        
      </td>
      <td>
          
     
       <?php    
      if($item['status']==4) // THE QUSTION IS NOT ANSWERED
      {
      ?>
      What to do      <?php 
      }   
      ?>
       </td>
        </tr>
        
          <?php 
      }   
      ?> 

        
        
        
        
   	</tbody>
</table>

<?php
endif; // end count of results
$this->endWidget();

   ?>




    

    
<script  type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('h3 a.btn-small').each(function(){
          jQuery(this).parent().after('<div class="formadd"></div>');
      });
      jQuery('h3 a.btn-small').click(function(){
          jQuery(this).parent().next().load(this.href);
          return false;
      });
    });
</script>