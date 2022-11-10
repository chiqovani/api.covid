<?php
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
uses(RefreshDatabase::class);

it('Test empty registration request', function () {
    $response = $this->post('/api/register');
    $response->assertSessionHasErrors();
});

it('Test registration request', function () {

    $response = $this->post('/api/register', [
        'name' => Str::random(5),
        'email' => Str::random(5).'@gmail.com',
        'password' => Str::random(8),
    ]);
    $result = $response->json();
    $this->assertDatabaseHas('users', ['email' => $result['user']['email']]);
    $this->assertDatabaseHas('personal_access_tokens', ['name' => $result['user']['email'] . '_token']);
});


it('Deleting Sanctum token after logout', function () {

    $user = User::factory()->create();
    Sanctum::actingAs(
        $user,
        ['*']
    );
    $response = $this->post('/api/logout');
    $response->assertOk();
    $this->assertDatabaseMissing('personal_access_tokens', ['name' => $user->email . '_token']);
});

it('Check if user is still logged in', function () {

    $user = User::factory()->create();
    Sanctum::actingAs(
        $user,
        ['*']
    );
    $response = $this->get('/api/check');
    $response->assertOk();
});
