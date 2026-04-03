<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EleveRequest;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\User;
use App\Services\EleveService;
use Illuminate\Http\Request;

class EleveController extends Controller
{
    public function __construct(private EleveService $eleveService)
    {
    }

    public function index(Request $request)
    {
        $eleves = Eleve::query()
            ->with(['user', 'classe'])
            ->when($request->filled('classe_id'), fn ($query) => $query->where('classe_id', $request->integer('classe_id')))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery
                        ->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.eleves.index', [
            'eleves' => $eleves,
            'classes' => Classe::orderBy('nom')->get(),
        ]);
    }

    public function create()
    {
        return $this->formView(new Eleve(), route('admin.eleves.store'), 'POST', 'Nouvel eleve');
    }

    public function store(EleveRequest $request)
    {
        $this->eleveService->create($request->validated());

        return redirect()
            ->route('admin.eleves.index')
            ->with('success', 'Eleve inscrit avec succes.');
    }

    public function show(Eleve $eleve)
    {
        $eleve->load(['user', 'classe', 'parent', 'notes.matiere', 'absences', 'paiements']);

        return view('admin.eleves.show', ['eleve' => $eleve]);
    }

    public function edit(Eleve $eleve)
    {
        $eleve->load('user');

        return $this->formView($eleve, route('admin.eleves.update', $eleve), 'PUT', 'Modifier eleve');
    }

    public function update(EleveRequest $request, Eleve $eleve)
    {
        $eleve = $this->eleveService->update($eleve, $request->validated());

        return redirect()
            ->route('admin.eleves.show', $eleve)
            ->with('success', 'Eleve mis a jour avec succes.');
    }

    public function destroy(Eleve $eleve)
    {
        $this->eleveService->archive($eleve);

        return redirect()
            ->route('admin.eleves.index')
            ->with('success', 'Eleve archive avec succes.');
    }

    private function formView(Eleve $eleve, string $action, string $method, string $title)
    {
        return view('admin.eleves.form', [
            'eleve' => $eleve,
            'classes' => Classe::orderBy('nom')->get(),
            'parents' => User::where('role', 'parent')->orderBy('nom')->get(),
            'action' => $action,
            'method' => $method,
            'title' => $title,
        ]);
    }
}
