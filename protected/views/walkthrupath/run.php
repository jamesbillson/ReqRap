
<h4>Approver's comments</h4>
 <div class="row offset1">
<form action="/walkthrupath/run/" method="POST" name="Walkthruresult">
	 <div class="row">
	 <select name="result">
        <?php foreach (Walkthruresult::$result as $key=>$result) { ?>
            <option value="<?php echo $key; ?>"><?php echo $result; ?></option>
        <?php } ?>
        </select>
	</div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="row">
            <input type="text" name="comments">
	</div>

	<div class="row buttons">
            <input type="submit" value="Comment">
    </div>
</form>
</div>





<?php 

// Display all the existin comments.

$data= Walkthruresult::model()->findAll('walkthrupath_id='.$id);
 if (count($data)):

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Results',
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
  
));?>

        
            


        <table class="table">

               <thead>
                <tr>
                     <th>Result</th>                   
                    <th>Comments</th>
                    <th>Approver</th>

                </tr>
            </thead>
            
            <tbody>
         
            <?php foreach($data as $item):?>
                <tr class="odd">  
                   

                    <td>   
                        <?php echo Walkthruresult::$result[$item->result];?>
                    </td>                  
                                 <td>   
                        <?php echo $item->comments;?>
                    </td>  
                    <td>
                    <?php echo $item->user->firstname;?> 
                    <?php echo $item->user->lastname;?>
                    <?php echo $item->date;?>
                    </td>  
                  
              



</div>      
                           
            
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

     <?php
$this->endWidget(); 
endif;?>

