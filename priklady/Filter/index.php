<?php
$clanky = [
    [
        "name" => "Save the bees",
        "category" => "nature",
        "text" => "Text prvniho clanku #saveTheBees"
    ],
    [
        "name" => "Odhaleni! Grader cryptoscam",
        "category" => "tech",
        "text" => "Lorem Ipsum Grader"
    ],
    [
        "name" => "Linus Tech Tips",
        "category" => "tech",
        "text" => "Uncle Linus"
    ],
    [
        "name" => "A plane just crashed into the towers",
        "category" => "planes",
        "text" => "Wow"
    ]
];

$kategorie = array_unique(array_column($clanky, 'category'));

if (isset($_GET['category'])) {
    $vybranaKategorie = $_GET['category'];
    $clanky = array_filter($clanky, fn($clanek) => $clanek['category'] === $vybranaKategorie);
} else {
    $vybranaKategorie = '';
}
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrace článků</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <section class="main">
        <div class="container">
            <form method="GET">
                <select name="category">
                    <option value="" disabled <?= $vybranaKategorie === '' ? 'selected' : '' ?>>Vyberte kategorii</option>
                    <?php foreach ($kategorie as $kategorieJedna): ?>
                        <option value="<?= $kategorieJedna ?>" <?= $vybranaKategorie === $kategorieJedna ? 'selected' : '' ?>>
                            <?= ucfirst($kategorieJedna) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Filtrovat</button>
            </form>
            <table id="customers">
                <thead>
                    <tr>
                        <th>Název</th>
                        <th>Kategorie</th>
                        <th>Text</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($clanky) > 0): ?>
                        <?php foreach ($clanky as $clanek): ?>
                            <tr>
                                <td><?= htmlspecialchars($clanek['name']) ?></td>
                                <td><?= htmlspecialchars($clanek['category']) ?></td>
                                <td><?= htmlspecialchars($clanek['text']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Žádné články nebyly nalezeny.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>

<script src="index.js"></script>