<?php namespace App\Controllers;

class Dashboard extends BaseController
{
	
	public function index()
	{
		if(!$this->session->get('islogin'))
		{
			return view('view_login');
		}
		
		return view('view_dashboard');
	}
	
	//--------------------------------------------------------------------

}
