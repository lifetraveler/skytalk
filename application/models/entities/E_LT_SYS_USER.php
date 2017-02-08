<?php
/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/2/6
 * Time: 14:57
 */
class E_LT_SYS_USER
{
    public $USER_ID;
    public $USER_NAME;
    public $USER_PWD;

    /**
     * User constructor.
     * @param $USER_ID
     * @param $USER_NAME
     * @param $USER_PWD
     */

    /**
     * @return mixed
     */
    public function getUSERID()
    {
        return $this->USER_ID;
    }

    /**
     * @param mixed $USER_ID
     * @return User
     */
    public function setUSERID($USER_ID)
    {
        $this->USER_ID = $USER_ID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUSERNAME()
    {
        return $this->USER_NAME;
    }

    /**
     * @param mixed $USER_NAME
     * @return User
     */
    public function setUSERNAME($USER_NAME)
    {
        $this->USER_NAME = $USER_NAME;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUSERPWD()
    {
        return $this->USER_PWD;
    }

    /**
     * @param mixed $USER_PWD
     * @return User
     */
    public function setUSERPWD($USER_PWD)
    {
        $this->USER_PWD = $USER_PWD;
        return $this;
    }


}