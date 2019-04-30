<?php
/**
 * Created by PhpStorm.
 * User: KD
 * Date: 9/24/2017
 * Time: 2:57 PM
 */

class TestCommand extends CConsoleCommand
{
    public function actionIndex() {
        self::loadClasses();
        $uom = new UomMaster();
        $uom->name = 'TEst CRON';
        $uom->save();
}
    public static function loadClasses()
    {
        Yii::import('application.models.*');
    }
}
