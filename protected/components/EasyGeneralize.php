<?php
/**
 * Created by PhpStorm.
 * User: KD
 * Date: 12/9/15
 * Time: 8:48 PM
 */

final class EasyGeneralize{

    public static function dateFormat($date)
    {
        return date_format(date_create($date), "d/m/Y");
    }
    public static function showDate($date)
    {
        return date_format(date_create($date), "d M, Y");
    }
    public static function getSalt(){
        return 'sa12312dsadaxsxass234asa';
    }
    public static function getPepper(){
        return 'ghfaklfsnas3423ln';
    }
    public static function encryptKey($key=null){
        if($key==null)
            return false;
        $salt=self::getSalt();
        $pepper=self::getPepper();
        $encKey=base64_encode($salt.$key.$pepper);
        return $encKey;
    }
    public static function decryptKey($key=null){
        if($key==null)
            return false;

        $decKey=base64_decode($key);
        $salt=self::getSalt();
        $pepper=self::getPepper();
        $key=str_replace($salt,'',$decKey);
        $key=str_replace($pepper,'',$key);
        return $key;
    }
}