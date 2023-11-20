<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($lookup == 'cities') {
    $select = $conn->prepare("SELECT cities.name, cities.district, cities.population 
    FROM countries INNER JOIN cities ON countries.code = cities.country_code WHERE countries.name LIKE :country");
    $select->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
    $select->execute();
    $results = $select->fetchAll(PDO::FETCH_ASSOC);
} else {
    $select = $conn->prepare("SELECT * FROM countries WHERE countries.name LIKE :country");
    $select->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
    $select->execute();
    $results = $select->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php if ($lookup == 'cities'): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['continent']; ?></td>
                    <td><?= $row['independence_year']; ?></td>
                    <td><?= $row['head_of_state']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

