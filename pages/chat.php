<?php
require __DIR__ . '/../conexao.php';

header('Content-Type: text/plain; charset=utf-8');

$msgOriginal = trim($_POST['msg'] ?? '');

if (!$msgOriginal) {
    echo "Por favor, escreva sua dúvida 😊";
    exit;
}

/* ========================= */
/*   FUNÇÕES                 */
/* ========================= */

function normalizar($texto) {
    $texto = mb_strtolower($texto, 'UTF-8');
    $de = ['á','à','ã','â','ä','é','è','ê','ë','í','ì','î','ï','ó','ò','õ','ô','ö','ú','ù','û','ü','ç'];
    $para = ['a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c'];
    return str_replace($de, $para, $texto);
}

function contem($texto, $palavras) {
    foreach ($palavras as $p) {
        if (strpos($texto, $p) !== false) return true;
    }
    return false;
}

/* ========================= */
/*   HISTÓRICO & APRENDIZADO */
/* ========================= */

function salvarHistorico($conn, $msg, $resp) {
    $stmt = $conn->prepare("INSERT INTO historico_chat (mensagem_usuario, resposta_bot) VALUES (?, ?)");
    $stmt->bind_param("ss", $msg, $resp);
    $stmt->execute();
}

function aprender($conn, $msg, $resp) {
    $stmt = $conn->prepare("SELECT id, vezes FROM aprendizado_chat WHERE pergunta = ?");
    $stmt->bind_param("s", $msg);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $novaVezes = $row['vezes'] + 1;

        $update = $conn->prepare("UPDATE aprendizado_chat SET vezes = ? WHERE id = ?");
        $update->bind_param("ii", $novaVezes, $row['id']);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO aprendizado_chat (pergunta, resposta) VALUES (?, ?)");
        $insert->bind_param("ss", $msg, $resp);
        $insert->execute();
    }
}

/* ========================= */
/*   NORMALIZAÇÃO            */
/* ========================= */

$msg = normalizar($msgOriginal);

/* ========================= */
/*   APRENDIZADO (PRIORIDADE)*/
/* ========================= */

$stmt = $conn->prepare("SELECT resposta FROM aprendizado_chat WHERE pergunta = ? ORDER BY vezes DESC LIMIT 1");
$stmt->bind_param("s", $msgOriginal);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
    salvarHistorico($conn, $msgOriginal, $row['resposta']);
    echo $row['resposta'];
    exit;
}

/* ========================= */
/*   INTENÇÕES               */
/* ========================= */

/* AGRADECIMENTO */
if (contem($msg, ['obrigado','obrigada','obg','vlw','valeu','agradeco','agradecido','thanks','ajudou','funcionou','resolveu'])) {
    $resposta = [
        "Eu que agradeço! 😊 Sempre que precisar, estou por aqui!",
        "De nada! Fico feliz em ter ajudado 😄",
        "Que bom que deu certo! Se precisar de mais algo, é só chamar 😉",
        "Imagina! 😊 Qualquer dúvida pode voltar aqui!"
    ];
    $resp = $resposta[array_rand($resposta)];

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* SAUDAÇÃO */
if (preg_match('/^(oi|ola|olá|bom dia|boa tarde|boa noite|eae|fala)/', $msg)) {
    $resp = "Olá! 😊 Como posso te ajudar hoje?";

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* ACESSO */
if (contem($msg, ['acessar','entrar','abrir']) && contem($msg, ['pagina','paginas','aba','abas','plataforma','curso'])) {
    $resp = "Para acessar todas as páginas, você precisa fazer login primeiro 😊";

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* LOGIN */
if (contem($msg, ['login','entrar na conta','acessar conta'])) {
    $resp = "Para fazer login, informe seu e-mail e senha na tela inicial. Se não lembrar, use 'Recuperar senha'. 😊";

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* SENHA */
if (contem($msg, ['senha','esqueci','recuperar'])) {
    $resp = "Se esqueceu sua senha, clique em 'Recuperar senha' na tela de login e siga as instruções 😊";

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* FOTO */
if (contem($msg, ['foto','imagem','perfil'])) {
    $resp = "Para alterar sua foto, vá até o seu perfil e clique em 'Alterar foto'. 😊";

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* CERTIFICADO */
if (contem($msg, ['certificado','cert','diploma'])) {
    $resp = "Atualmente, a plataforma não disponibiliza certificados. 😊";

    salvarHistorico($conn, $msgOriginal, $resp);
    aprender($conn, $msgOriginal, $resp);

    echo $resp;
    exit;
}

/* ========================= */
/*   FAQ                     */
/* ========================= */

$result = $conn->query("SELECT * FROM faq");

$melhor = null;
$scoreMax = 0;

while ($row = $result->fetch_assoc()) {

    $textoFaq = normalizar($row['pergunta'] . ' ' . $row['palavras_chave']);
    $score = 0;

    $palavrasUsuario = explode(' ', $msg);

    foreach ($palavrasUsuario as $p) {
        if (strlen($p) < 3) continue;

        if (strpos($textoFaq, $p) !== false) {
            $score++;
        }
    }

    if ($score > $scoreMax) {
        $scoreMax = $score;
        $melhor = $row['resposta'];
    }
}

if ($scoreMax >= 1) {
    salvarHistorico($conn, $msgOriginal, $melhor);
    aprender($conn, $msgOriginal, $melhor);

    echo $melhor;
    exit;
}

/* ========================= */
/*   FALLBACK                */
/* ========================= */

$resp = "Hmm 🤔 não entendi muito bem. Você pode perguntar sobre login, senha, perfil ou cursos. Estou aqui para te ajudar! 😊";

salvarHistorico($conn, $msgOriginal, $resp);
aprender($conn, $msgOriginal, $resp);

echo $resp;