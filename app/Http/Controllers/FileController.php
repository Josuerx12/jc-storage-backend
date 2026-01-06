<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Bucket;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    public function upload(StoreFileRequest $request)
    {
        $validated = $request->validated();

        $file = $validated['file'];

        $bucket = Bucket::where('name', $validated['bucket'])
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$bucket) {
            return response()->json(['message' => 'Bucket não encontrado'], 404);
        }

        $ftpPath = $bucket->name . '/';

        $storagedFile = Storage::disk('ftp')->putFile($ftpPath, $file);

        $model = new File();

        $model->filename = $file->getClientOriginalName();
        $model->path = $ftpPath . basename($storagedFile);
        $model->bucket_id = $bucket->id;
        $model->size = $file->getSize();
        $model->mime_type = $file->getClientMimeType();

        $model->save();

        return response()->json([
            'message' => 'Arquivo salvo com sucesso!',
            'file' => $model
        ], 201);
    }

    public function generateUrl(Request $request, File $file)
    {
        $timeToExpire = $request->query('expires_in') ? intval($request->query('expires_in')) : 10 * 60;

        $isAuthorized = $request->user()->id === $file->bucket->user_id;

        if (!$isAuthorized) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $expiration = Carbon::now()->addSeconds($timeToExpire);

        $url = URL::temporarySignedRoute(
            'files.download',
            $expiration,
            ['id' => $file->id]
        );

        return response()->json([
            'url' => $url,
            'expires_at' => $expiration->toDateTimeString()
        ]);
    }


    public function download($id)
    {
        $file = File::findOrFail($id);

        $stream = Storage::disk('ftp')->readStream($file->path);

        if (! $stream) {
            abort(404, 'Arquivo não encontrado');
        }

        return response()->streamDownload(function () use ($stream) {
            fpassthru($stream);
            fclose($stream);
        }, $file->filename);
    }
}
