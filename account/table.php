
<?php
include 'header.php';
require_once('../php/bd.php');

$conn = mysqli_connect("localhost", "root", "", "sakura");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SHOW FULL TABLES FROM sakura WHERE TABLE_TYPE != 'VIEW';";
$result = mysqli_query($conn, $sql);

// Проверка на успешность выполнения запроса
if ($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<link rel="stylesheet" href="../css/table.css">';
    echo '<section class="account">';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Название таблицы</th>';
    echo '<th>Действия</th>'; // Заголовок столбца для ссылок
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
      switch ($row['Tables_in_sakura']) {
        case 'accessories':
          $tables = 'аксессуары';
          $href = 'accessories.php';
          break;
        case 'cars_accessories':
          $tables = 'Реализованные проекты';
          $href = 'cars_accessories.php';
          break;
        case 'clients':
          $tables = 'Клиенты';
          $href = 'clients.php';
          break;
        case 'modifications':
          $tables = 'Модификации';
          $href = 'modifications.php';
          break;
        case 'payments':
          $tables = 'Платежи';
          $href = 'payments.php';
          break;
        case 'users':
          $tables = 'Админка';
          $href = 'users.php';
          break;
        case 'work_schedule':
          $tables = 'График работы';
          $href = 'work_schedule.php';
          break;
        default:
      }
      echo '<tr>';
      echo '<td>' . $tables . '</td>';
      echo '<td><a href="../tables/' . $href . '">Просмотр</a></td>'; // Ссылка на страницу таблицы
      echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</section>';
  } else {
    echo "Нет таблиц для отображения.";
  }
} else {
  echo "Ошибка запроса: " . mysqli_error($conn);
}

// Закрытие соединения
mysqli_close($conn);
