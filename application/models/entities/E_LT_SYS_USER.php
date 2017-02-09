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
    public $USER_SALT;
    public $USER_EMAIL;
    public $USER_MOBILE;
    public $USER_NICKNAME;
    public $USER_CREATEDATE;


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

    /**
     * @return mixed
     */
    public function getUSERSALT()
    {
        return $this->USER_SALT;
    }

    /**
     * @param mixed $USER_SALT
     */
    public function setUSERSALT($USER_SALT)
    {
        $this->USER_SALT = $USER_SALT;
    }

    /**
     * @return mixed
     */
    public function getUSERCREATEDATE()
    {
        return $this->USER_CREATEDATE;
    }

    /**
     * @param mixed $USER_CREATEDATE
     */
    public function setUSERCREATEDATE($USER_CREATEDATE)
    {
        $this->USER_CREATEDATE = $USER_CREATEDATE;
    }

    /**
     * @return mixed
     */
    public function getUSEREMAIL()
    {
        return $this->USER_EMAIL;
    }

    /**
     * @param mixed $USER_EMAIL
     */
    public function setUSEREMAIL($USER_EMAIL)
    {
        $this->USER_EMAIL = $USER_EMAIL;
    }

    /**
     * @return mixed
     */
    public function getUSERMOBILE()
    {
        return $this->USER_MOBILE;
    }

    /**
     * @param mixed $USER_MOBILE
     */
    public function setUSERMOBILE($USER_MOBILE)
    {
        $this->USER_MOBILE = $USER_MOBILE;
    }

    /**
     * @return mixed
     */
    public function getUSERNICKNAME()
    {
        return $this->USER_NICKNAME;
    }

    /**
     * @param mixed $USER_NICKNAME
     */
    public function setUSERNICKNAME($USER_NICKNAME)
    {
        $this->USER_NICKNAME = $USER_NICKNAME;
    }


}