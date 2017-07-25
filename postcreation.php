<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];

        if(isset($_POST['type'])) {
            include_once("database.php");
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($post['type'] == 'people'){
                $people = new People($user['username'], $post['type'],$post['comment'], 
                $post['price'], date("d/m/Y H:i"), $post['job'], [$post['firstschedule1'],
                $post['firstschedule2'],$post['secondschedule1'],
                $post['secondschedule2']]
                );

                $database->addPostSQL($people, 'people');
            }

            if ($post['type'] == 'transport'){
                $transport = new Transport($user['username'], $post['date'], $post['type'],
                $post['comment'], $post['price'], date("d/m/Y H:i"), $post['start'], $post['hstart'],
                $post['finish'], $post['hend'], $post['seats'], $post['car']
                );

                $database->addPostSQL($transport, 'transport');
            }

            if ($post['type'] == 'housing'){
                $housing = new Housing($user['username'], $post['type'],$post['comment'], 
                $post['price'], date("d/m/Y H:i"), $post['housetype'], $post['cycle'], $post['address']
                );

                $database->addPostSQL($housing, 'housing');
            }
        }
    }
?>