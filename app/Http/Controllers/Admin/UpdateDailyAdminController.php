<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UpdateDailyAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = DailyImages::orderBy('id', 'DESC')->paginate(9);

        return view('admin.dailyhome.upload', compact('images'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:png,jpeg',
            'date' => 'required|string|max:255',
        ]);

        $fileName = $request->video->getClientOriginalName();
        $filePath = 'dailyimage/' . $fileName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {
            $video = new DailyImages();
            $video->title = $request->title;
            $video->path = $filePath;
            $video->date = $request->date;
            $video->save();

            return back()
                ->with('success', 'Image has been successfully uploaded.');
        }

        return back()
            ->with('error', 'Unexpected error occured');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $images = DailyImages::find($id);

        return view('admin.dailyhome.edit', compact('images'));
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
        try {
            $data = $request->only([
                'title',
                'video' => 'required',
                'date',
            ]);

            $video = DailyImages::find($id);

            $fileName = $request->video->getClientOriginalName();
            $filePath = 'dailyimage/' . $fileName;

            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

            // File URL to access the video in frontend
            $url = Storage::disk('public')->url($filePath);

            if ($isFileUploaded) {
                $video->title = $request->title;
                $video->path = $filePath;
                $video->date = $request->date;
                $video->update($data);

                return redirect()->route('admin.dailyhome.upload')->with('success', 'Image has been successfully updated.');
            }
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(('Error'))->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $images = DailyImages::find($id);

        $images->delete();

        return redirect()->route('admin.dailyhome.upload')->with('success', 'Image has been deleted.');
    }
}
