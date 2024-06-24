<?php
        include_once("../php/bd.php");
    ?>
   <h2>График работы</h2>
        
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>День Недели</th>
                        <th>Открытие</th>
                        <th>Закрытие</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM work_schedule";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM work_schedule" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['day_of_week'] . "</td>";
                            echo "<td>" .  $supplier['open_time'] . "</td>";
                            echo "<td>" .  $supplier['close_time'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
           
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['day_of_week'])) and !empty($_POST['open_time']) and !empty($_POST['close_time'])){
        $day_of_week=$_POST['day_of_week'];
        $open_time=$_POST['open_time'];
        $close_time=$_POST['close_time'];
        mysqli_query($conn, "INSERT INTO `work_schedule` (`id`, `day_of_week`, `open_time`,`close_time`) VALUES (NULL, '$day_of_week', '$open_time', '$close_time')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
  
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>День Недели</p>
            <input  type="text" name="day_of_week"><br>
            <p>Открытие</p>
            <input  type="text" name="open_time"><br>
            <p>Закрытие</p>
            <input  type="text" name="close_time"><br><br>
            <input type="submit" name="submit" value="Добавить">
        </form>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM work_schedule where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM work_schedule" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>День Недели</p>
                            <input class='form_for-text' type='text' required name='day_of_week' value='{$supplier['day_of_week']}'/>
                            <p>Открытие</p>
                            <input class='form_for-text' type='text' required name='open_time' value='{$supplier['open_time']}'/>
                            <p>Закрытие</p>
                            <input class='form_for-text' type='text' required name='close_time' value='{$supplier['close_time']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $day_of_week=$_POST['day_of_week'];
                   
                    mysqli_query($conn, "UPDATE `work_schedule` SET `day_of_week` = '$day_of_week', `open_time` = '$open_time',  `close_time` = '$close_time' where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM work_schedule WHERE id = {$_GET['del_id']}");        
                }   
            ?>