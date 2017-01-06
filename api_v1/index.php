<?php

require '../vendor/autoload.php';
require_once './ControladorCategoria.php';
require_once './ControladorEvento.php';
require_once './ControladorEventoConfirmado.php';
require_once './ControladorGrupo.php';
require_once './ControladorUsuario.php';

$app = new Slim\App();

// MÉTODOS CATEGORIA
$app->group('/categoria', function () {
    $this->post('/inserir', 'ControladorCategoria:inserir');
    $this->put('/atualizar_id', 'ControladorCategoria:atualizar_id');
    $this->delete('/remover_id', 'ControladorCategoria:remover_id');
    $this->get('/get_id', 'ControladorCategoria:get_id');
});

// MÉTODOS EVENTO
$app->group('/evento', function () {
    $this->post('/inserir', 'ControladorEvento:inserir');
    $this->put('/atualizar_id', 'ControladorEvento:atualizar_id');
    $this->delete('/remover_id', 'ControladorEvento:remover_id');
    $this->get('/get_id', 'ControladorEvento:get_id');
    $this->get('/get_idCategoria', 'ControladorEvento:get_idCategoria');
    $this->get('/get_idUsuario', 'ControladorEvento:get_idUsuario');
});

// MÉTODOS EVENTOCONFIRMADO
$app->group('/eventoconfirmado', function () {
    $this->post('/inserir', 'ControladorEventoConfirmado:inserir');
    $this->delete('/remover_id', 'ControladorEventoConfirmado:remover_id');
    $this->get('/get_idUsuario', 'ControladorEventoConfirmado:get_idUsuario');
    $this->get('/get_idEvento', 'ControladorEventoConfirmado:get_idEvento');
});

// MÉTODOS GRUPO
$app->group('/grupo', function () {
    $this->post('/inserir', 'ControladorGrupo:inserir');
    $this->put('/atualizar_id', 'ControladorGrupo:atualizar_id');
    $this->delete('/remover_id', 'ControladorGrupo:remover_id');
    $this->get('/get_id', 'ControladorGrupo:get_id');
});

// MÉTODOS USUARIO
$app->group('/usuario', function () {
    $this->post('/inserir', 'ControladorUsuario:inserir');
    $this->put('/atualizar_id', 'ControladorUsuario:atualizar_id');
    $this->put('/atualizar_telefone', 'ControladorUsuario:atualizar_telefone');
    $this->put('/atualizargcm', 'ControladorUsuario:atualizarGCM');
    $this->delete('/remover_id', 'ControladorUsuario:remover_id');
    $this->delete('/remover_telefone', 'ControladorUsuario:remover_telefone');
    $this->get('/get_id', 'ControladorUsuario:get_id');
    $this->get('/get_telefone', 'ControladorUsuario:get_telefone');
});

$app->run();
