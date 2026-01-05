<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBucketRequest;
use App\Models\Bucket;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    public function store(StoreBucketRequest $request)
    {
        $data = $request->validated();

        Bucket::create([
            'name' => $data['name'],
            'user_id' => $request->user()->id,
        ]);
    }

    public function destroy(Request $request, Bucket $bucket)
    {
        $isAuthorized = $request->user()->id === $bucket->user_id;

        if ($isAuthorized) {
            $bucket->delete();
            return response()->noContent();
        }

        return response()->json(['message' => 'Não autorizado'], 403);
    }

    public function index(Request $request)
    {
        $params = $request->query();

        return Bucket::where('user_id', $request->user()->id)->paginate($params['per_page'] ?? 15, ['*'], 'page', $params['page'] ?? 1);
    }

    public function show(Request $request, Bucket $bucket)
    {
        $isAuthorized = $request->user()->id === $bucket->user_id;

        if ($isAuthorized) {
            return $bucket;
        }

        return response()->json(['message' => 'Não autorizado'], 403);
    }
}