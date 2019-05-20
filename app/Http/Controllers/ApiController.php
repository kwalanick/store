<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //laravel passport
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login']]);
    }

    //php artisan migrate
    //php artisan passport:install


    //grant_type
    //client_id
    //client_secret
    //username
    //password



    public function create_customer(Request $request)
    {
        $validator = Validator::make($request->all(),
            [

                'name'=>'required|min:5',
                'phone'=>'required|unique:customers|regex:/(^(\+2547)[0-9]{8}$)/u',
                'address'=>'required',
                'email'=>'required|email',

            ]
        );
        if($validator->fails())
        {

            return $this->sendResponse($validator->errors(),422);

        }

        $customer = Customer::create($request->all());

        return $this->sendResponse($customer,200,true);



    }

    public function create_order(Request $request)
    {

        $validator = Validator::make($request->all(),
            [

                'customer_id'=>'required|numeric',
                'user_id'=>'required|exists:users,id'


            ]
        );
        if($validator->fails())
        {

            return $this->sendResponse($validator->errors(),422);

        }

        $order = Order::create([

            'customer_id'=>$request->customer_id,
            'user_id'=> $request->user_id,
            'total'=>0

        ]);


        return $this->sendResponse($order,200,true);


    }

    public function get_customers()
    {
        $customers = Customer::all();
        return $this->sendResponse($customers,200,true);

    }
    public function get_orders()
    {
        $orders = Order::all();
        return $this->sendResponse($orders,200,true);


    }

    public function delete_order(Request $request,$id)
    {


        //$id = $request->order_id;
        $order= Order::find($id);
        $user = Auth::user();

        //dd($order);

        if ($user->can('delete',$order))
        {
            Order::destroy($id);

            return $this->sendResponse("Deleted",200,true);

        }
        else
        {
            return $this->sendResponse("Un Authorized",401);
        }





    }

    private function sendResponse($data , $code,$success=false)
    {
        $response = [
            "success"=>$success,
            "body"=>$data
        ];

        return response()->json($response,$code);

    }

    public function login(Request $request)
    {
        $user =User::where(['id'=>$request->id ]
                            //'password'=>bcrypt($request->password)]
        )->first();

        if($user)
        {
            $token = $user->createToken("Store")->accessToken;
            return $this->sendResponse($token ,200,true);

        }
        else
        {
            return $this->sendResponse("Wrong Credentials",401);
        }
    }

}
