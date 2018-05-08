<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 10:04 AM
 */

namespace studentform\controller;


class StudentController extends Controller
{
    public function indexAction()
    {
        session_start();
        $this->showView('StudentIndex');

        $model = new Model();
        $model->createTables();
    }
}