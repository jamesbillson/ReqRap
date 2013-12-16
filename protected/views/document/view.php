<h1>Document "<?php echo $document->name ?>" </h1>
<?php 
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>array(/*'Admin'=>Yii::app()->createUrl("/site/admin"),*/'Document-Version'))); ?>

<?php    
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->searchDocument($id),
        'filter'=>$model,
        'template'=>"{items}\n{pager}",
        'columns'=>array(
            array(
                'name'=>'doc_parent',
                'type'=>'raw',
                'value'=>'isset($data->document->name)?$data->document->name:""',
                'header'=>'Document'
            ),
            'version',
            'file',
            array(
                'name'=>'user',
                'type'=>'raw',
                'value'=>'isset($data->modified0->username)?$data->modified0->username:""',
                'header'=>'User'
            ),
            'modified_date',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 60px'),
                'template'=>'{view}{download}{update}{delete}',
                'buttons'=>array(
                    'view' => array(
                        'url'=>'Yii::app()->createUrl("/documentversion/view",array("id"=>$data->id));'
                    ),
                    'update'=> array(
                        'url'=>'Yii::app()->createUrl("/documentversion/update",array("id"=>$data->id));'
                    ),
                    'delete'=>array(
                        'url'=>'Yii::app()->createUrl("/documentversion/delete",array("id"=>$data->id));'
                    ),
                    'download' => array(
                        'icon'=>'icon-download-alt',
                        'url'=>'Yii::app()->createUrl("documentversion/download", array("id"=>$data->id))',
                    ),
                ),
            ),
        ),
    ));  
?>