<?php

namespace App\Http\Controllers;

use App\Models\OrderPackage;
use App\Models\Rede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NetworkController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function mytree($parameter)
    {
        $rede = Rede::where('user_id', $parameter)->first();
        $name = empty($rede->upline_id) ? "" : Rede::find($rede->upline_id)->user->login;
        $redename = $rede->user->login;
        $id = $rede->id;
        $qty = $rede->qty;
        $email = $rede->user->email;
        $volume = $rede->user->getVolume($rede->user->id);
        $tag =  '';
        $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
        $getadessao = $rede->user->getAdessao($rede->user->id);
        $getpackages = $rede->user->getPackages($rede->user->id);
        if (!$pay) {
            $tag = ["Inactive"];
        }
        if ($getadessao > 0) {
            $tag = ["PreRegistration"];
        }
        if ($getpackages > 0) {
            $tag = ["AllCards"];
        }
        $rede_users = Rede::where('upline_id', $id)->get()->count();
        if ($rede_users > 0) {
            $network = $this->getNetwork($rede->id);
            $networks[] = array(
                "id" => "$id",
                "name" => "$redename",
                "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                "size" => ".$qty",
                "referred" => $name,
                "email"    => $email,
                "volume"  => "Volume: $volume",
                "tags" => $tag
            );
            $networks = array_merge($network, $networks);
        } else {
            $network = $this->getNetwork($rede->id);
            $networks = array(
                array(
                    "id" => "$id",
                    "name" => "$redename",
                    "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                    "size" => ".$qty",
                    "referred" => $name,
                    "volume"  => "Volume: $volume",
                    "tags" => $tag
                )
            );
        }
        //$networks += $this->getNetwork($rede->id);
        // {
        //     id: 1,
        //     name: "Amber McKenzie",
        //     img: "https://cdn.balkan.app/shared/empty-img-none.svg",
        //     size: 10,
        //     referred: "master"
        // },
        $networks = json_encode($networks);
        //$networks = str_replace(array("\n", "\r"), '', $networks);
        //dd($networks);
        return view('network.rede', compact('networks'));
    }
    public function mytreediferente($parameter)
    {
        $rede = Rede::where('user_id', $parameter)->first();
        $name = empty($rede->upline_id) ? "" : Rede::find($rede->upline_id)->user->login;
        $redename = $rede->user->login;
        $id = $rede->id;
        $network = $this->getNetworkDiferente($rede->id);
        if ($network != NULL) {
            $networks['tree'] = array($id => $network['tree']);
            $networks['params'] = array($id => array(
                'trad' => $redename . ' </br>',
                'styles' => array(
                    'font-weight' => '600',
                    'font-size' => '18px',
                    'background-color' => '#f3f3f37a',
                    'color' => 'red',
                    'box-shadow' => '0 0 4px 1px #aeaeae',
                    'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                )
            ));
            $networks['params'] = $network['params'] + $networks['params'];
        } else {
            $networks['tree'] = array($id => '');
            $networks['params'] = array($id => array(
                'trad' => $redename . ' </br>',
                'styles' => array(
                    'font-weight' => '600',
                    'font-size' => '18px',
                    'background-color' => '#f3f3f37a',
                    'color' => 'red',
                    'box-shadow' => '0 0 4px 1px #aeaeae',
                    'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                )
            ));
        }
        $tree = json_encode($networks['tree']);
        $params = json_encode($networks['params']);
        return view('network.rede_diferente', compact('tree', 'params'));
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function myreferrals()
    {
        $id_user  = Auth::id();
        $rede     = Rede::where('user_id', $id_user)->first();
        $networks = Rede::where('upline_id', $rede->id)->get();
        return view('network.myreferrals', compact('networks'));
    }
    private function getNetwork($id, $cont = '')
    {
        $cont = empty($cont) ? 1 : $cont;
        $rede_users = Rede::where('upline_id', $id)->get();
        $networks = array();
        foreach ($rede_users as $rede) {
            $name = empty(Rede::find($rede->upline_id)) ? "" : Rede::find($rede->upline_id)->first()->user->login;
            $redename = $rede->user->login;
            $id = $rede->id;
            $qty = $rede->qty;
            $upline = $rede->upline_id;
            $volume = $rede->user->getVolume($rede->user->id);
            $tag =  '';
            $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
            $getadessao = $rede->user->getAdessao($rede->user->id);
            $getpackages = $rede->user->getPackages($rede->user->id);
            if (!$pay) {
                $tag = ["Inactive"];
            }
            if ($getadessao > 0) {
                $tag = ["PreRegistration"];
            }
            if ($getpackages > 0) {
                $tag = ["AllCards"];
            }
            $email = $rede->user->email;
            $referral_rede = Rede::where('id', $upline)->first();
            $referral_user = User::where('id', $referral_rede->user_id)->first();
            $networks[] = array(
                "id" => "$id",
                "pid" => "$upline",
                "name" => "$redename",
                "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                "size" => "$qty",
                "referred" => $referral_user->login,
                "email"    => $email,
                "volume"  => "Volume: $volume ",
                "btn"     => "<a href='" . route('networks.mytree', ['parameter' => $rede->user->id]) . "'> More + </a>",
                "tags" => $tag
            );
            $cont++;
            if ($cont < 3) {
                $networks = array_merge($this->getNetwork($rede->id, $cont), $networks);
            }
        }
        //dd($networks);
        return $networks;
    }
    private function getNetworkDiferente($parameter)
    {
        $redes = Rede::where('upline_id', $parameter)->get();
        if ($redes == NULL) return NULL;
        $networks = array();
        foreach ($redes as $rede) {
            $redename = $rede->user->login;
            $id = $rede->id;
            $network = $this->getNetworkDiferente($rede->id);
            if ($network != NULL) {
                if (isset($networks['tree'])) {
                    $networks['tree'] = $networks['tree'] + array($id => $network['tree']);
                    $networks['params'] = $networks['params'] + array($id => array(
                        'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                        'styles' => array(
                            'font-weight' => '600',
                            'font-size' => '18px',
                            'background-color' => '#f3f3f37a',
                            'color' => 'red',
                            'box-shadow' => '0 0 4px 1px #aeaeae',
                            'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                        )
                    ));
                } else {
                    $networks['tree'] = array($id => $network['tree']);
                    $networks['params'] = array($id => array(
                        'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                        'styles' => array(
                            'font-weight' => '600',
                            'font-size' => '18px',
                            'background-color' => '#f3f3f37a',
                            'color' => 'red',
                            'box-shadow' => '0 0 4px 1px #aeaeae',
                            'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                        )
                    ));
                }
                $networks['params'] = $network['params'] + $networks['params'];
            } else {
                if (isset($networks['tree'])) {
                    $networks['tree'] = $networks['tree'] + array($id => '');
                    $networks['params'] = $networks['params'] + array($id => array(
                        'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                        'styles' => array(
                            'font-weight' => '600',
                            'font-size' => '18px',
                            'background-color' => '#f3f3f37a',
                            'color' => 'red',
                            'box-shadow' => '0 0 4px 1px #aeaeae',
                            'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                        )
                    ));
                } else {
                    $networks['tree'] = array($id => '');
                    $networks['params'] = array($id => array(
                        'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                        'styles' => array(
                            'font-weight' => '600',
                            'font-size' => '18px',
                            'background-color' => '#f3f3f37a',
                            'color' => 'red',
                            'box-shadow' => '0 0 4px 1px #aeaeae',
                            'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                        )
                    ));
                }
            }
        }
        return $networks;
    }

        /**
     *
     * @return \Illuminate\Http\Response
     */
    public function associatesReport()
    {
        $id_user  = Auth::id();
        $rede     = Rede::where('user_id', $id_user)->first();
        $networks = Rede::where('upline_id', $rede->id)->get();

        if($networks) {
            return view('network.associatesReport', compact('networks'));
        }
    }

    public function pesquisa(Request $request)
    {
        if($request->ajax())
    	{
            $id = $request->login;
            // $rede = DB::table('rede')
            // ->selectRaw('users.login as login, users.country as country, users.email as email,users.name as name,user2.name as patrocinador,rede.id as id')
            // ->join('users', 'rede.user_id', '=', 'users.id')
            // ->join('rede rede2', 'rede2.id', '=', 'rede.upline_id')
            // ->join('users user2', 'rede2.user_id', '=', 'user2.id')
            // ->where('rede.upline_id', $id )->get();

            $rede = DB::select('SELECT users.login as login, 
                                    users.country as country, 
                                    users.email as email,
                                    users.name as name,
                                    user2.login as patrocinador,
                                    rede.id as id 
                                FROM rede
                                JOIN users on rede.user_id = users.id
                                JOIN rede rede2 on rede2.id = rede.upline_id
                                JOIN users user2 on rede2.user_id = user2.id
                                WHERE rede.upline_id = ?', [$id]
            );
            if(empty(sizeof($rede)))
            {
                return response()->json(['error'=>'tabela vazia']);
            }
            else
            {
                return response()->json($rede);
            }

    	}
    	return view('network.associatesReport');
    }
    
}
