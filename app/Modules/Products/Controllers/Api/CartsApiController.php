<?php

namespace App\Modules\Products\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Cart;
use App\Modules\Products\Models\Favouriteproduct;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\Productspecvalue;
use App\Modules\Products\Models\Spec;
use App\Modules\Products\Resources\ProductsResource;
use App\Modules\Products\Resources\ProductsResourcePagination;
use App\Modules\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsApiController extends Controller {

    public $model;
    public $views;
    public $module,$module_url ,$title;

    public function __construct(Cart $model) {
        $this->model = $model;
    }

    public function index($user_id) {
        $response = [];
        $product_discounts=[];
        $product_discounts_details=[];

        $trans=[
            'my_cart' => trans('carts.my_carts'),
            'total' => trans('carts.total'),
            'checkout' => trans('carts.checkout'),
            'shipping_coast'=>trans('governorate.shipping_coast')
        ];
      $carts = Cart::where('user_id' ,$user_id)
          ->with(['innerSpecValue','specValue','product'])
          ->get();

      if (count($carts)){
          foreach ($carts as $cart){
              if ($cart->product->discount){
                  if (!empty($product_discounts[$cart->product_id])){
                      $product_discounts[$cart->product_id]['amount'] += $cart->amount;
                  }else{
                      $product_discounts[$cart->product_id] =[
                          'amount' =>$cart->amount,
                          'two_pc_discount'=>$cart->product->two_pc_discount,
                          'plus_two_pc_discount'=>$cart->product->plus_two_pc_discount,
                          'product_title'=>$cart->product->title,

                      ];
                  }
              }
          }
      }
      if (count($product_discounts)){
          foreach ($product_discounts as $one_product_discount){
              if ($one_product_discount['amount'] == 2){
                  $recorde =[
                      'discount'  =>$one_product_discount['two_pc_discount'],
                      'product_title'=>$one_product_discount['product_title']
                  ];
              }elseif ($one_product_discount['amount'] > 2 ){
                  $recorde =[
                      'discount'  =>$one_product_discount['plus_two_pc_discount'],
                      'product_title'=>$one_product_discount['product_title']
                  ];
              }
              if (isset($recorde)){
                  array_push($product_discounts_details , $recorde);
              }
          }
      }

      $response['data'] = $carts;
      $response['trans'] = $trans;
      $response['product_discounts'] = $product_discounts;
      $response['product_discounts_details'] = $product_discounts_details;
            return  $response;
    }
    public function delete($product_id) {
      Cart::findOrFail($product_id)->delete();
      return  'Done';
    }

    public function favProduct(Request $request)
    {
     $row=  Favouriteproduct::where([['product_id', $request->product_id],['user_id',$request->user_id]])->first();
        if ($row){
            $row->delete();
        }else{
            Favouriteproduct::create($request->all());
        }

        return [
            'status' => 200,
            'message'=>'Done'
        ];
    }

    public function getFavouriteProducts($user_id)
    {
        $user= User::findOrFail($user_id);
        Auth::login($user);
        $product_ids= Favouriteproduct::where('user_id', $user_id)->pluck('product_id');
        $products =  $this->model->Filtered()->whereIn('id' ,$product_ids)->with('category')->orderBy("id","DESC")->paginate(request('per_page'));
        return new ProductsResourcePagination($products);

    }

    public function getView($product_id)
    {
        $user= User::findOrFail(\request()->user_id);
        Auth::login($user);
        $product =  $this->model->findOrFail($product_id);
        return[
            'data' =>new ProductsResource($product),
        ];
    }

    public function getInnerSpecValues($parent_spec_value_id)
    {
        $data=[];
        $specs_values_list=[];
        $specsIds =Productspecvalue::where('parent_spec_value_id' ,$parent_spec_value_id)->where('product_id', \request()->product_id)
            ->pluck('spec_id');
        $specs =  Spec::whereIn('id' , $specsIds)->with('productspecsvalues')->get();

        if (!empty($specs)){
            foreach ($specs as $spec){
                $inner_spec_values = $spec->productspecsvalues->where('parent_spec_value_id' ,$parent_spec_value_id)->where('product_id', \request()->product_id);
                if (!empty($inner_spec_values)){
                    foreach ($inner_spec_values as $inner_spec_value){
                        $spec_value_record =[
                            'id'            => $inner_spec_value->id,
                            'value_id'         => $inner_spec_value->value->id,
                            'title'         => $inner_spec_value->value->title,
                            'stock'         => @$inner_spec_value->stock,
                            'image'         =>  image($inner_spec_value->image , 'large') ,
                        ];
                        array_push($specs_values_list , $spec_value_record);
                    }
                }
                $spec_record =[
                    'id'            => $spec->id,
                    'title'         => $spec->title,
                    'is_active'     =>$spec->is_active,
                    'specs_values'  =>$specs_values_list
                ];


                array_push($data , $spec_record);
                $specs_values_list=[];
            }
        }
        return  $data;
    }

    public function addProductToCart(Request  $request)
    {
        $row = Cart::create($request->all());
        return $row;
    }
}
