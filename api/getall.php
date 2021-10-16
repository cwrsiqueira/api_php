<?php 
require('../config.php');

if($method === 'get') {
    $sql = $pdo->query('SELECT * FROM notes');
    if($sql->rowCount() > 0) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $item) {
            $array['result'][] = [
                'id' => $item['id'],
                'title' => $item['title']
            ];
        }
    }

} else {
    $array['error'] = [
        '405' => 'Method Not Allowed'
    ];
}

require('../return.php');