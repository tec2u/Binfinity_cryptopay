<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Encore\Admin\Actions\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VideoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('id', 'DESC')->paginate(9);

        return view('admin.video-upload', compact('videos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mp3',
        ]);

        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {
            $video = new Video();
            $video->title = $request->title;
            $video->path = $filePath;
            $video->save();

            return back()
                ->with('success', 'Video has been successfully uploaded.');
        }

        return back()
            ->with('error', 'Unexpected error occured');
    }

    public function downloadFile($id)
    {
        $file = Video::where("id", $id)->first();
        $filepath = storage_path("app/public/{$file->path}");
        return response()->download($filepath);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos = Video::find($id);

        return view('admin.video-upload-edit', compact('videos'));
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
            ]);

            $video = Video::find($id);

            $fileName = $request->video->getClientOriginalName();
            $filePath = 'videos/' . $fileName;

            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

            // File URL to access the video in frontend
            $url = Storage::disk('public')->url($filePath);

            if ($isFileUploaded) {
                $video->title = $request->title;
                $video->path = $filePath;
                $video->update($data);

                return redirect()->route('admin.video-upload.index')->with('success', 'Video has been successfully updated.');
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

        $videos = Video::find($id);

         $videos->delete(); 

         return redirect()->route('admin.video-upload.index')->with('success', 'Video has been deleted.');
        }
}
