<?php
require_once './config/config.php';

// Controllers
require_once './controllers/UsuarioController.php';
require_once './controllers/CupomController.php';
require_once './controllers/ProdutoController.php';

// CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

// Roteamento
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];
$segments = explode('/', $uri);

$recurso = $segments[0] ?? null;
$acao = $segments[1] ?? null;

switch ($recurso) {
    case 'usuario':
        $controller = new UsuarioController();
        tratarRotas($controller, $acao, $method);
        break;

    case 'cupom':
        $controller = new CupomController();
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
    echo json_encode(["erro" => "Rota não encontrada"]);
}

function metodoInvalido() {
    http_response_code(405);
    echo json_encode(["erro" => "Método HTTP não permitido"]);
}
?>