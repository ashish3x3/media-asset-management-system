<?php

class FileController extends Controller
{
    public $layout = '//layouts/column2';
	public function actionIndex()
    {
		$this->render('index', array());
	}
}
