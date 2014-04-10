<?php


class UserController extends BaseController {
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
            if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password'))))
            {
                Session::put('email',$email);
                Session::flash('message', 'User has been Successfully Login.');
                return    Redirect::to('users/userlist/');
            }
            else
            {
                return   Redirect::to('users/index');
            }
        }
    }
    public function getAdd()
    {
   // return View::make('Users.add');
        $countries = new Country;

        return View::make('Users.add')
            ->with('country', $countries->getCountriesDropDown());
    }

    public function getUserlist()
    {
        $user = User::all();

        return View::make('Users.list')
            ->with('users',$user);
    }

    public function getLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/');
    }


    public function postSaveuser()
    {

        $ruless = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'email' =>  'required|email|unique:users',
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

    public function putCheckupdate($id)
    {
        $ruless = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|unique:users,email,'.$id

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
    public function getUpdate($id)
    {
        $countries = new Country;
        $user = User::find($id);
        return View::make('Users.update')
            ->with('userdata',$user)
            ->with('country', $countries->getCountriesDropDown());

    }
    public function getDetails($id)
    {
        $user = User::find($id);
        return View::make('Users.details')
            ->with('userdata',$user);

    }

    public function deleteDestroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('message', 'User has been Successfully Deleted.');
        return Redirect::to('users/userlist');
    }
    public function getDelete($id)
    {
        $usertype = User::find($id);
        $usertype->delete();
        Session::flash('message', 'User has been Successfully Deleted.');
        return Redirect::to('users/userlist');
    }

}
