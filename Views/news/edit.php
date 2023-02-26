<?php 
/* @var array $data */
?>
<!-- views/article/edit.php -->

<h1>Edytuj newsa</h1>

<form method="post" action="/news/edit/<?php echo $data[0]['news_id']; ?>">

    <input type="hidden" name="_method" value="PUT">

    <label for="title">Tytuł:</label>
    <input type="text" id="title" name="title" value="<?php echo $data[0]['title']; ?>" required>
    <br><br>

    <label for="text">Tekst:</label>
    <textarea id="text" name="text" rows="8" cols="50" required><?php echo $data[0]['text']; ?></textarea>
    <br><br>


    <p><strong>Autorzy:</strong></p>

    <ul>
        <?php foreach ($data[1] as $author): ?>
        <li><?php echo $author['name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <button type="submit">Save</button>

</form>

