<?php

namespace App\Http\Controllers\Admin\OrderAdmin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.order-admin.index', compact('packages'));
    }


    public function payment(Request $request)
    {
        $user = User::orwhere("login", $request->username)
            ->orWhere('email', $request->username)
            ->orWhere('contact_id', $request->username)
            ->first();

        if (!$user) {
            flash(__('user Not Found: '))->error();
            return redirect()->back();
        }
        $id_user = $user->id;
        $package = Package::find($request->package);
        if ($request->has('price_new')) {
            if ($request->price_new >= $package->price) {
                $price = $request->price_new;
            } else {
                $price = $package->price;
            }
        } else {
            $price = $package->price;
        }

        $name = substr(str_replace(' ', '', $package->name), 0, 15);

        try {

        


          

            $codepayment = "---";
            $invoiceid = "---";
            $wallet_OP = "---";

            $this->createOrder($id_user, $package, $codepayment, $invoiceid, $wallet_OP, '0', $price);

            

          
            flash(__('Order Created Successfully'))->success();
            return redirect('/admin/packages/orderPackages');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // $this->errorCatch($e->getMessage(), auth()->user()->id);
            // flash(__('backoffice_alert.unable_to_process_your_order'))->error();
            return redirect()->back();
        }
    }


    public function createOrder($id_user, $package, $payment, $invoiceid, $wallet, $subId, $price)
    {
        $user = User::find($id_user);

        $user->orderPackage()->create([
            "reference"             => $package->name,
            "payment_status"        => 0,
            "transaction_code"      => $payment,
            "package_id"            => $package->id,
            "price"                 => $price,
            "amount"                => 1,
            "transaction_wallet"    => $invoiceid,
            "wallet"                => $wallet,
            "subscription_id"       => $subId
        ]);
    }
}
