<?php
    echo $this->Form->create();
    echo $this->Form->input('username');
    echo $this->Form->input('password');
 	echo $this->Form->input('role');

    echo $this->Form->select(
    'category_id',
    [1, 2, 3, 4, 5],
    ['empty' => '(choose one)']
    
);
    echo $this->Form->button(__('Registrarse'));
    echo $this->Form->end();
?>