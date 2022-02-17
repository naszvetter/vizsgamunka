<?php

$esemenyek = [
    [
        'kategoria'=>'tenisz',
        'datum'=>'2022-02-28',
        'leiras'=>'hello hello hello játszanék',
    ],
    [
        'kategoria'=>'pingpong',
        'datum'=>'2022-03-01',
        'leiras'=>'hello hello hello játszanék pingpong is', 
    ]
];

foreach($esemenyek as $esemeny):
?>
    
<div>
<?= $esemeny['leiras']; ?>
</div>
    
<?php
endforeach;
?>