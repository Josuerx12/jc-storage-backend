<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Bucket;
use App\Models\Credencial;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function upload(StoreFileRequest $request)
    {
        $validated = $request->validated();

        $file = $validated['file'];

        $credential = Credencial::where('access_key', $request->header('access_key'))->first();

        $bucket = Bucket::where('name', $validated['bucket'])
            ->where('user_id', $credential->user_id)
            ->first();

        if (!$bucket) {
            return response()->json(['message' => 'Bucket não encontrado'], 404);
        }

        $ftpPath = $bucket->name . '/';

        $storagedFile = Storage::disk('ftp')->putFile($ftpPath, $file);

        $model = new File();

        $filename = $validated['filename'] ?? $file->getClientOriginalName();

        $model->id = Str::uuid();
        $model->filename = $filename;
        $model->is_private = isset($validated['isPrivate']) && $validated['isPrivate'] === 'true' ? true : false;
        $model->path = $ftpPath . basename($storagedFile);
        $model->bucket_id = $bucket->id;
        $model->size = $file->getSize();
        $model->mime_type = $file->getClientMimeType();

        $model->save();

        return response()->json([
            'message' => 'Arquivo salvo com sucesso!',
            'file' => $model,
            'url' => $validated['isPrivate'] === 'true' ? null : route('files.public.download', ['id' => $model->id])
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
        }, $file->filename . '.' . pathinfo($file->mime_type, PATHINFO_EXTENSION));
    }

    public function publicDownload($id)
    {
        $file = File::findOrFail($id);

        if($file->is_private) {
            abort(403, 'Acesso negado. O arquivo é privado.');
        }

        $stream = Storage::disk('ftp')->readStream($file->path);

        if (! $stream) {
            abort(404, 'Arquivo não encontrado');
        }

        return response()->streamDownload(function () use ($stream) {
            fpassthru($stream);
            fclose($stream);
        }, $file->filename . '.' . pathinfo($file->mime_type, PATHINFO_EXTENSION));
    }

    public function delete(Request $request, File $file)
    {    
        $credential = Credencial::where('access_key', $request->header('access_key'))->first();

        $isAuthorized = $credential && $credential->user_id === $file->bucket->user_id;

        if (! $isAuthorized) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        Storage::disk('ftp')->delete($file->path);
        $file->delete();

        return response()->json(['message' => 'Arquivo deletado com sucesso!']);
    }

    public function destroy(Request $request, File $file)
    {
        $isAuthorized = $request->user()->id === $file->bucket->user_id;

        if (! $isAuthorized) {
            return redirect()
                ->route('dashboard.buckets.files', $file->bucket)
                ->with('error', 'Não autorizado.');
        }

        Storage::disk('ftp')->delete($file->path);
        $file->delete();

        return redirect()
            ->route('dashboard.buckets.files', $file->bucket)
            ->with('success', 'Arquivo deletado com sucesso!');
    }

    public function deleteView(Request $request,Bucket $bucket, File $file)
    {
        return view('dashboard.buckets.files.delete', ['bucket' => $bucket, 'file' => $file]);
    }
};
