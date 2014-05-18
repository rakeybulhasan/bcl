<?php

class UserController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth',array('only' => array('getAdd','getUserlist','getUsertypeadd','postSaveuser','getDetails','getUpdate','putCheckupdate','getStatusdeactive','getStatusactive')));
    }
    public function getIndex()
    {

        return View::make('login.index');
    }
    public function postChecklogin()
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        $validate = Validator::make(Input::all(),$rules);
        if($validate->fails())
        {
            return Redirect::to('users/index');
        }
        else{
            $email = Input::get('email');
            if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password'),'status' => 1)))
            {
                $user = User::where('email','=',$email)->get();
                Session::put('user_type',$user[0]->group_id);
                $id = $user[0]->id;
                Session::put('created_by',$id);
                Session::put('user_id',$id);

                Session::flash('message', 'User has been Successfully Login.');
                return    Redirect::to('users/userlist');
            }
            else
            {
                Session::flash('message', 'Your username or password incorrect');
                return   Redirect::to('users/index');
            }
        }
    }

    public function getAdd()
    {
        $countries = new Country;
        return View::make('Users.add')
            ->with('country', $countries->getCountriesDropDown());

    }
    public function getUsertypeadd()
    {
        return View::make('UserTypes.add');

    }
    public function getUserlist()
    {

        $user = User::where('status' , '=', 1)
            ->get();
        return View::make('Users.list')
            ->with('users',$user);
    }
    public  function getDeactivelist()
    {
        $list = User::where('status', '=', 0)
            ->get();
        return View::make('Users.list')
            ->with('users',$list);
    }
    public function getLogout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/');
    }


    public function postSaveuser()
    {
        $ruless = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'email' =>  'required|email|unique:users|Unique:users',
            'password' => 'required'
        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('users/add')
                ->withErrors($validate);
        }
        else{
            $user = new User;

            $user->first_name  = Input::get('firstname');
            $user->last_name = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->phone = Input::get('phone');
            $user->company_name = Input::get('company_name');
            $user->address = Input::get('address');
            $user->country_id = Input::get('country_id');
            $user->sex = Input::get('sex');
            $user->group_id = Input::get('group_id');
            $user->status = 1;
            $user->save();
            Session::flash('message', 'User has been Successfully Created.');
            return Redirect::to('users/userlist/');
        }
    }
    public function getUpdate($id)
    {
        $countries = new Country;
        $user = User::find($id);
        return View::make('Users.update')
            ->with('userdata',$user)
            ->with('country', $countries->getCountriesDropDown());


    }

    public function putCheckupdate($id)
    {
        $ruless = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|Unique:users,email,'.$id

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('users/update/'.$id)
                ->withErrors($validate);
        }
        else{
            $user = User::find($id);

            $user->first_name  = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');

            $user->phone = Input::get('phone');
            $user->company_name = Input::get('company_name');
            $user->address = Input::get('address');
            $user->country_id = Input::get('country_id');
            $user->sex = Input::get('sex');
            $user->group_id = Input::get('group_id');
            $user->status = 1;
            $user->save();
            Session::flash('message', 'User has been Successfully Updated.');
            return Redirect::to('users/userlist/');
        }
    }

    public function getProfile($id)
    {
       // echo 'ok';exit;
        $countries = new Country;
        $user = User::find($id);
        return View::make('Users.profile')
            ->with('userdata',$user)
            ->with('country', $countries->getCountriesDropDown());
    }

    public function putCheckmyprofile($id)
    {
        $ruless = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|Unique:users,email,'.$id

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('users/update/'.$id)
                ->withErrors($validate);
        }
        else{
            $user = User::find($id);

            $user->first_name  = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');

            $user->phone = Input::get('phone');
            $user->company_name = Input::get('company_name');
            $user->address = Input::get('address');
            $user->country_id = Input::get('country_id');
            $user->sex = Input::get('sex');
            $user->group_id = Input::get('group_id');
            $user->status = 1;
            if(Input::get('new_password')!= '' && (Input::get('new_password') == Input::get('confirm_password')))
            {
                $user->password = Hash::make(Input::get('new_password'));
            }

            $user->save();
            Session::flash('message', 'User has been Successfully Updated.');
            return Redirect::to('users/userlist/');
        }
    }


    public function getDetails($id)
    {
        $user = User::find($id);
        return View::make('Users.details')
            ->with('userdata',$user);

    }
    public function getStatusdeactive($id)
    {
        $status = 0;
        $user = User::find($id);
        $user->status = $status;
        $user->save();
        Session::flash('message', 'User has been Successfully Deactivated.');
        return Redirect::to('users/userlist/');

    }public function getStatusactive($id)
{
    $status = 1;
    $user = User::find($id);
    $user->status = $status;
    $user->save();
    Session::flash('message', 'User has been Successfully Activated.');
    return Redirect::to('users/userlist/');

}


}



