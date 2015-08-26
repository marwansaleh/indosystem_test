<?php
# Challenge 1

function create_matrix(){
    for($col=1; $col<=5; $col++){
        for ($row=1; $row<=5; $row++){
            echo $row * $col . ' ';
        }
        echo PHP_EOL;
    }
}

create_matrix();
