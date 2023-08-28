<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Auth;
use Keygen;
use DB;
use Session; 
use Carbon\Carbon;
class CouponController extends Controller
{
    public function index()
    { 
        $lims_coupon_all = Coupon::where('is_active', true)->orderBy('id', 'desc')->get();
        $parties = DB::table('party')->get();
        return view('coupon.index', compact('lims_coupon_all','parties')); 
    }

    public function create()
    {
        //
    }

    public function generateCode()
    {
        $id = Keygen::alphanum(10)->generate();
        return $id;
    }

    public function store(Request $request)
    {
        $data = $request->all();  
        // $data['expired_date'] = Carbon::createFromFormat('m/d/Y', $data['expired_date'])->format('Y-m-d'); 
        $data['used'] = 0;
        $data['user_id'] = Session::get('UserID');
        $data['is_active'] = true;
        Coupon::create($data);
        return redirect('coupons')->with('error', 'Coupon created Successfully')->with('class', 'success');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if($data['type'] == 'percentage')
            $data['minimum_amount'] = 0;
        $lims_coupon_data = Coupon::find($data['coupon_id']);
        $lims_coupon_data->update($data);
        return redirect('coupons')->with('error', 'Coupon updated Successfully')->with('class', 'success');
    }

    public function deleteBySelection(Request $request)
    {
        $coupon_id = $request['couponIdArray'];
        foreach ($coupon_id as $id) {
            $lims_coupon_data = Coupon::find($id);
            $lims_coupon_data->is_active = false;
            $lims_coupon_data->save();
        }
        return 'Coupon deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_coupon_data = Coupon::find($id);
        $lims_coupon_data->is_active = false;
        $lims_coupon_data->save();
        return redirect('coupons')->with('error', 'Deleted Successfully')->with('class', 'success');
    }
}
