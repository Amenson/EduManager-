<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MatiereRequest;
use App\Models\Matiere;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::orderBy('nom')->paginate(15);

        return view('admin.matieres.index', compact('matieres'));
    }

    public function create()
    {
        return view('admin.matieres.form', [
            'matiere' => new Matiere(),
            'action' => route('admin.matieres.store'),
            'method' => 'POST',
            'title' => 'Nouvelle matiere',
        ]);
    }

    public function store(MatiereRequest $request)
    {
        $data = $request->validated();

        Matiere::create($data);

        return redirect()->route('admin.matieres.index')->with('success', 'Matiere creee avec succes.');
    }

    public function edit(Matiere $matiere)
    {
        return view('admin.matieres.form', [
            'matiere' => $matiere,
            'action' => route('admin.matieres.update', $matiere),
            'method' => 'PUT',
            'title' => 'Modifier matiere',
        ]);
    }

    public function update(MatiereRequest $request, Matiere $matiere)
    {
        $data = $request->validated();

        $matiere->update($data);

        return redirect()->route('admin.matieres.index')->with('success', 'Matiere mise a jour avec succes.');
    }

    public function destroy(Matiere $matiere)
    {
        $matiere->delete();

        return redirect()->route('admin.matieres.index')->with('success', 'Matiere supprimee avec succes.');
    }
}
