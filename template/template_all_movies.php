<!DOCTYPE html>
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
    <?php include 'component/navbar.php' ?>
    <main class="container">
        <h1>Liste des films</h1>
        <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"] == true) : ?>
            <?php foreach ($data as $movie): ?>
                <p id="<?= $movie["id"] ?>"><?= $movie["title"] ?></p>

                <tr>
                    <td><?= $movie["title"] ?></td>
                    <td><?= $movie["description"] ?></td>
                    <td><?= $movie["publish_at"] ?></td>
                    <td><?= $movie["categories"] ?></td>
                </tr>
            <?php endforeach ?>

            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date de sortie</th>
                        <th>Catégories</th>
                    </tr>
                </thead>
            <?php else : ?>
                <p>Veuillez vous connecter pour voir la liste des films.</p>
            <?php endif; ?>
            </table>
    </main>
</body>

</html>