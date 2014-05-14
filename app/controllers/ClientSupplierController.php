<?php

class ClientSupplierController extends BaseController{
    public function __construct()
    {
        $this->beforeFilter('admin');
    }
    public function getIndex()
    {
        return 'ok';
    }
    public function getAdd()
    {
        $countries = new Country;
        return View::make('Clientsuppliers.add')
            ->with('country',$countries->getCountriesDropDown());
    }

    public function postSaveclientsuppliers()
    {
        $ruless = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|Unique:client_suppliers',

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('clientsuppliers/add')
                ->withErrors($validate);
        }
        else{
            $clientsuppliers = new ClientSupplier;

            $clientsuppliers->first_name  = Input::get('first_name');
            $clientsuppliers->last_name = Input::get('last_name');
            $clientsuppliers->email = Input::get('email');
            $clientsuppliers->phone = Input::get('phone');
            $clientsuppliers->company_name = Input::get('company_name');
            $clientsuppliers->address = Input::get('address');
            $clientsuppliers->country_id = Input::get('country_id');
            $clientsuppliers->sex = Input::get('sex');
            $group_id = Input::get('group_id');
            $clientsuppliers->group_id = $group_id;
            $clientsuppliers->status = 1;
            $clientsuppliers->save();
            if($group_id==1){
            Session::flash('message', 'Client has been Successfully Created.');
            return Redirect::to('clientsuppliers/clientlist/');
            }else{
            Session::flash('message', 'Supplier has been Successfully Created.');
            return Redirect::to('clientsuppliers/supplierlist/');
            }
        }
    }
    public function getUpdate($id)
    {
        $datas = ClientSupplier::find($id);
        $countries = new Country;
        return View::make('Clientsuppliers.update')
            ->with('data',$datas)
            ->with('country',$countries->getCountriesDropDown());
    }
    public function postCheckupdate($id)
    {
        $ruless = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|Unique:client_suppliers,email,'.$id

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('clientsuppliers/update/'.$id)
                ->withErrors($validate);
        }
        else{
            $user = ClientSupplier::find($id);

            $user->first_name  = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');

            $user->phone = Input::get('phone');
            $user->company_name = Input::get('company_name');
            $user->address = Input::get('address');
            $user->country_id = Input::get('country_id');
            $user->sex = Input::get('sex');
            $group_id = Input::get('group_id');
            $user->group_id =  $group_id;
            $user->status = 1;
            $user->save();
            if($group_id == 1)
            {
                Session::flash('message', 'Client has been Successfully Updated.');
                return Redirect::to('clientsuppliers/clientlist/');
            }
            else
            {
                Session::flash('message', 'Supplier has been Successfully Updated.');
                return Redirect::to('clientsuppliers/supplierlist/');
            }

        }
    }

    public function getClientlist()
    {
        $list = ClientSupplier::where('group_id' ,'=',1)
            ->where('status', '=', 1,'AND')
            ->get();
        //$listing = ClientSupplier::all();

        return View::make('Clientsuppliers.list')
            ->with('lists',$list);

    }
    public function getDeactiveclientlist()
    {
        $list = ClientSupplier::where('group_id' ,'=',1)
            ->where('status', '=', 0,'AND')
            ->get();
        return View::make('Clientsuppliers.list')
            ->with('lists',$list);

    }
    public function getSupplierlist()
    {
        $list = ClientSupplier::where('group_id' ,'=',2)
            ->where('status', '=', 1,'AND')
            ->get();

        return View::make('Clientsuppliers.list')
            ->with('lists',$list);
    }
    public function getDeactivesupplierlist()
    {
        $list = ClientSupplier::where('group_id' ,'=',2)
            ->where('status', '=', 0,'AND')
            ->get();

        return View::make('Clientsuppliers.list')
            ->with('lists',$list);
    }

    public function getDetails($id)
    {
        $clientsupplier = ClientSupplier::find($id);
        return View::make('Clientsuppliers.details')
            ->with('userdata',$clientsupplier);

    }
    public function getDelete($id)
    {
        $person = ClientSupplier::find($id);
        $person->delete();
        return Redirect::to('clientsuppliers/clientlist');
    }
    public function getStatusdeactive($id)
    {
        $status = 0;
        $clients = ClientSupplier::find($id);
        $clients->status = $status;
        $clients->save();
        if($clients->group_id == 1)
        {
            Session::flash('message', 'Client has been Successfully Deactivated.');
            return Redirect::to('clientsuppliers/clientlist/');
        }
        else
        {
            Session::flash('message', 'Supplier has been Successfully Deactivated.');
            return Redirect::to('clientsuppliers/supplierlist/');
        }


    }
    public function getStatusactive($id)
    {
        $status = 1;
        $clients = ClientSupplier::find($id);
        $clients->status = $status;
        $clients->save();
        if($clients->group_id == 1)
        {
            Session::flash('message', 'Client has been Successfully Activated.');
            return Redirect::to('clientsuppliers/clientlist/');
        }
        else
        {
            Session::flash('message', 'Supplier has been Successfully Activated.');
            return Redirect::to('clientsuppliers/supplierlist/');
        }

    }

}
