<?php 
require('../config.php');

if($method === 'put') {

    $id = filter_input(INPUT_GET, 'id');
    $title = filter_input(INPUT_GET, 'title');
    $body = filter_input(INPUT_GET, 'body');
    
    if($id && $title && $body) {

        $sql = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {

            $sql = $pdo->prepare('UPDATE notes SET title = :title, body = :body WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            $array['result'] = [
                'id' => $id,
                'title' => $title,
                'body' => $body,
            ];

        } else {
            $array['error'] = 'ID inexistente';
        }
        
    } else {
        $array['error'] = [
            '412' => 'Precondition Failed - Campos não preenchidos'
        ];
    }

} else {
    $array['error'] = [
        '405' => 'Method Not Allowed - Allowed Method PUT'
    ];
}

require('../return.php');