<?php 
/* @var array $data */
?>
<!-- views/author/top.php -->

<h1>Top autorzy</h1>

<table border=1>
    <thead>
    <tr>
        <th>Autor</th>
        <th>Liczba tekstów</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $top): ?>
            <tr>
                <td><?= $top['name'] ?></td>
                <td><?= $top['news_count'] ?></td>
            </tr>
        <?php endforeach; ?>    
    </tbody>
</table>
