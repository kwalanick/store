<?php

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Product;

use App\User;
use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name'=>'Kwala','email'=>'nicholas.ndehi@aimsoft.co.ke','password'=>bcrypt('test@123')]);

        $c1 = Customer::create(['name'=>'John Doe','phone'=>'111-222-22','address'=>'Westlands']);
        $c2 = Customer::create(['name'=>'Jane Doe','phone'=>'111-333-22','address'=>'Kilimani' ]);
        $p1 = Product::create(['name'=>'Cement','price'=>450,'quantity'=>100 ]);

        $p2 = Product::create(['name'=>'Nails Pack','price'=>2000,'quantity'=>200]);
        $p3 = Product::create(['name'=>'Paint','price'=>1450,'quantity'=>500 ]);
        $p3 = Product::create(['name'=>'Tails Park','price'=>680,'quantity'=>200]);

        $order_1 = Order::create(['customer_id'=>1,'total'=>4000]);
        $order_2 = Order::create(['customer_id'=>2,'total'=>6800]);
        $order_3 = Order::create(['customer_id'=>1,'total'=>4500]);

        $d1=OrderDetail::create(['order_id'=>1,'product_id'=>2,'quantity'=>2,'total'=>4000]);
        $d2=OrderDetail::create(['order_id'=>2,'product_id'=>1,'quantity'=>3,'total'=>4000]);
        $d3=OrderDetail::create(['order_id'=>3,'product_id'=>4,'quantity'=>1,'total'=>4000]);


    }
}
