<div class="row">
    <div class="well-reqrap span11">
<h2>Getting Started with ReqRap</h2>    
    
</div>


<br />

<div class="span8">    

<div class="row well"> 
    <h4>Create a Project</h4> 
You will see on the home page after you have logged in a big green button.  Click this to create 
your first project.<br/>
All you need is a name and a description, but you can change them later, so don't agonise about
what to call you first project.<br/>
When the project creates, it will pre-load an Actor, and a Package just so you can see something.
You will see in the header there are four buttons "Project", "Model", "Walkthrough",
 "Testing" and "Print".
While you are building your model, only the first two will be active.<br>
The "Project" button takes you to the settings area, this is where you control your releases, 
to-do, collaborators, documents and notes.
<br />
The "Model" button takes you to your requirements model.  Here the seven major model components are
created, edited, and deleted where necessary.<br />

</div>
    
    <div class="row well"> 
    <h4>Import a Library Item</h4> 
ReqRap supports sharing of requirements models in a library.  You can have your own private 
library, and you can access models shared by others.  Importing a library item is a good way to see 
some well developed requirements.<br />

</div>

    <div class="row well-green">
<h4>Get it wrong - its part of the process</h4>
Iterative development is key to good requirements.  So just start going.  It will be wrong, but that's fine.
ReqRap makes it easy to change your requirements. You can re-name, delete, split, copy, combine, create relationships and break them.


</div>

    <div class="row well">
<h4>Create some Actors</h4>

Actors are people and systems that ‘act’ on the system we are designing.  A user who views a website by clicking links to retrieve different content is ‘acting’ on the system by clicking the links.  A user who receives an email from the system, on the other hand is not acting on the system, so they probably don’t need to be modelled as an actor.
Lets say a public user of a website, who we will call Public, and a user who has signed up for a membership, lets call them Member.
A member can do everything that a public user can do, so we define that the Member actor inherits the Public actor.
</p>
</div>




    
<div class="row well">
    <h4>Create some Use Cases</h4>
Use cases are simply things that the actors ‘want’ to do,  i.e. the motivation for 
the actor to be involved in the use case is internal to the actor.  It can be useful
to remember this as you decide if something is a use case or not.  In our example of
a website with Public and Member actors, we could guess at these use cases without much
thinking:<br/>
<strong>Public</strong>
    <ul>
        <li>
            Browse web pages
        </li>
        <li>
            Create a membership
        </li>
        <li>
            Verify email account
        </li>
    </ul>

<strong>Member</strong>
<ul>
    <li>Log In</li>
    <li>Update member profile</li>
    <li>Cancel Membership</li>
</ul>

You will notice that all use cases are named with a ‘strong verb statement’.  Use case names should not be wishy-washy or ambiguous.  A bad use case name might be ‘Manage details’, it really doesn’t mean much on its own, whereas ‘Update member profile’ is much clearer.  There is more to use cases than just their name, but at this point don’t worry about that.  Use cases can be roughly sorted them into a logical progression e.g. in the Public list of use cases above, no other order would really make sense.  Sorting them into a progression that makes a story helps requirements readers to understand more easily.
</p>
</div>

    
    
<div class="row well">

    <h4>Add Some Steps</h4>
Use Cases are a series of steps that allow the Actor to achieve the goal of the use case. 
<br/>
Open a Use Case and you will see that a step has been created already.  
Click the edit icon and edit the step.  Create relationships between the step and interfaces,
rules and forms. If the interfaces, rules and forms don't exist already, ReqRap will make a 'stub' 
for the object, that you can flesh out later.


</div>
     
<div class="row well">
<h4>Make A Release</h4>
The model version you are editing is a 'draft'.  In the 'Releases' tab of the 'Project' area 
you can select to finalise the draft and make a Release.  Don't worry, the draft is maintained 
and the Release is created as a snapshot.
</div>
 </div> 
        <div class="span4">
            <div class="well-green">
                <h4>Have a Question?</h4>
            </div>
             <div class="well">
       <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
               'id'=>'contact-form',
           'type'=>'horizontal',
               'enableClientValidation'=>true,
               'clientOptions'=>array(
                       'validateOnSubmit'=>true,
               ),
       )); ?>

               

            <?php echo $form->errorSummary($model); ?>

           <?php echo $form->textField($model,'name',array('value'=>'Name')); ?>

           <?php echo $form->textField($model,'email',array('value'=>'Email')); ?>

           <?php echo $form->textField($model,'subject',array('value'=>'Subject','size'=>60,'maxlength'=>128)); ?>

           <?php echo $form->textArea($model,'body',array('value'=>'Question','rows'=>6, 'class'=>'span3')); ?>

 <br/><br />
            <?php $this->widget('bootstrap.widgets.TbButton',array(
                   'buttonType'=>'submit',
                 'block'=>true,
                   'type'=>'success',
                   'label'=>'Send',
               )); ?>
         

       <?php $this->endWidget(); ?>

       <!-- form -->
       </div>
  </div>

</div>

