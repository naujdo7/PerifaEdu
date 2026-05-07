<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../config/config_env.php';

header('Content-Type: text/plain; charset=utf-8');

$msgOriginal = trim($_POST['msg'] ?? '');

if (!$msgOriginal) {
    echo "Por favor, escreva sua dúvida 😊";
    exit;
}

/* ========================= */
/*   FUNÇÕES                 */
/* ========================= */

function chamarGroq($mensagem) {
    $apiKey = defined('GROQ_API_KEY') ? GROQ_API_KEY : '';
    if (!$apiKey) return "Desculpe, estou com problemas técnicos no momento. (API Key não configurada)";

    $url = "https://api.groq.com/openai/v1/chat/completions";
    
    $contexto = "Você é o assistente virtual da PerifaEdu, uma plataforma de educação gratuita voltada para a periferia.
    Sua única função é responder dúvidas relacionadas à área da educação e ao funcionamento da plataforma PerifaEdu.
    
    RESTRIÇÕES IMPORTANTES:
    - Responda APENAS sobre educação (matérias escolares, exercícios, apostilas) e sobre o site PerifaEdu.
    - Se o usuário perguntar sobre assuntos fora da educação (ex: fofocas, esportes, lazer, política não educacional, receitas de comida, etc.), você deve responder educadamente que sua função é apenas auxiliar com dúvidas educacionais e sobre a plataforma.
    - NÃO responda perguntas sobre outros temas, mesmo que você saiba a resposta.
    
    Informações sobre o site:
    - Login: Informe e-mail e senha na tela inicial.
    - Recuperar senha: Use a opção 'Esqueci a senha' no login.
    - Alterar foto: Vá no 'Meu Perfil' e clique na foto ou em 'Alterar foto'.
    - Outras abas (APOSTILAS/CURSOS): Para acessar outras abas como 'APOSTILAS' e 'CURSOS', o aluno deve fazer login e clicar nelas na parte superior da tela.
    - Objetivo: Educação gratuita e acessível para todos.
    
    Se o aluno mandar um exercício, resolva, dê a resposta e explique brevemente.
    Responda de forma educada, concisa e direta.
    Ao final de cada resposta, seja educado e pergunte se pode ajudar em mais alguma coisa.
    Use alguns emojis para tornar a conversa amigável, mas sem exageros.
    Não use respostas muito longas.";

    $data = [
        "model" => "llama-3.3-70b-versatile",
        "messages" => [
            ["role" => "system", "content" => $contexto],
            ["role" => "user", "content" => $mensagem]
        ],
        "temperature" => 0.7,
        "max_tokens" => 500
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $apiKey
    ]);
    
    // Desabilitar verificação SSL para evitar problemas em alguns ambientes locais/infinityfree (opcional)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) return "Erro ao processar sua dúvida. Tente novamente.";

    $resData = json_decode($response, true);
    return $resData['choices'][0]['message']['content'] ?? "Não consegui processar sua resposta agora. 😊";
}

function salvarHistorico($conn, $msg, $resp) {
    // Verificar se a tabela existe antes de inserir (opcional, para evitar erros se não estiver criada)
    $stmt = $conn->prepare("INSERT INTO historico_chat (mensagem_usuario, resposta_bot) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $msg, $resp);
        $stmt->execute();
    }
}

/* ========================= */
/*   EXECUÇÃO                */
/* ========================= */

// Respostas rápidas (opcional para economizar tokens em saudações simples)
$msgBaixa = mb_strtolower($msgOriginal, 'UTF-8');

if ($msgBaixa == 'oi' || $msgBaixa == 'ola') {
    $resp = "Olá! 😊 Como posso te ajudar hoje?";
} elseif (strpos($msgBaixa, 'acessar outras abas') !== false || strpos($msgBaixa, 'outras abas') !== false) {
    $resp = "Para acessar outras abas do site, como 'APOSTILAS' e 'CURSOS', basta fazer o login na plataforma e clicar nelas na parte superior da tela. Isso permitirá que você navegue pelas diferentes seções da plataforma PerifaEdu. Posso te ajudar com mais alguma coisa? 😊";
} else {
    // Chamar a IA para qualquer outra dúvida
    $resp = chamarGroq($msgOriginal);
}

salvarHistorico($conn, $msgOriginal, $resp);
echo $resp;
?>