<?php
// para facilitar a visualização de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/config/config.php';

// Controllers
require_once __DIR__ . '/controllers/UsuarioController.php';
require_once __DIR__ . '/controllers/LojaController.php';
require_once __DIR__ . '/controllers/ProdutoController.php';

// Roteamento
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];
$segments = explode('/', $uri);

// Ajuste conforme a posição correta na URL
$recurso = $segments[2] ?? null; // usuario
$acao = $segments[3] ?? null;    // cadastrar


switch ($recurso) {
    case 'usuario':
        $controller = new UsuarioController();
        tratarRotas($controller, $acao, $method);
        break;

    case 'loja':
        $controller = new LojaController();
        tratarRotas($controller, $acao, $method);
        break;

    case 'produto':
        $controller = new ProdutoController();
        tratarRotas($controller, $acao, $method);
        break;

    default:
        rotaNaoEncontrada();
}

function tratarRotas($controller, $acao, $method) {
    switch ($acao) {
        case 'consultar':
            if ($method === 'GET') $controller->consultar();
            else metodoInvalido();
            break;

        case 'cadastrar':
            if ($method === 'POST') $controller->cadastrar();
            else metodoInvalido();
            break;

        case 'atualizar':
            if ($method === 'POST') $controller->atualizar();
            else metodoInvalido();
            break;

        case 'deletar':
            if ($method === 'POST') $controller->deletar();
            else metodoInvalido();
            break;

        default:
            rotaNaoEncontrada();
    }
}

function rotaNaoEncontrada() {
    http_response_code(404);
    echo json_encode(["erro" => "Rota nao encontrada"]);
}

function metodoInvalido() {
    http_response_code(405);
    echo json_encode(["erro" => "Método HTTP nao permitido"]);
}
?>