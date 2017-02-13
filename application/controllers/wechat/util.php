<?php
/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/2/13
 * Time: 17:11
 */
class Util
{
    public static $TOKEN='dfmlgjchehe123';

    private function checkSignture()
    {
        $signture=$this->input->post_get('signature');
        $timestamp=$this->input->post_get('timestampt');
        $nonce=$this->input->post_get('nonce');

        $token=TOKEN;
        $tmpArr=array($token,$timestamp,$nonce);
        sort($tmpArr,SORT_STRING);

    }
}