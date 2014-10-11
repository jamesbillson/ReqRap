<h2> 
    <a href="<?php echo UrlHelper::getPrefixLink('/project/view/id/')?><?php echo $model->id; ?>/tab/documents">
        <?php echo $model->name; ?>
    </a>
    <a href="<?php echo UrlHelper::getPrefixLink('/project/update?id=')?><?php echo $model->id; ?>">
        <i class="icon-edit"></i>
    </a>
</h2>
    Budget: $<?php echo number_format($model->budget, 0, '.', ','); ?> <br />
  

 
 Link: <input type="text" value ="http://www.reqrap.com/project/extview/id/<?php echo $model->extlink; ?>" onclick="this.select()">
 <a href="<?php echo UrlHelper::getPrefixLink('/project/resetlink/id/')?><?php echo $model->id; ?>">Reset the link</a>
 
 <br /> 
 <?php $site = Addresses::model()->getAddressForProject($model->id); ?>

 <?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$site,
        'template' => "{items}",
	'itemView'=>'/addresses/_projectview',
)); ?> 
 <a href="<?php echo UrlHelper::getPrefixLink('/addresses/create/id/')?><?php echo $model->id; ?>/type/4">Add an address</a>
<br />
<b>Description</b><br /><?php echo $model->description; ?><br />


 