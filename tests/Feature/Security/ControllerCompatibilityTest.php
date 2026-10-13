<?php

use App\Models\Alumnus;

test('project administration controllers instantiate and preserve route permissions', function () {
    $this->get('/admin/projects')->assertRedirect(route('login'));
    $this->actingAs(securityUser('tecnico'))->get('/admin/projects')->assertRedirect(route('login'));
    $this->actingAs(securityUser('admin'))->get('/admin/projects')->assertOk();
    $this->get('/admin/projects/create')->assertOk();
});

test('protected alumni controller instantiates and requires authentication', function () {
    $alumnus = Alumnus::create(['nome' => 'Alumni Teste', 'curso' => 'Engenharia Informática', 'ano' => 2025, 'contacto' => 'alumni@example.test', 'trabalha' => false, 'publicado' => true]);
    $url = route('alumni.show.protected', $alumnus->id);
    $this->get($url)->assertRedirect(route('login'));
    $this->actingAs(securityUser('alumni'))->get($url)->assertOk();
});
