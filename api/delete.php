<?php 
require('../config.php');

if($method === 'delete') {

    $id = filter_input(INPUT_GET, 'id');
        
    if($id) {

        $sql = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {

            $sql = $pdo->prepare('DELETE FROM notes WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();

            $array['result'] = 'Registro DELETADO com sucesso';

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
        '405' => 'Method Not Allowed - Allowed Method DELETE'
    ];
}

require('../return.php');