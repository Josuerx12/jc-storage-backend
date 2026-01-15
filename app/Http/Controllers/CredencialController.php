<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCredentialRequest;
use App\Models\Credencial;
use Illuminate\Http\Request;

class CredencialController extends Controller
{
    public function index(Request $request)
    {
        $credentials = Credencial::where('user_id', auth()->guard('web')->user()->id)->where('name', 'like', '%' . $request->query('search') ?? '' . '%')->paginate(10);

        return view('dashboard.credentials.index', compact('credentials'));
    }

    public function store(StoreCredentialRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $credential = Credencial::create([
            'user_id' => auth()->guard('web')->user()->id,
            'name' => $request->name,
            'access_key' => $request->access_key ?? bin2hex(random_bytes(16)),
            'secret_key' => $request->secret_key ?? bin2hex(random_bytes(32)),
        ]);

        return redirect()->route('dashboard.credentials')->with('success', 'Credencial criada com sucesso.');
    }

    public function create(Request $request)
    {
        return view('dashboard.credentials.create');
    }

    public function show(Request $request, Credencial $credential)
    {
        $isAuthorized = $credential->user_id === auth()->guard('web')->user()->id;

        if (! $isAuthorized) {
            return redirect()->route('dashboard.credentials')->with('error', 'Você não tem permissão para ver esta credencial.');
        }

        return view('dashboard.credentials.show', compact('credential'));
    }

    public function delete(Request $request, Credencial $credential)
    {
        $isAuthorized = $credential->user_id === auth()->guard('web')->user()->id;

        if (! $isAuthorized) {
            return redirect()->route('dashboard.credentials')->with('error', 'Você não tem permissão para deletar esta credencial.');
        }

        return view('dashboard.credentials.delete', compact('credential'));
    }

    public function destroy(Request $request, Credencial $credential)
    {
        $isAuthorized = $credential->user_id === auth()->guard('web')->user()->id;

        if (! $isAuthorized) {
            return redirect()->route('dashboard.credentials')->with('error', 'Você não tem permissão para deletar esta credencial.');
        }

        $credential->delete();

        return redirect()->route('dashboard.credentials')->with('success', 'Credencial deletada com sucesso.');
    }
}
