<?php

class MainController extends BaseController {

	protected $layout = 'layouts.master';

	public function getIndex()
	{
		View::share('title', 'Email Builder');
		$this->layout->content = View::make('main');
	}

	public function getManage()
	{
		View::share('title', 'Manage');
		$this->layout->content = View::make('manage');
	}

	public function getNewBlock()
	{
		View::share('title', 'New Block');
		$this->layout->content = View::make('new-block');
	}

}
