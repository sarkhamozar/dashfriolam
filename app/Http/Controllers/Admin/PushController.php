<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\City;
use App\Admin;
use App\AppUser;
use DB;
use Validator;
use Redirect;
use IMS;
class PushController extends Controller {

	public $folder  = "admin/push.";

	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{
		$citys = new City;
		$admin = new Admin;
		if ($admin->hasperm('Notificaciones push')) {
		return View($this->folder.'index',[
			'form_url' => Asset(env('admin').'/push'),
			'citys'	   => $citys->getAll(0),
			'array'    => [],
            'admin'    => $admin
			]);
		} else {
			return Redirect::to(env('admin').'/home')->with('error', 'No tienes permiso de ver la sección Notificaciones push');
		}
	}

	public function send(Request $Request)
	{
		$citys = $Request->get('citys');

		$img = null;
		if($Request->has('img'))
		{
			$filename = time().rand(111,699).'.' .$Request->file('img')->getClientOriginalExtension();
            $Request->file('img')->move("upload/push/",$filename);
            $img = Asset('upload/push/'.'/'.$filename);
		}

		if(in_array('all',$citys)){
			$this->sendPush($Request->get('title'),$Request->get('desc'),0,$img);
        } else {
            foreach($citys as $city) {
                $user = AppUser::where('last_city', $city)->get();

                foreach($user as $us) {
					$this->sendPush($Request->get('title'),$Request->get('desc'),$us->id,$img);
                    echo $us->id.' - '.$us->name.'<br />';
                }
            }
        }

		return Redirect::back()->with('message','Notifications sent Successfully.');
	}
}
