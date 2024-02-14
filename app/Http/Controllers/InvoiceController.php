<?php

namespace App\Http\Controllers;

use App\Models\NodeOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use stdClass;

class InvoiceController extends Controller
{

    public function index($id)
    {

        //dd($id);
        $order = NodeOrders::where('id_order', $id)->get();
        if (count($order) > 0) {
            return view('invoice.invoice_step2', compact('order'));
        } else {
            abort(404);
        }

    }

}
