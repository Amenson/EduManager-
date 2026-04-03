<?php
// tests/Feature/EleveTest.php
namespace Tests\Feature;

use App\Models\{User, Eleve, Classe};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EleveTest extends TestCase {
    use RefreshDatabase;

    public function test_admin_peut_creer_un_eleve(): void {
        $admin = User::factory()->create(['role' => 'admin']);
        $classe = Classe::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/eleves', [
            'nom'            => 'Dupont',
            'prenom'         => 'Jean',
            'email'          => 'jean.dupont@ecole.tg',
            'date_naissance' => '2010-05-15',
            'lieu_naissance' => 'Lomé',
            'sexe'           => 'M',
            'classe_id'      => $classe->id,
        ]);

        $response->assertRedirect(route('admin.eleves.index'));
        $this->assertDatabaseHas('eleves', ['matricule' => Eleve::latest()->first()->matricule]);
    }

    public function test_eleve_ne_peut_pas_acceder_admin(): void {
        $eleve = User::factory()->create(['role' => 'eleve']);
        $response = $this->actingAs($eleve)->get('/admin/eleves');
        $response->assertStatus(403);
    }
}
