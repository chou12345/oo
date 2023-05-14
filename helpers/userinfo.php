<?php

function getUserInfo()
{
    return new UserInfo($_SESSION);
}

class UserInfo
{
    public $account;
    public $accountId;
    public $identity;
    public $identityId;
    public $name;
    public $nickname;
    public $phone;
    public $email;
    public $bankAccount;
    public $publicKey;
    public $privateKey;


    public function __construct($_session)
    {
        $this->account = $_session['user_info']['account'];
        $this->accountId = $_session['user_info']['account_id'];
        $this->name = $_session['user_check_info']['name'];
        $this->nickname = $_session['user_check_info']['nickname'];
        $this->phone = $_session['user_check_info']['phone'];
        $this->email = $_session['user_check_info']['email'];
        $this->bankAccount = $_session['user_check_info']['bank_account'];
        $this->publicKey = $_session['user_check_info']['public_key'];
        $this->privateKey = $_session['user_check_info']['private_key'];

        $identity = $_session['user_info']['identity'];

        if ($identity === '管理者') {
            $this->identity = 'manager';
            $this->identityId = $_session['user_check_info']['manager_id'];
        } else if ($identity == '商家') {
            $this->identity = 'merchant';
            $this->identityId = $_session['user_check_info']['merchant_id'];
        } else {
            $this->identity = 'general';
            $this->identityId = $_session['user_check_info']['general_id'];
        }

    }
}
?>