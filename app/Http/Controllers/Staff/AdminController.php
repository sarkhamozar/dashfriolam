<?php namespace App\Http\Controllers\Staff;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Delivery;
use App\Order;
use DB;
use Validator;
use Redirect;
use Session;
class AdminController extends Controller {

	public $folder = "staff.";

	/*
	|------------------------------------------------------------------
	|Index page for login
	|------------------------------------------------------------------
	*/
	public function index()
	{
		return View($this->folder.'index',[

			
		'form_url' => Asset(env('staff').'/login')


		]);
	}

	public function login(Request $Request)
	{
		$chk = Delivery::where('phone',$Request->get('username'))->where('shw_password',$Request->get('password'))->first();

		if(isset($chk->id))
		{
			Session::put('staff',$chk->id);

			return Redirect(env('staff').'/home')->with('message','Welcome ! '.$chk->name);
		}
		else
		{
			return Redirect::back()->with('error','Opps! Invalid Login Details');
		}
	}

	public function home()
	{
		if(Session::has('staff'))
		{
			return View('staff.home',[

			'data'	=> Order::where('status',3)->where('d_boy',Session::get('staff'))->get()

			]);
		}
		else
		{
			return Redirect(env('staff'))->with('error','Please login to access this page');
		}
	}

	public function logout(Request $Request)
	{
		$Request->session()->forget('staff');

		return Redirect(env('staff'))->with('message','Logout Successfully.');

	}

	public function deliver($id)
	{
		if(Session::has('staff'))
		{
			$res 				= Order::find($id);
			$res->status 		= 4;
			$res->status_time	= date('d-M-Y')." | ".date('h:i:A');
			$res->save();

			return Redirect::back()->with('message','Order Delivered Successfully.');

		}
		else
		{
			return Redirect(env('staff'))->with('error','Please login to access this page');
		}
	}
}