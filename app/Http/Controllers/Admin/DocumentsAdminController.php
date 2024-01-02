<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use Encore\Admin\Actions\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DocumentsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Documents::orderBy('id', 'DESC')->paginate(9);

        return view('admin.documents-upload', compact('videos'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:pdf,doc',
        ]);

        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        $title = $request->title;
        if (isset($request->tutorial_account) && $request->tutorial_account != '') {
            $title = $request->tutorial_account . "|" . $title;
        }

        if ($isFileUploaded) {
            $video = new Documents();
            $video->title = $title;
            $video->path = $filePath;
            $video->save();

            return back()
                ->with('success', 'Document has been successfully uploaded.');
        }

        return back()
            ->with('error', 'Unexpected error occured');
    }

    public function downloadFile($id)
    {
        $file = Documents::where("id", $id)->first();
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
        $videos = Documents::find($id);

        return view('admin.documents-upload-edit', compact('videos'));
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

            $video = Documents::find($id);

            $fileName = $request->video->getClientOriginalName();
            $filePath = 'videos/' . $fileName;

            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

            // File URL to access the video in frontend
            $url = Storage::disk('public')->url($filePath);

            if ($isFileUploaded) {
                $video->title = $request->title;
                $video->path = $filePath;
                $video->update($data);

                return redirect()->route('admin.documents-upload.index')->with('success', 'Document has been successfully updated.');
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

        $videos = Documents::find($id);

        $videos->delete();

        return redirect()->route('admin.documents-upload.index')->with('success', 'Document has been deleted.');
    }
}
