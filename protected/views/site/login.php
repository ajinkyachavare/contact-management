<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<style>
    div.login{
        position: relative;
        margin: 0 auto;
        /* padding: 20px 20px 20px; */
        width: 385px;
        background: white;
        border-radius: 3px;
        -webkit-box-shadow: 0 0 200px rgba(255, 255, 255, 0.5), 0 1px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0 0 200px rgba(255, 255, 255, 0.5), 0 1px 2px rgba(0, 0, 0, 0.3);
    }
    #LoginForm_password {
        background-position: 5px -52px !important;
    }
    div.login input[type=submit]{
        padding: 0 18px;
        height: 29px;
        font-size: 12px;
        font-weight: bold;
        color: #527881;
        text-shadow: 0 1px #e3f1f1;
        background: #cde5ef;
        border: 1px solid;
        border-color: #b4ccce #b3c0c8 #9eb9c2;
        border-radius: 16px;
        outline: 0;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        background-image: -webkit-linear-gradient(top, #edf5f8, #cde5ef);
        background-image: -moz-linear-gradient(top, #edf5f8, #cde5ef);
        background-image: -o-linear-gradient(top, #edf5f8, #cde5ef);
        background-image: linear-gradient(to bottom, #edf5f8, #cde5ef);
        -webkit-box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
        box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);

    }
    .login h2 {
        /*   margin: -20px -20px 21px;
           line-height: 40px;*/
        text-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0px 2px 0 rgba(0, 0, 0, .5);
        text-transform: uppercase;
        font-size: 30px;
        /*font-weight: bold;*/
        color: #555;
        text-align: center;
         height: 41px;
        text-shadow: 0 1px white;
        background: #f3f3f3;
        border-bottom: 1px solid #cfcfcf;
        border-radius: 3px 3px 0 0;
        background-image: -webkit-linear-gradient(top, whiteffd, #eef2f5);
        background-image: -moz-linear-gradient(top, whiteffd, #eef2f5);
        background-image: -o-linear-gradient(top, whiteffd, #eef2f5);
        background-image: linear-gradient(to bottom, whiteffd, #eef2f5);
        -webkit-box-shadow: 0 1px whitesmoke;
        box-shadow: 0 1px whitesmoke;
    }

    #inputs input{
        background: #FFFFFF url('images/login-sprite.png') no-repeat;
        padding: 15px 15px 15px 30px;
      /*  margin: 0 0 10px 0;*/
        width: 297px;
        border: 1px solid #ccc;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
        -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
        box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    }
    
     .content{
        min-height: 660px;
    }
    .login-form{
        padding-top: 120px;
        text-align: center;
    }
    /* added content for full screen */
    </style>

<div class="form login-form">
<div class="login">
    <h2>Login</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<div class="row">
        <fieldset id="inputs">
		<?php echo $form->textField($model,'username',array('placeholder'=>'Username')); ?>
        </fieldset>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
        <fieldset id="inputs">
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
        </fieldset>
		<?php echo $form->error($model,'password'); ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>
    <?php echo CHtml::link("Sign Up" , array("/UserMaster/create")); ?>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
