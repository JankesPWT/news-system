<!-- views/article/create.php -->

<h1>Nowy news</h1>

<form method="post" action="/news/create">

    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <br><br>
    
    <label for="text">Text:</label>
    <textarea id="text" name="text" rows="8" cols="50" required></textarea>
    <br><br>

    <label for="authors">Authors:</label>
    <input type="text" id="author" name="author" required>
    
    <br>

    <button type="submit">Save</button>

</form>
