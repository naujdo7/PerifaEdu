<?php
require __DIR__ . '/../conexao.php';

/* =========================
   PEGAR MENSAGEM ORIGINAL
========================= */
$msgOriginal = strtolower(trim($_POST['msg'] ?? ''));

if (!$msgOriginal) {
    echo "Digite algo.";
    exit;
}

/* =========================
   🔥 DETECÇÃO DIRETA (ANTES DE TUDO)
========================= */

/* remove acento só pra checagem */
function removerAcentos($texto) {
    return preg_replace(
        array(
            "/(á|à|ã|â|ä)/i",
            "/(é|è|ê|ë)/i",
            "/(í|ì|î|ï)/i",
            "/(ó|ò|õ|ô|ö)/i",
            "/(ú|ù|û|ü)/i",
            "/(ç)/i"
        ),
        array("a","e","i","o","u","c"),
        $texto
    );
}

$msgCheck = removerAcentos($msgOriginal);

if(
    preg_match('/(acess|entrar|abrir)/', $msgCheck)
    &&
    preg_match('/(pagina|paginas|aba|abas)/', $msgCheck)
){
    echo "Faça login para acessar as outras páginas.";
    exit;
}

/* =========================
   PROCESSAMENTO NORMAL
========================= */

$msg = $msgCheck;

/* remove palavras inúteis */
$stopwords = ['como','eu','faco','para','de','da','do','a','o','e','que','as','os'];
$msg = str_replace($stopwords, '', $msg);

/* quebra frase */
$palavras = preg_split('/[\s,]+/', $msg);
$palavras = array_filter($palavras);

/* =========================
   BUSCA NO BANCO
========================= */

$query = "SELECT * FROM faq";
$result = $conn->query($query);

$melhorResposta = null;
$maiorScore = 0;

while($row = $result->fetch_assoc()){

    $score = 0;

    /* limpa palavras-chave */
    $chaves = strtolower($row['palavras_chave']);
    $chaves = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaves);
    $chaves = preg_split('/[\s,]+/', $chaves);
    $chaves = array_filter($chaves);

    /* comparação com peso */
    foreach($palavras as $p){

        foreach($chaves as $c){

            if(!empty($p) && !empty($c)){

                // match exato (peso maior)
                if($p === $c){
                    $score += 2;
                    break;
                }

                // match parcial
                if(strpos($p, $c) !== false || strpos($c, $p) !== false){
                    $score += 1;
                    break;
                }

            }

        }

    }

    if($score > $maiorScore){
        $maiorScore = $score;
        $melhorResposta = $row['resposta'];
    }
}

/* =========================
   RESPOSTA FINAL
========================= */

if($maiorScore > 0){
    echo $melhorResposta;
} else {

    if(strpos($msgCheck, "senha") !== false){
        echo "Você pode alterar sua senha no perfil.";
    } 
    elseif(strpos($msgCheck, "login") !== false){
        echo "Verifique seus dados ou recupere sua senha.";
    }
    else{
        echo "Hmm 🤔 não entendi. Tente perguntar sobre login, senha ou perfil.";
    }
}