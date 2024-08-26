<?php
namespace App\Libraries;

class SessionManager
{
    public function setSessionInq($value)
    {
        session()->set('sessionInq', $value);
    }

    public function getSessionInq()
    {
        return session()->get('session1');
    }
}