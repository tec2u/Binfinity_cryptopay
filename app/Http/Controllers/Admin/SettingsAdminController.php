<?php

namespace App\Http\Controllers\Admin;

use App\Models\HistoricScore as Score;
use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Landing;
use App\Models\SystemConf;
use App\Traits\CustomLogTrait;
use Illuminate\Http\Request;
use Storage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SettingsAdminController extends Controller
{
   use CustomLogTrait;
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function mlmLevel()
   {
      $scores = Career::all();
      return view('admin.settings.mlmLevel', compact('scores'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $scores = Career::find($id);
      return view('admin.settings.edit', compact('scores'));
   }

   public function update(Request $request, $id)
   {

      $data = $request->only([
         'score',
         'bonus',
      ]);

      $scores = Career::find($id);
      $scores->update($data);

      return redirect()->route('admin.settings.mlmLevel')->with('success', 'Your data has been successfully updated!');
   }

   public function indication()
   {
      $indication = Landing::all();
      return view('admin.settings.indication', compact('indication'));
   }

   public function editVideo($id)
   {
      $videos = Landing::find($id);
      return view('admin.settings.editVideo', compact('videos'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.settings.create');
   }


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $data = $request->only([
         'description',
         'img_url',
      ]);

      $videos = Landing::create($data);

      flash(__('admin_alert.videoupload'))->success();
      return redirect()->route('admin.settings.indication');
   }

   public function updateVideo(Request $request, $id)
   {
      $data = $request->only([
         'description',
         'img_url',
      ]);

      $videos = Landing::find($id);
      $videos->update($data);

      flash(__('admin_alert.videoupdate'))->success();
      return redirect()->route('admin.settings.indication');
   }
   public function systemuser()
   {
      $system = SystemConf::first();
      return view('admin.users.system', compact('system'));
   }

   public function upsystemconfig(Request $request)
   {
      $data = $request->only([
         'is_allowed_btn_box'
      ]);

      $system = SystemConf::first();
      try {

         if(is_null($system)){
            $system = SystemConf::create($data);
            $this->createLog('System Config created successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.system_created'))->success();
            return redirect()->route('admin.settings.system');
         }
         else{
            $system->update($data);
            $this->createLog('System Config updated successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.system_update'))->success();
            return redirect()->route('admin.settings.system');
         }

      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         flash(__('admin_alert.system_noupdate'))->error();
         return redirect()->route('admin.settings.system');
      }
   }
}
