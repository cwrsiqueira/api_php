<?php 
require('../config.php');

if($method === 'post') {

    $title = filter_input(INPUT_GET, 'title');
    $body = filter_input(INPUT_GET, 'body');
    
    if($title && $body) {

        $sql = $pdo->prepare('INSERT INTO notes SET title = :title, body = :body');
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body,
        ];
        
    } else {
        $array['error'] = [
            '412' => 'Precondition Failed - Campos não preenchidos'
        ];
    }

} else {
    $array['error'] = [
        '405' => 'Method Not Allowed - Allowed Method POST'
    ];
}

require('../return.php');