<?php
/**
 * User: k7brasil
 * Date: 30/07/2022
 * Time: 8:43 PM
 */
namespace app\controllers;

use app\Controllers\BaseController;

/**
 * Class AboutController
 *
 * @author  K7 <@k7brasil>
 * @package app\controllers
 */
class AboutController extends BaseController
{
    public function index()
    {
        return $this->render('about');
    }
}