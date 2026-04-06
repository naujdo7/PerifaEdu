<?php
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// ── Só aceita POST ──
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido.']);
    exit;
}

// ── Conexão com o banco ──
require_once '../conexao.php';

// ── Função de resposta ──
function resposta(bool $ok, string $msg, array $extra = []): void {
    echo json_encode(array_merge(['sucesso' => $ok, 'mensagem' => $msg], $extra));
    exit;
}

// ── Sanitização ──
function limpar(string $valor): string {
    return htmlspecialchars(strip_tags(trim($valor)));
}

// ── Coleta e limpa os campos ──
$curso         = limpar($_POST['curso']            ?? '');
$curso_nome    = limpar($_POST['curso_nome']        ?? '');
$nome          = limpar($_POST['nome_completo']     ?? '');
$cpf           = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
$data_nasc     = limpar($_POST['data_nascimento']   ?? '');
$telefone      = preg_replace('/\D/', '', $_POST['telefone'] ?? '');
$email         = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$nome_mae      = limpar($_POST['nome_mae']          ?? '');
$nome_pai      = limpar($_POST['nome_pai']          ?? '');
$escolaridade  = limpar($_POST['escolaridade']      ?? '');
$escola        = limpar($_POST['escola']            ?? '');
$cep           = preg_replace('/\D/', '', $_POST['cep'] ?? '');
$bairro        = limpar($_POST['bairro']            ?? '');
$endereco      = limpar($_POST['endereco']          ?? '');
$cidade        = limpar($_POST['cidade']            ?? '');
$estado        = limpar($_POST['estado']            ?? '');
$deficiencia   = limpar($_POST['deficiencia']       ?? 'nao');
$como_conheceu = limpar($_POST['como_conheceu']     ?? '');
$observacoes   = limpar($_POST['observacoes']       ?? '');

// ── Validações ──
if (strlen($nome) < 5) {
    resposta(false, 'Nome completo inválido.');
}

if (strlen($cpf) !== 11 || !validarCPF($cpf)) {
    resposta(false, 'CPF inválido.');
}

if (empty($data_nasc)) {
    resposta(false, 'Data de nascimento inválida.');
}

if (strlen($telefone) < 10) {
    resposta(false, 'Telefone inválido.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    resposta(false, 'E-mail inválido.');
}

if (strlen($nome_mae) < 4) {
    resposta(false, 'Nome da mãe inválido.');
}

if (empty($escolaridade) || empty($escola)) {
    resposta(false, 'Preencha os dados de escolaridade.');
}

if (strlen($cep) !== 8 || empty($bairro) || empty($endereco) || empty($cidade) || empty($estado)) {
    resposta(false, 'Preencha o endereço completo.');
}

// ── Verifica CPF duplicado ──
$stmt = $conn->prepare("SELECT id FROM matriculas WHERE cpf = ? LIMIT 1");
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    resposta(false, 'Este CPF já possui uma inscrição cadastrada.');
}
$stmt->close();

// ── Insere no banco ──
// Colunas: 19 valores — tipos: 19 x "s"
$sql = "INSERT INTO matriculas (
    curso_slug, curso_nome, nome_completo, cpf, data_nascimento,
    telefone, email, nome_mae, nome_pai, escolaridade, escola,
    cep, bairro, endereco, cidade, estado,
    deficiencia, como_conheceu, observacoes,
    status, criado_em
) VALUES (
    ?, ?, ?, ?, ?,
    ?, ?, ?, ?, ?, ?,
    ?, ?, ?, ?, ?,
    ?, ?, ?,
    'pendente', NOW()
)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    resposta(false, 'Erro ao preparar consulta: ' . $conn->error);
}

// 19 parâmetros, todos string ("s")
$stmt->bind_param(
    "sssssssssssssssssss",
    $curso, $curso_nome, $nome, $cpf, $data_nasc,
    $telefone, $email, $nome_mae, $nome_pai, $escolaridade, $escola,
    $cep, $bairro, $endereco, $cidade, $estado,
    $deficiencia, $como_conheceu, $observacoes
);

if (!$stmt->execute()) {
    resposta(false, 'Erro ao registrar inscrição: ' . $stmt->error);
}

$id_inscricao = $stmt->insert_id;
$stmt->close();

// ── Sucesso ──
resposta(true, 'Inscrição realizada com sucesso!', [
    'id'    => $id_inscricao,
    'curso' => $curso_nome
]);

// ── Valida CPF ──
function validarCPF(string $cpf): bool {
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) return false;
    $soma = 0;
    for ($i = 0; $i < 9; $i++) $soma += (int)$cpf[$i] * (10 - $i);
    $r = 11 - ($soma % 11);
    if ($r >= 10) $r = 0;
    if ($r != (int)$cpf[9]) return false;
    $soma = 0;
    for ($i = 0; $i < 10; $i++) $soma += (int)$cpf[$i] * (11 - $i);
    $r = 11 - ($soma % 11);
    if ($r >= 10) $r = 0;
    return $r == (int)$cpf[10];
}