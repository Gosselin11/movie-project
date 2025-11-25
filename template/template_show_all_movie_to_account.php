<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des films</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .movie {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .movie h2 {
            margin: 0;
            color: #333;
        }

        .movie p {
            margin: 5px 0;
        }

        .publish-date {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>

<body>
    <h1>Liste des films</h1>

    <?php if (!empty($data["movies"])): ?>
        <?php foreach ($data["movies"] as $movie): ?>
            <div class="movie">
                <h2><?= htmlspecialchars($movie["title"]) ?></h2>
                <p><?= htmlspecialchars($movie["description"]) ?></p>
                <p class="publish-date">
                    Publié le : <?= htmlspecialchars($movie["publish_at"]) ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun film disponible pour le moment.</p>
    <?php endif; ?>
</body>

</html>