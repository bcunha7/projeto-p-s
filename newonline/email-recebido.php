<?php
require 'model/Conexao.php';
require 'model/Chamado.php';

$chamado = new Chamado();
// Configurações de e-mail
$emailUsuario = 'network-online@outlook.com.br';
$senhaUsuario = 'Ironman0203!';
$servidorIMAP = '{outlook.office365.com:993/imap/ssl}INBOX'; // Corrija o servidor IMAP conforme necessário

// Conecte-se à caixa de correio usando IMAP
$imap = imap_open($servidorIMAP, $emailUsuario, $senhaUsuario);

// Verifique se a conexão foi bem-sucedida
if (!$imap) {
    die('Não foi possível conectar ao servidor IMAP.');
}

// Busque todos os e-mails não lidos
$emailsNaoLidos = imap_search($imap, 'UNSEEN');

if ($emailsNaoLidos) {
    // Loop através dos e-mails não lidos
    foreach ($emailsNaoLidos as $emailId) {
        // Obtenha o cabeçalho e o corpo do e-mail
        $cabecalho = imap_headerinfo($imap, $emailId);
        $corpoHTML = imap_body($imap, $emailId);
        $padrao = '/Content-Transfer-Encoding: quoted-printable(.*?)##/s';

        $remetente = $cabecalho->fromaddress;
        $assunto = $cabecalho->subject;
        $decodedSubject = imap_mime_header_decode($assunto);
        foreach ($decodedSubject as $part) {
            $chaCodigo = $chamado->extrairCodigoChamado($part->text); // Implemente essa função conforme sua necessidade
            echo $chaCodigo;
        }

        preg_match($padrao, $corpoHTML, $correspondencias);
        $conteudoDesejado = isset($correspondencias[1]) ? $correspondencias[1] : '';
        // Obtenha apenas os dados necessários para a interação
        $remetente = $cabecalho->fromaddress;

        // Adicionar interação ao chamado correspondente
        $interacaoAdicionada = $chamado->adicionarInteracao($chaCodigo, $conteudoDesejado, $remetente,1);

        // Marcar o e-mail como lido se a interação foi adicionada com sucesso
        if ($interacaoAdicionada) {
            imap_setflag_full($imap, $emailId, "\\Seen");
        }
    }
}

// Feche a conexão IMAP
imap_close($imap);

