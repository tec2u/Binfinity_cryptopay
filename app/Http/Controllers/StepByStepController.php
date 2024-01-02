<?php

namespace App\Http\Controllers;

use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\User;
use Auth;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class StepByStepController extends Controller
{
    public function step($step, $data = [])
    {
        if (!isset(auth()->user()->id)) {
            abort(403);
        }

        if ($step > 5 || empty($data)) {
            return view('welcome.create_new_bot_step1');
        }

        switch ($step) {
            case 1:
                return view('welcome.create_new_bot_step1', compact('data'));
            case 2:
                return view('welcome.create_new_bot_step2', compact('data'));
            case 3:
                return view('welcome.create_new_bot_step3', compact('data'));
            case 4:
                return response()
                    ->view('welcome.create_new_bot_step4', compact('data'))
                    ->withCookie($data['cookie']);
            case 5:
                flash(__('bot registered successfully'))->success();
                return view('welcome.create_new_bot_step5', compact('data'));
            default:
                abort(404);
                break;
        }
    }

    public function steppost2(Request $request)
    {
        // dd($request);
        $id_package = $request->id_package;
        return $this->step(2, ["id_package" => $id_package]);
    }

    public function steppost3(Request $request)
    {
        // dd($request);
        $id_package = $request->id_package;
        return $this->step(3, ["id_package" => $id_package]);
    }

    public function steppost4(Request $request)
    {

        // dd($request);
        $id_package = $request->id_package;


        $path = public_path('images/printscreen/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        if (isset($request->upload_print)) {
            if ($request->file('upload_print')->isValid()) {
                $rules = [
                    'upload_print' => 'image|mimes:jpeg,png,webp|max:10240',
                ];
                $validator = \Validator::make($request->all(), $rules);

                if (!$validator->fails()) {
                    $imageName = time() . '.' . $request->upload_print->extension();
                    $request->upload_print->move($path, $imageName);
                } else {
                    return redirect()->back()->with('error', 'The image is invalid. Please try again.');
                }
            }

        }

        $dados = [
            "id_package" => $request->id_package,
            "login_number" => $request->login_number,
            "login_password" => $request->login_password,
            "server_address" => $request->server_address,
            "upload_print" => $imageName
        ];

        $cookie = cookie('requestPost', json_encode($dados), 60); // 60 minutos de validade

        return $this->step(4, [
            "id_package" => $id_package,
            "cookie" => $cookie
        ]);
    }

    public function steppost5(Request $request)
    {
        if (!$request->hasCookie('requestPost')) {
            return $this->step(1);
        }

        $dadosDoCookie = json_decode(request()->cookie('requestPost'));
        // dd($dadosDoCookie);

        $id_package = $request->id_package;

        $package = Package::where('id', $id_package)->first();

        $user = User::find(Auth::id());

        $newOrder = new OrderPackage;
        $newOrder->user_id = $user->id;
        $newOrder->reference = $package->name;
        $newOrder->payment_status = 0;
        $newOrder->transaction_code = 0;
        $newOrder->package_id = $package->id;
        $newOrder->price = $package->price;
        $newOrder->amount = 1;
        $newOrder->transaction_wallet = 0;
        $newOrder->wallet = 0;
        $adesao = !$user->getAdessao($user->id) >= 1;
        $newOrder->printscreen = $dadosDoCookie->upload_print;
        $newOrder->pass = $dadosDoCookie->login_password;
        $newOrder->server = $dadosDoCookie->server_address;
        $newOrder->user = $dadosDoCookie->login_number;
        $newOrder->save();
        Cookie::forget('requestPost');
        return $this->step(5, ["id_package" => $id_package]);
    }
}
