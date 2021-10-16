<?php 
require('../config.php');

if($method === 'get') {

    $id = filter_input(INPUT_GET, 'id');
    
    if($id) {
        $sql = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();
            
            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body'],
            ];
        } else {
            $array['error'] = [
                '404' => 'Not Found - ID not found'
            ];
        }
    } 

} else {
    $array['error'] = [
        '405' => 'Method Not Allowed - Allowed Method GET'
    ];
}

require('../return.php');