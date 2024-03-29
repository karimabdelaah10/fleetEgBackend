<?php

namespace App\Modules\Users\Controllers;

use App\Modules\Cars\Car;
use App\Modules\MoneyProcess\Models\Moneyrequest;
use App\Modules\MoneyProcess\Models\Paymentmethod;
use App\Modules\Products\Models\Order;
use App\Modules\Users\Enums\UserEnum;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Requests\UpdateUserRequest;
use App\Modules\Users\User;
use App\Modules\Users\UserEnums;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public $model;
    public $module,$module_url, $views ,$title;

    public function __construct(User $model)
    {
        $this->module = 'users';
        $this->module_url = '/users';
        $this->views = 'Users::users';
        $this->title = trans('app.users');
        $this->model = $model;
    }

    public function getIndex()
    {
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['views'] = $this->views;
        $data['row']=$this->model;
        $data['row']->is_active = 1;
        $data['page_title'] = trans('app.list') . ' ' . $this->title;
        $data['page_description'] = trans('user.page description');
        $data['rows'] = $this->model->getData()->Customer()->Filtered()->latest()->paginate(request('per_page'));

        return view($this->views . '.index', $data);
    }

    public function verifyAll()
    {
        User::where('is_verified', 0)->update(['is_verified'=>1]);
        flash()->success(trans('app.update successfully'));
        return redirect($this->module_url);
    }
    public function getCreate(){
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['views'] = $this->views;
        $data['page_title'] = trans('app.add') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module_url];
        $data['row'] = $this->model;
        $data['row']->is_active = 1;
        return view($this->views . '.create', $data);
    }
    public function postCreate(CreateUserRequest $request)
    {
        $request['type'] = UserEnum::CUSTOMER;
        !empty($request->is_active) ? $request['is_active'] =1 : $request['is_active'] =0;
        if ($row = $this->model->create($request->all()))
        {
            flash()->success(trans('app.created successfully'));
            return redirect($this->module_url);
        }
        flash()->error(trans('app.failed to save'));
        return redirect($this->module_url);
    }

    public function getEdit($id)
    {
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['views'] = $this->views;
        $data['page_title'] = trans('app.edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module_url];
        $data['row'] = $this->model->Customer()->findOrFail($id);
        return view($this->views . '.edit', $data);
    }

    public function postEdit(UpdateUserRequest $request, $id)
    {

        $row = $this->model->Customer()->findOrFail($id);
        !empty($request->is_active) ? $request['is_active'] =1 : $request['is_active'] =0;
        !empty($request->is_verified) ? $request['is_verified'] =1 : $request['is_verified'] =0;
        if ($row->update($request->all())) {
            flash(trans('app.update successfully'))->success();
            return redirect($this->module_url);
        }
        flash()->error(trans('app.failed to save'));
        return redirect($this->module_url);
    }

    public function getView($id)
    {
        $data['views'] = $this->views;
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['page_title'] = trans('app.view') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module_url];
        $data['row'] = $this->model->Customer()->findOrFail($id);
        $data['payment_methods'] = Paymentmethod::where('user_id' , $id)->get();
        return view($this->views . '.view', $data);
    }

    public function getDelete($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.deleted successfully'));
        return back();
    }

    public function getMoneyRequests($id)
    {
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['views'] = $this->views;
        $data['breadcrumb'] = [
            $this->title => $this->module_url,
            trans('app.view') . " " . $this->title => $this->module_url.'/view/'.$id
        ];
        $data['page_title'] = trans('user.all money requests');
        $data['page_description'] = trans('user.all money requests');
        $data['rows'] =Moneyrequest::where('user_id' , $id)->latest()->paginate(request('per_page'));
        return view($this->views . '.money-requests', $data);

    }
    public function getOrders($user_id)
    {
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['views'] = $this->views;
        $data['breadcrumb'] = [
            $this->title => $this->module_url,
            trans('app.view') . " " . $this->title => $this->module_url.'/view/'.$user_id
];
        $data['page_title'] = trans('user.all orders');
        $data['page_description'] = trans('user.all orders');
        $data['rows'] =Order::where('user_id' , $user_id)->latest()->paginate(request('per_page'));
        return view($this->views . '.all_orders', $data);

    }

    public function getOrderDetails($id)
    {
        $data['module'] = $this->module;
        $data['module_url'] = $this->module_url;
        $data['views'] = $this->views;
        $data['row'] = Order::findOrFail($id);
        $data['page_title'] = trans('user.list one order');
        $data['page_description'] = trans('user.list one order');
        $data['breadcrumb'] = [
            $this->title => $this->module_url,
                    trans('app.view') . " " . $this->title => $this->module_url.'/view/'.$data['row']->user_id,
            trans('user.all orders') => $this->module_url.'/orders/'.$data['row']->user_id,

        ];
        return view($this->views . '.one_order', $data);

    }
}
