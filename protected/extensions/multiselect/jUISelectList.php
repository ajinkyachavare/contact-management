<?php
/*
 * Jquery UI select list widget with checkbox.
 *
 */
class jUISelectList extends CInputWidget
{
    public $id;
    public $name;
    public $model;
    public $attribute;
    public $data = array();
    public $selected = array();
    public $htmlOptions = array();
    public $type = 'multi',$options=array();
    public $debug=false;
    private $assetPath='application.extensions.multiselect.asset',$_assetsUrl;

    public function init()
    {
        if (is_object($this->model)) {
            if (!empty($this->attribute))
                throw new Exception('Attribute property is required!');
            if (empty($this->id))
                $this->id = CHtml::activeId($this->model, $this->attribute);
            if (empty($this->name))
                $this->name = CHtml::activeName($this->model, $this->attribute);
        } else {
            if (empty($this->id))
                $this->id = uniqid();
            if (empty($this->name))
                throw new Exception('Name is required');
        }
    }

    public function run()
    {
        $this->htmlOptions['multiple'] = 'multiple';
        if (is_object($this->model))
            echo CHtml::activeDropDownList($this->model, $this->attribute, $this->data, $this->htmlOptions);
        else {
            if (!isset($this->htmlOptions['id']))
                $this->htmlOptions['id'] = $this->id;
            else
                $this->id = $this->htmlOptions['id'];
            echo CHtml::dropDownList($this->name, $this->selected, $this->data, $this->htmlOptions);
        }
        //Require jquery ui
        Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->clientScript->getCoreScriptUrl().
                '/jui/css/base/jquery-ui.css'
        );
        switch ($this->type) {
            case 'multi':
                $base_url = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->assetPath));
                $cs = Yii::app()->clientScript;
                $cs->registerCssFile($base_url . '/css/jquery.multiselect.css');
                $cs->registerScriptFile($base_url . '/js/jquery.multiselect.min.js', CClientScript::POS_END);
                $cs->registerScriptFile($base_url . '/js/jquery.multiselect.filter.js', CClientScript::POS_END);
                $cs->registerScript(uniqid(), '
                    $("#' . $this->id . '").multiselect().multiselectfilter();;
                ');
                break;
            case 'transfer':
                if($this->debug)
                {
                    $base_url = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->assetPath),false, -1, true);
                }
                else
                {
                    $base_url = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->assetPath));
                }

                $cs = Yii::app()->clientScript;
                $cs->registerCssFile($base_url . '/css/ui.multiselect.css');
                $cs->registerScriptFile($base_url . '/js/ui.multiselectEx.js', CClientScript::POS_END);
                $options='';
                if(is_array($this->options))
                {
                    $arr=array();
                    foreach($this->options as $key=>$val)
                    {
                        $arr[]=$key.':'.$val;
                    }
                    $options=implode(',',$arr);
                }
                $cs->registerScript(uniqid(), '
                    $("#' . $this->id . '").multiselect({'.$options.'});
                ');
                break;
        }
    }

}