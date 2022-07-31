<?php
/**
 * User: k7brasil
 * Date: 30/07/2022
 * Time: 8:43 PM
 */
namespace app\controllers;


use k7brasil\microphp\Application;
use app\Controllers\BaseController;
use k7brasil\microphp\middlewares\AuthMiddleware;
use k7brasil\microphp\Request;
use k7brasil\microphp\Response;
use app\models\LoginForm;
use app\models\User;

/**
 * Class SiteController
 *
 * @author  K7 <@k7brasil>
 * @package app\controllers
 */
class SiteController extends BaseController
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function home()
    {
        return $this->render('home', [
            'name' => 'TheCodeholic'
        ]);
    }

    public function login(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody(), $request->getRouteParam('id'));
        echo '</pre>';
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                return 'Show success page';
            }

        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function profile()
    {
        return $this->render('profile');
    }

    public function profileWithId(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
    }
}
