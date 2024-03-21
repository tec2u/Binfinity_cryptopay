<?php

namespace App\Http\Controllers;

use App\Models\IpAllowedApi;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\CustomLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\Models\Package;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Attribute\Cache;
use App\Http\Controllers\ClubSwanController;

class UserController extends Controller
{
   use CustomLogTrait;

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $id = auth()->user()->id;

      $user = User::find($id);

      return view('user.myinfo', compact('user'));
   }

   public function password()
   {
      return view('user.password');
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      $data = $request->only([
         'name',
         'password',
         'last_name',
         'birthday',
         'address1',
         'address2',
         'postcode',
         'state',
         'city',
         'gender',
         'email',
         'telephone',
         'cell',
         'country',
      ]);

      try {

         if ($request->hasFile('image')) {
            $images = $request->file('image')->store('user', 'public');
            $data['image_path'] = $images;
         }

         $user = User::find($id);

         if (!Hash::check($request->get('password'), $user->password)) {
            Alert::error(__('backoffice_alert.current_password_is_not_correct'));
            return redirect()->back();
         }

         // if (!empty($request->get('wallet'))) {
         //    $datawallet = [
         //       "wallet" => $request->get('wallet'),
         //       "description" => "wallet"
         //    ];

         //    $exists = Wallet::where('user_id', $id)->first();
         //    if (isset($exists)) {
         //       $user->wallet()->update($datawallet);
         //    } else {
         //       $user->wallet()->create($datawallet);
         //    }
         // }

         // else {
         //    $datawallet = [
         //       "wallet" => $request->get('wallet'),
         //       "description" => "wallet"
         //    ];
         //    $user->wallet()->create($datawallet);
         // }


         // $club = new ClubSwanController;
         // $clubResponse = NULL;
         // if ($user->contact_id == NULL) {
         //    $clubResponse = $club->singUp($data);
         //    if ($clubResponse->status == 'success') {
         //       $data['contact_id'] = $clubResponse->data->contactId;
         //    }
         //  else {
         // throw new Exception(json_encode($clubResponse));

         // }
         // }

         unset($data['password']);

         $user->update($data);


         $this->createLog('User updated successfully', 200, 'success', auth()->user()->id);

         // if ($clubResponse == NULL) {
         //    Alert::success(__('backoffice_alert.user_update'));
         // }
         return redirect()->route('users.index');

      } catch (Exception $e) {
         dd($e);
         $error = json_decode($e->getMessage(), true);
         if (isset ($error['status']) && $error['status'] == 'fail') {
            $this->errorCatch($error['message'] . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            $q = '';
            if ($error['message'] == 'Invalid parameter(s)') {
               foreach ($error['data']['invalid-params'] as $value) {
                  $q .= '<br>' . $value;
               }
            }
            Alert::error($error['message'] . $q);
         } else {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            Alert::error(__('backofffice_alert.user_not_update'));
         }
         return redirect()->route('users.index');
      }
   }

   public function changePassword(Request $request)
   {
      $data = $request->only([
         'password',
         'old_password'
      ]);

      try {
         $id = auth()->user()->id;

         $user = User::find($id);
         if (!Hash::check($data['old_password'], $user->password)) {
            Alert::error(__('backoffice_alert.current_password_is_not_correct'));
            return redirect()->back();
         }

         $password = Hash::make($data['password']);

         $user->update([
            'password' => $password
         ]);
         $this->createLog('Password updated successfully', 200, 'success', auth()->user()->id);
         Alert::success(__('backoffice_alert.password_changed'));
         return redirect()->route('users.password');
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         Alert::error(__('backoffice_alert.password_not_changed'));

         return redirect()->route('users.password');
      }
   }

   public function changeFinancialPassword(Request $request)
   {
      $data = $request->only([
         'password',
         'old_password'
      ]);

      try {
         $id = auth()->user()->id;

         $user = User::find($id);
         if (!Hash::check($data['old_password'], $user->financial_password)) {
            Alert::error(__('backoffice_alert.current_password_is_not_correct'));
            return redirect()->back();
         }

         $password = Hash::make($data['password']);

         $user->update([
            'financial_password' => $password
         ]);
         $this->createLog('Password updated successfully', 200, 'success', auth()->user()->id);
         Alert::success(__('backoffice_alert.password_changed'));
         return redirect()->route('users.index');
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         Alert::error(__('backoffice_alert.password_not_changed'));

         return redirect()->route('users.index');
      }
   }

   public function register($id)
   {
      Auth::logout();

      $packages = Package::where('activated', 1)->where('type', '!=', 'activator')->orderBy('price')->get();

      $user = User::where('id', $id)->orWhere('login', $id)->first();
      if (!isset ($user)) {
         Alert::error('User not found!');
         return view('auth.register_must_active');
      }

      if ($user->payFirstOrder()) {
         return view('auth.register', compact('id', 'packages', 'user'));
      } else {
         Alert::error("Your referral is not active yet. Please refresh this page as soon as it's active to continue the registration process.");
         return view('auth.register_must_active');
      }
   }

   public function ipAllowed()
   {
      $ips = IpAllowedApi::where('user_id', Auth::id())->get();

      return view('ipApi.index', compact('ips'));
   }

   public function ipAllowedStore(Request $request)
   {
      try {
         $ips = IpAllowedApi::where('ip', $request->id)->where('user_id', Auth::id())->first();

         if (!isset ($ips)) {
            $nIp = new IpAllowedApi;
            $nIp->ip = $request->ip;
            $nIp->user_id = Auth::id();
            $nIp->save();
         }

         return redirect()->back();

      } catch (\Throwable $th) {
         return redirect()->back();

      }
   }

   public function ipAllowedDelete(Request $request)
   {
      $ips = IpAllowedApi::where('id', $request->id)->first();
      $ips->delete();

      return redirect()->back();
   }
}
