<?php
namespace app\controllers;
use app\core\Controller;
//use app\core\Application;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Jakiś User"
        ];
        // return Application::$app->router->renderView('home', $params);
        return $this->render('home',  $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();

        // var_dump($body);
        return 'Heandling submited data';
    }

}
?>
