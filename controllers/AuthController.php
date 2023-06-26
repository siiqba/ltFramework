<?php
namespace app\controllers;
use app\core\Controller;
//use app\core\Application;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request)
    {
        if($request->isPost())
        {
            $registerModel = new RegisterModel();
            echo "<pre>";
            var_dump($request->getBody());
            echo "</pre>";
            return "Handle submited data";
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}