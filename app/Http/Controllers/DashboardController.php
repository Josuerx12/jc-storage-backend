<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Credencial;
use App\Models\File;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->guard('web')->user()->id;
        
        $buckets = Bucket::where('user_id', $userId)->get();
        $credentials = Credencial::where('user_id', $userId)->get();

        $filesCount = $buckets->isNotEmpty()
            ? File::whereIn('bucket_id', $buckets->pluck('id'))->count()
            : 0;

        return view('dashboard.index', compact('buckets', 'credentials', 'filesCount'));
    }
}
