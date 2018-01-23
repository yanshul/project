<?php

namespace App\Http\Controllers;

use App\mention;
use Illuminate\Http\Request;
use App\User;
use App\twte;
use App\follow;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function index()
     {
         return view('home');
     }*/
    public function showWelcome()
    {
        
        return View::make('hello');
    }

    public function showLogin()
    {
        // show the form
        return View::make('auth/login');
    }

    public function show()
    {
        // show the form

        return view('greeting');
    }

    public function tweetgo(Request $request)
    {
        $responce=[];

        $responce['name']= session('name');
        $responce['email']=session('email');
        $responce['password']=session('psw');
        //$users = User::where(['name'=>$responce['name'],'password'=>$responce['password']])->first();

        //$responce['id']=$users->id;

        //echo($responc['id']);
        //session(['id'=>$users->id]);
        //session(['name'=>$users->name]);
        //session(['password'=>$users->password]);
        //$na = twte::where(['name'=>$responce['name']]);

        return view('tweet')->with('responce',$this->table($responce));
        //$responce['data']=array($dta);
        //echo $responce['data'][0];
    }


    public function table($responce)
    {
        $x=new twte();
        $na = $x::all();
        $count=twte::count();
        $i=1;
        $na1 = follow::all();;
        $count1=follow::all()->count();

        $na2 = mention::all();
        $count2=mention::count();

        $responce['count']=$count;
        $responce['data']= $na;
        $responce['count1']=$count1;
        $responce['data1']= $na1;
        $responce['count2']=$count2;
        $responce['data2']= $na2;

        return ($responce);
    }




    public function login(Request $request)
    {
        $responce=[];
        $responce['name'] = $request->input('uname');
        $responce['password']=$request->input('psw');


        $users = User::where(['name'=>$responce['name'],'password'=>$responce['password']])->first();

        //$responce['id']=$users->id;
        if($users==NULL)
        {
            echo "your password is wrong";
            return view('greeting');
        }
        session(['name'=>$users->name]);
        session(['email'=>$users->email]);
        session(['psw'=>$users->password]);
        $responce['password']=$users->email;

        return view('tweet')->with('responce',$this->table($responce));
        //$responce['data']=array($dta);
        //echo $responce['data'][0];
    }
    public function follow(Request $request,$name)
    {

        $responce=[];
        // $responce['search']=$request->input('search');
        // $responce['search']=$search;


        $responce['name']= session('name');
        $responce['email']=session('email');
        $responce['password']=session('psw');
        //$users = User::where(['name'=>$responce['search']]);
        $flight = new follow;

        // $flight->msgid=$responce['email'];
        $flight->name=$responce['name'];
        $flight->name1=$name;
        $flight->save();

        return view('tweet')->with('responce',$this->table($responce));
        //$responce['data']=array($dta);
        //echo $responce['data'][0];
    }
    public function search(Request $request)
    {
        //echo $search;
        $responce=[];
        $responce['search']=$request->input('search');
        // $responce['search']=$search;


        $responce['name']= session('name');
        $responce['email']=session('email');
        $responce['password']=session('psw');

        //$users = User::where(['name'=>$responce['search']]);
        $users = User::all();
        $count=User::count();
        $responce['users']=$users;
        $responce['count']=$count;


        return view('search')->with('responce',$responce);
        //$responce['data']=array($dta);
        //echo $responce['data'][0];
    }
    public function tweetsave(Request $request)
    {
        $responce=[];
        $responce['tweet'] = $request->input('tweet');
        // $responce['password']=$request->input('psw');


        //$users = User::where(['name'=>$responce['name'],'password'=>$responce['password']])->first();

        $responce['name']=session('name');
        $responce['email']=session('email');
        $responce['password']=session('psw');

        //echo($responce['name']);
        $flight = new twte;

        // $flight->msgid=$responce['email'];
        $flight->name=$responce['name'];
        $flight->tweet=$responce['tweet'];
        $flight->save();


        //dd($responce['tweet']);
        //$chars = preg_split('//', $responce['tweet'], -1, PREG_SPLIT_NO_EMPTY);
        $a = $responce['tweet'];
        $users = twte::where(['name'=>$responce['name'],'tweet'=>$responce['tweet']])->first();
        $id=$users->msgid;
        $x=explode(" ",$a);
        $array_count=count($x);
        for ($i=0;$i<$array_count;$i++)
        {
            if((strrchr($x[$i],"@"))and (str_replace("@","",$x[$i])!=$responce['name']))
            {
                $flight = new mention();
                $flight->name=str_replace("@","",$x[$i]);
                $flight->msgid=$id;
                $flight->save();
            }
        }

        return view('tweet')->with('responce',$this->table($responce));
    }

    public function show2(Request $request)
    {
        session(['name'=>$request->uname]);
        session(['email'=>$request->Email]);
        session(['psw'=>$request->psw]);
        // show the form
        $responce=[];
        $responce['name'] = $request->input('uname');
        $responce['email'] = $request->input('Email');
        $responce['password']=$request->input('psw');

        $flight = new User;

        $flight->name = $responce['name'];
        $flight->email=$responce['email'];
        $flight->password=$responce['password'];
        $flight->save();



        return view('tweet')->with('responce',$this->table($responce));
        //return view('tweet')->with('responce',$responce);
        // return view('hell')->with('responce', $responce);
    }

    public function show3(Request $request)
    {

        $responce= session('name');
//        $responce['key']=$request->session()->put('name',$responce['name']);
        $value = 0;

        //$request->session()->get('uname');
        return view('hell1')->with('responce', $responce);
    }

    public function doLogin()
    {

        $userdata = array(
            'email' 	=> Input::get('email'),
            'password' 	=> Input::get('password'));
        //       );

        // attempt to do the login
        if (Auth::attempt($userdata)) {

            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
            echo 'SUCCESS!';
            echo $userdata;

        } else {

            // validation not successful, send back to form
            return Redirect::to('login');

        }

        //}
    }

    public function Categories(Request $request)
    {
        $text = $request->input('tweet');
        return $text;
    }
}
