<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Services\BulletinService;

class BulletinController extends Controller
{
    public function __construct(private BulletinService $bulletinService)
    {
    }

    public function show(string $trimestre)
    {
        $eleve = auth()->user()->eleve;
        abort_unless($eleve, 404);

        $data = $this->bulletinService->buildBulletinData($eleve, $trimestre, now()->year);

        return view('bulletins.show', $data);
    }
}
