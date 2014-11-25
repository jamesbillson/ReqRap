<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); ?>

<h2>Add interface images</h2>
  
<a href="<?php echo Yii::app()->getBaseUrl();  ?>/photo/list/">View all images</a>

<?php if(isset($model->id)): ?>
   
     <div class="row-fluid">
         <div class="span11">
            <?php $photo = new Photo;
			


             ?>
<form action="<?php echo  Controller::createUrl("photo/upload",array('id'=>$model->id)); ?>"  class="dropzone" id="my-dropzone">

</form>
        </div>
    </div>
    
<div id="IfaceUpdateModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Update Iface" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Update Iface Info</h3>
  </div>
  <div class="modal-body">
  <form id="IfaceForm" method="post" action="<?php echo Yii::app()->getBaseUrl();  ?>/iface/update/ucid/-1/id/555">
   		<input type="hidden" name="Iface[photo_id]" id="IfacePhotoId" value="0" /> 
		<label class="required" for="Iface_name">Name <span class="required">*</span></label>
        <input type="text" value="Add Store" id="Iface_name" name="Iface[name]" maxlength="255" size="60">															 
  </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" id="saveIface" >Save changes</button>
  </div>
</div>    
    
<?php endif; ?>

<script type="text/javascript">
	//window.Dropzone({paramName:"Photo[file]"});
Dropzone.options.myDropzone = {
    init: function() {
      this.on("success", function(file, responseText) {

        // Create the remove button
		//alert(responseText[0].iface_id);
		var f_text=responseText[0].name.substr(0,10);
		var FileText = Dropzone.createElement('<span id="spanIName'+responseText[0].photo_id+'">'+f_text+'&nbsp;&nbsp;</span>');
        var removeButton = Dropzone.createElement('<a data-id="'+responseText[0].iface_id+'" data-content="'+responseText[0].name+'" data-photo="'+responseText[0].photo_id+'"><i title="" rel="tooltip" class="icon-edit" data-original-title="Edit Iface"></i></a>');


        // Capture the Dropzone instance as closure.
        var _this = this;

        // Listen to the click event
        removeButton.addEventListener("click", function(e) {
          // Make sure the button click doesn't submit the form:
          e.preventDefault();
		  iface_id=$(this).attr('data-id');
		  name=$(this).attr('data-content');
		  url= "<?php echo Yii::app()->getBaseUrl();  ?>/iface/update/ucid/-1/id/"+iface_id;
		  photo_id=$(this).attr('data-photo');
		  $("#IfaceForm").attr('action',url);
		  $("#Iface_name").val(name);
		  $("#IfacePhotoId").val(photo_id);
          //e.stopPropagation();
		  $("#IfaceUpdateModal").modal('show');	
          // Remove the file preview.
         // _this.removeFile(file);
          // If you want to the delete the file on the server as well,
          // you can do the AJAX request here.
        });

        // Add the button to the file preview element.
		 file.previewTemplate.appendChild(FileText);
        file.previewElement.appendChild(removeButton);
      });
    }
  };

    $(document).ready(function(){
			Dropzone.prototype.defaultOptions.paramName='Photo[file]';	
			Dropzone.prototype.defaultOptions.acceptedFiles='image/*';
			//Dropzone('.dropzone',{acceptedFiles:['jpeg','jpg','gif','png']});	
			// Dropzone.options.dropzone = {paramName:"Photo[file]",acceptedFiles:'image/*'};   
        $('.thumPro').hover(function(event){
            $(this).find('.delThumPro').show();
        },function(event){
            $(this).find('.delThumPro').hide();
        });

        $('.thumPro').not(':eq(0)').css('margin-left','0px');
        $('.thumPro').css('margin-right','10px');
		
		$("#saveIface").on('click',function(e){
								e.preventDefault();
								var photo_id=$("#IfacePhotoId").val();
								var f_name=$("#Iface_name").val();
								$("#spanIName"+photo_id).text(f_name.substr(0,10)+'  ');
								
								$('a[data-photo="'+photo_id+'"]').attr('data-content',f_name);
								url=$("#IfaceForm").attr('action');
								$.ajax({
									   type:'POST',
									   url:url,
									   data:$("#IfaceForm").serialize(),
									   success:function(data){
										   $("#IfaceUpdateModal").modal('hide');	
									   }
									   
									   
									   
									   });
								
											
											
						});
    })


</script>