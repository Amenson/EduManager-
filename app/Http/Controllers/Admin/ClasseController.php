<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClasseRequest;
use App\Models\Classe;
use App\Models\User;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::with('titulaire')->orderBy('nom')->paginate(15);

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.form', [
            'classe' => new Classe(),
            'enseignants' => User::where('role', 'enseignant')->orderBy('nom')->get(),
            'action' => route('admin.classes.store'),
            'method' => 'POST',
            'title' => 'Nouvelle classe',
        ]);
    }

    public function store(ClasseRequest $request)
    {
        $data = $request->validated();

        Classe::create($data);

        return redirect()->route('admin.classes.index')->with('success', 'Classe creee avec succes.');
    }

    public function edit(Classe $classe)
    {
        return view('admin.classes.form', [
            'classe' => $classe,
            'enseignants' => User::where('role', 'enseignant')->orderBy('nom')->get(),
            'action' => route('admin.classes.update', $classe),
            'method' => 'PUT',
            'title' => 'Modifier classe',
        ]);
    }

    public function update(ClasseRequest $request, Classe $classe)
    {
        $data = $request->validated();

        $classe->update($data);

        return redirect()->route('admin.classes.index')->with('success', 'Classe mise a jour avec succes.');
    }

    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()->route('admin.classes.index')->with('success', 'Classe supprimee avec succes.');
    }
}
