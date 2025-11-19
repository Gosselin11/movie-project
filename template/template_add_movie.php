<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?></title>
</head>

<body>
    <main class="container">
        </h1>
        <h1>Ajouter un film</h1>
        <form action="" method="post">
            <input type="text" name="title" placeholder="Saisir un titre">
            <input type="text" name="description" placeholder="Saisir votre description">
            <input type="date" name="publishAt" placeholder="Saisir la date de sortie">
            <input type="number" name="duration" placeholder="Saisir la durée">
            <input type="text" name="cover" placeholder="placez une description de l'image ici">
            <input type="text" name="category" placeholder="Saisir la categorie">
            <input type="submit" value="Ajouter" name="submit">
        </form>
        <p><?= $data["error"] ?? "" ?></p>
        <p><?= $data["valid"] ?? "" ?></p>
    </main>
</body>

</html>