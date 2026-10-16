<?php

test('administrators can activate and deactivate the public application form', function () {
    $this->get(route('candidaturas'))
        ->assertOk()
        ->assertDontSee('name="bi"', false);

    $this->post(route('candidaturas.store'))->assertForbidden();

    $this->actingAs(securityUser('admin'))
        ->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '1'])
        ->assertRedirect(route('admin.configuracoes'))
        ->assertSessionHas('success');

    $this->get(route('candidaturas'))
        ->assertOk()
        ->assertSee('name="bi"', false);

    $this->post(route('candidaturas.store'))->assertRedirect();

    $this->patch(route('admin.configuracoes.update'), ['candidaturas_ativas' => '0'])
        ->assertRedirect(route('admin.configuracoes'))
        ->assertSessionHas('success');

    $this->get(route('candidaturas'))
        ->assertOk()
        ->assertDontSee('name="bi"', false);

    $this->post(route('candidaturas.store'))->assertForbidden();
});
