<?php 
/* @var array $data */
?>
<!-- views/news/show.php -->

<h1><?php echo $data[0]['title']; ?></h1>

<p><?php echo nl2br($data[0]['text']); ?></p>

<p><strong>Autorzy:</strong></p>

<ul>
    <?php foreach ($data[1] as $author): ?>
    <li><?php echo $author['name']; ?></li>
    <?php endforeach; ?>
</ul>

<a href="/news/edit/<?php echo $data[0]['news_id']; ?>">Edit</a>
<a href="/news/delete/<?php echo $data[0]['news_id']; ?>">Delete</a>
