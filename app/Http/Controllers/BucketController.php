<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBucketRequest;
use App\Models\Bucket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BucketController extends Controller
{
    public function create()
    {
        return view('dashboard.buckets.create');
    }

    public function store(StoreBucketRequest $request)
    {
        $data = $request->validated();

        Bucket::create([
            'name' => $data['name'],
            'user_id' => $request->user()->id,
        ]);

        Storage::disk('ftp')->makeDirectory($data['name']);

        return redirect()->route('dashboard.buckets')->with('success', 'Bucket criado com sucesso!');
    }

    public function delete(Request $request, Bucket $bucket)
    {
        if(! $bucket) {
            return redirect()->route('dashboard.buckets')->with('error', 'Bucket não encontrado.');
        }

        $isAuthorized = $request->user()->id === $bucket->user_id;

        if ($isAuthorized) {
            return view('dashboard.buckets.delete', [
                'bucket' => $bucket,
            ]);
        }

        return redirect()->route('dashboard.buckets')->with('error', 'Não autorizado a deletar este bucket.');
    }

    public function destroy(Request $request, Bucket $bucket)
    {
        $isAuthorized = $request->user()->id === $bucket->user_id;

        if ($isAuthorized) {
            $bucket->delete();
            return redirect()->route('dashboard.buckets')->with('success', 'Bucket deletado com sucesso!');
        }

        return redirect()->route('dashboard.buckets')->with('error', 'Não autorizado a deletar este bucket.');
    }

    public function index(Request $request)
    {
        $params = $request->query();

        return Bucket::where('user_id', $request->user()->id)->paginate($params['per_page'] ?? 15, ['*'], 'page', $params['page'] ?? 1);
    }

    public function showIndex(Request $request)
    {
        return view('dashboard.buckets.index', [
            'buckets' => Bucket::where('user_id', $request->user()->id)->get(),
        ]);
    }

    public function showFiles(Request $request, Bucket $bucket)
    {
        $isAuthorized = $request->user()->id === $bucket->user_id;

        if ($isAuthorized) {
            return view('dashboard.buckets.files.index', [
                'bucket' => $bucket,
                'files' => Storage::disk('ftp')->files($bucket->name),
            ]);
        }

        return redirect()->route('dashboard.buckets')->with('error', 'Não autorizado a acessar este bucket.');
    }

    public function show(Request $request, Bucket $bucket)
    {
        $isAuthorized = $request->user()->id === $bucket->user_id;

        if ($isAuthorized) {
            return view('dashboard.buckets.show', [
                'bucket' => $bucket,
            ]);
        }

        return redirect()->route('dashboard.buckets')->with('error', 'Não autorizado a acessar este bucket.');
    }
}