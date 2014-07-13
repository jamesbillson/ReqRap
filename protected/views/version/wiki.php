<?php


$input=array(
    1=>array('id'=>1,'name'=>'Parent','parent'=>0,'level'=>0,'tree'=>0,'children'=>0,'node'=>''),
    2=>array('id'=>2,'name'=>'Parent2','parent'=>0,'level'=>0,'tree'=>0,'children'=>0,'node'=>''),
    3=>array('id'=>3,'name'=>'Child','parent'=>2,'level'=>0,'tree'=>0,'children'=>0,'node'=>''),
    4=>array('id'=>4,'name'=>'Sibling','parent'=>2,'level'=>0,'tree'=>0,'children'=>0,'node'=>''),
    5=>array('id'=>5,'name'=>'Grand Child','parent'=>4,'level'=>0,'tree'=>0,'children'=>0,'node'=>''),
    6=>array('id'=>6,'name'=>'Cousin','parent'=>1,'level'=>0,'tree'=>0,'children'=>0,'node'=>''),
    );
$number=count($input);
$success=1;

$tree=1;
$branches=array();
echo 'find the parent nodes and so define the trees<br>';
for($i=1;$i<=$number;$i++)
{
  if ($input[$i]['parent']==0)  
        {
        $input[$i]['level']=1; 
        $input[$i]['tree']=$tree;
        $input[$i]['node']=$tree;
        $branches[$input[$i]['tree']]=0;
        $tree++;
        }
}

for($i=1;$i<=$number;$i++)
{
  if ($input[$i]['parent']!=0)  
        {
        $parentNode=$input[$input[$i]['parent']];
        $input[$i]['tree']=$parentNode['tree'];
        }
}

$level=0;
$success=1;
while($success==1)
{
$level++;
$success=0;
   for($i=1;$i<=$number;$i++)
    {
        if ($input[$i]['parent']!=0) // not the top of the tree.
        {
         $parentNode=$input[$input[$i]['parent']];
         if ($parentNode['level']==$level)
             {
             $input[$i]['node']=$input[$input[$i]['parent']]['node'].'.'.$input[$input[$i]['parent']]['id'];
             $input[$i]['level']=$level+1;
             $success=1;
             $input[$input[$i]['parent']]['children']=1;
             if ($branches[$input[$i]['tree']]<$level+1) $branches[$input[$i]['tree']]=$level+1;
             }
         
        }
    }

}

?>

<pre>
<?php
print_r($input) ;
?>
</pre>
<pre>
<?php
print_r($branches) ;
?>
</pre>
Output<br />
<?php

 echo ' [ ';
$node=1;
$success=1;
$lastparent=0;
  foreach($branches as $branch) 
    {
$lastparent=$branch;
        echo $input[$branch]['name'];
        for($i=1;$i<=$number;$i++)
        {
        $node=explode(".",$input[$i]['node']);
        //print_r($node);
        $level = count($node);
        $parent= $node[$level-1];
        //if($parent!=$lastparent) echo "<br>new branch";
        if($parent == $lastparent) echo $input[$i]['name'].'<br>';
        echo 'level '.$level.', parent '.$parent.'<br>';
        
     
       }
        $lastparent=$parent;
  
        
    }
 echo '] ';

?>
