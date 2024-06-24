<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

  $user_check = $_SESSION['login_user'];
  $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
  $rows = mysqli_fetch_array($query);
  $names = $rows['name'];
  $status = $rows['admin'];
} else {
  header('Location index.php');
}
?>
<link rel='stylesheet' href='../css/style.css'>

<section class="sql-zaprosi-section">

  <div class="sql-zaprosi">
    <h2>SQL - Запросы</h2>
    <p>1. Получить список всех доступных услуг тюнингового центра.</p>

    <?php
    require_once('../php/bd.php');
    $sql = "SELECT * FROM accessories";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table><tr><th>Наименование</th><th>Описание</th><th>Стоимость</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["accessory_name"] . "</td><td>" . $row["accessory_description"] . "</td><td>" . $row["accessory_cost"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 результатов";
    }
    ?>
    <br><br>
    <p>2. Получить список всех автомобилей, доступных для тюнинга.</p>

    <?php
    $sql = "SELECT DISTINCT car_make, car_model FROM clients ORDER BY car_make, car_model";
    $results = mysqli_query($conn, $sql);
    echo '<table>
<thead>
<tr>
<th>Марка</th>
<th>Модель</th>
</tr>
</thead>
<tbody>';
    if ($results) {
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr><td>" . $row['car_make'] . "</td><td>" . $row['car_model'] . "</td></tr>";
      }
      echo '</table>';
    }
    ?>

    <br><br>
    <p>3. Получить список клиентов, заказавших тюнинговые услуги, включая детали заказов.</p>

    <?php

    $sql = "SELECT clients.name, modifications.modification_type, modifications.modification_description, modifications.modification_cost, modifications.modification_date
        FROM clients
        JOIN modifications ON clients.id = modifications.client_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<table><tr><th>ФИО</th><th>Услуга</th><th>Описание</th><th>Цена</th><th>Дата</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["modification_type"] . "</td><td>" . $row["modification_description"] . "</td><td>" . $row["modification_cost"] . "</td><td>" . $row["modification_date"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 результатов";
    }

    ?>
    <br><br>
    <p>4. Получить список клиентов и общую сумму, которую они потратили на тюнинговые услуги.</p>
    <?php

    $sql = "SELECT clients.name, SUM(modifications.modification_cost) AS total_cost
        FROM clients
        JOIN modifications ON clients.id = modifications.client_id
        GROUP BY clients.id";
    echo "
<table>
    <tr>
        <th>ФИО</th>
        <th>Прайс</th>
    </tr>";
    echo "";
    foreach ($conn->query($sql) as $row) {
      echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['total_cost'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";

    ?>
    <br><br>
    <p>5. Получить список самых популярных услуг тюнингового центра в порядке убывания количества заказов.</p>

    <?php

    $sql = "SELECT modifications.modification_type, COUNT(*) AS count
        FROM modifications
        GROUP BY modifications.modification_type
        ORDER BY count DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Услуга</th><th>Количество</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["modification_type"] . "</td><td>" . $row["count"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    ?>

    <br><br>
    <p>6. Получить список клиентов, у которых были сделаны заказы на определенную услугу (например, "Изменение кузова").</p>

    <?php

    $sql = "SELECT clients.name, modifications.modification_type
        FROM clients
        JOIN modifications ON clients.id = modifications.client_id
        WHERE modifications.modification_type = 'Изменение кузова'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>ФИО</th><th>Услуга</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["modification_type"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 результатов";
    }

    ?>
    <br><br>
    <p>7. Получить список услуг тюнингового центра, стоимость которых превышает определенную сумму (например, 1000).</p>

    <?php

    $sql = "SELECT *
        FROM accessories
        WHERE accessory_cost > 1000";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Услуга</th><th>Описание</th><th>Стоимость</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["accessory_name"] . "</td><td>" . $row["accessory_description"] . "</td><td>" . $row["accessory_cost"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

    ?>

    <br><br>
    <p>8. Получить список клиентов, у которых были сделаны заказы на тюнинг определенного автомобиля (например, "BMW").</p>

    <?php

    $sql = "SELECT clients.name, clients.car_make, clients.car_model
        FROM clients
        JOIN modifications ON clients.id = modifications.client_id
        WHERE clients.car_make = 'BMW'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>ФИО</th><th>Марка</th><th>Модель</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["car_make"] . "</td><td>" . $row["car_model"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

    ?>

    <br><br>
    <p>Получить список услуг тюнингового центра, отсортированный по стоимости услуги в порядке возрастания.</p>

    <?php

    $sql = "SELECT *
FROM accessories
ORDER BY accessory_cost ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Услуга</th><th>Описание</th><th>Прайс</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["accessory_name"] . "</td><td>" . $row["accessory_description"] . "</td><td>" . $row["accessory_cost"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

    ?>

    <br><br>
    <p>10. Получить список услуг тюнингового центра, которые были выполнены на определенном автомобиле (например, "BMW M5").</p>

    <?php

    $sql = "SELECT clients.car_make, clients.car_model, modifications.modification_type
        FROM clients
        JOIN modifications ON clients.id = modifications.client_id
        WHERE CONCAT(clients.car_make, ' ', clients.car_model) = 'BMW M5'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Марка</th><th>Модель</th><th>Услуга</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["car_make"] . "</td><td>" . $row["car_model"] . "</td><td>" . $row["modification_type"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

    ?>
  </div>

</section>