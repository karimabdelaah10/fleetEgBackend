<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\BaseApp\Enums\GeneralEnum;
use App\Modules\Products\Models\Order;
use App\Modules\Slider\Models\Slider;
use App\Modules\Users\User;

class DashboardController extends Controller {

    public $model;
    public $views;
    public $module;

    public function __construct() {
        $this->views = 'Dashboard';
//        $this->title = trans('app.Slider');
//        $this->model = $model;
//        $this->rules = $model->rules;
    }

    public function getIndex() {
        if (is_user()){
            $user = User::findOrFail(auth()->id());
            $data['bannars']=Slider::Active()->get();
            $data['numbers'] =$this;
            $data['numbers']->delivered_orders = Order::where('user_id' , auth()->id())->where('status' ,GeneralEnum::DELIVERED)->count();
            $data['numbers']->pending_orders = Order::where('user_id' , auth()->id())->where('status' ,GeneralEnum::PENDING)->count();
            $data['numbers']->total_commission = Order::where('user_id' , auth()->id())->where('status' ,GeneralEnum::DELIVERED)->sum('total_commission');
            $data['numbers']->favourite_products = $user->favourite_products->count();
            return view($this->views . '::customer_index' , $data);
        }elseif (is_admin()){

        }
        return view($this->views . '::index');
    }

}
