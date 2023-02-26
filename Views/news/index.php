<?php 
/* @var array $data */
?>
<!-- views/news/index.php -->

<h1>News</h1>

<ul>
    <?php foreach ($data as $news): ?>
    <li>
        <a href="/news/<?= $news['news_id'] ?>"><?= $news['title'] ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<a href="/news/create">Nowy news</a>
