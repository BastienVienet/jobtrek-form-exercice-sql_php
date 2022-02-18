<a href="index.php">Link to the form >></a> <br><br>

<?php

require_once './connecting_DSN.php';

//Display the user table database in the HTML

$stmt_all_data = $pdo->prepare('
SELECT *
FROM users
INNER JOIN users_has_addresses uha 
    on users.id_user = uha.users_id_user
INNER JOIN addresses a 
    on uha.addresses_id_address = a.id_address
INNER JOIN countries c 
    on a.countries_id_country = c.id_country
');

$stmt_all_data->execute([]);
// $user_all_data = $stmt_all_data->fetchAll();

/*  foreach ($user_all_data as $row) {
    echo "{$row['first_name']} - {$row['last_name']} - {$row['birthdate']} - {$row['email']} - {$row['phone']} - {$row['civility']} - {$row['sex']} - {$row['street']} - {$row['postal_code']} - {$row['city']} - {$row['country_name']}<br><br>";
}*/
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Testing php and db interactions</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>

<div class="columns is-multiline is-variable">
    <?php while ($rUAD = $stmt_all_data->fetch()) { ?>
        <div class="card is-child box column is-half">
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-48x48">
                            <img src="https://bulma.io/images/placeholders/96x96.png"
                                 alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4"> <?= $rUAD['first_name'] . " " . $rUAD['last_name'] ?></p>
                        <p class="subtitle is-6"><?= $rUAD['email'] ?></p>
                    </div>
                </div>
                <div class="content">
                    <p>Address
                       : <?= $rUAD['street'] . " / " . $rUAD['postal_code'] . " " . $rUAD['city'] . " / " . $rUAD['country_name'] ?></p>
                    <p>Phone number : <?= $rUAD['phone'] ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>