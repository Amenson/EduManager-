<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('nom')->paginate(15);

        return view('admin.utilisateurs.index', compact('users'));
    }

    public function create()
    {
        return view('admin.utilisateurs.form', [
            'user' => new User(),
            'action' => route('admin.utilisateurs.store'),
            'method' => 'POST',
            'title' => 'Nouvel utilisateur',
        ]);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur cree avec succes.');
    }

    public function edit(User $utilisateur)
    {
        return view('admin.utilisateurs.form', [
            'user' => $utilisateur,
            'action' => route('admin.utilisateurs.update', $utilisateur),
            'method' => 'PUT',
            'title' => 'Modifier utilisateur',
        ]);
    }

    public function update(UserRequest $request, User $utilisateur)
    {
        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $utilisateur->update($data);

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur mis a jour avec succes.');
    }

    public function destroy(User $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur supprime avec succes.');
    }
}
