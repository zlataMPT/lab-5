
<?php
        include_once("../php/bd.php");
    ?>
    
        <h2>Реализованные проекты</h2>
          
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Машина</th>
                        <th>Модельный ряд</th>
                        <th>Что сделали</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM cars_accessories";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM cars_accessories" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM accessories where id = '$supplier[accessory_id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['car_make'] . "</td>";
                            echo "<td>" .  $supplier['car_model'] . "</td>";
                            echo "<td>" .  $rows['accessory_description'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['car_make']) and !empty($_POST['car_model'])  and !empty($_POST['accessory_id']))){
        $car_make=$_POST['car_make'];
        $car_model=$_POST['car_model'];
        $accessory_id=$_POST['accessory_id'];
        mysqli_query($conn, "INSERT INTO `cars_accessories` (`id`, `car_make`, `car_model`, `accessory_id`) VALUES (null,'$car_make', '$car_model', '$accessory_id')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>

        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Машина</p>
            <input class="form_for-text" type="text" name="car_make">
            <p>Модельный ряд</p>
            <input class="form_for-text" type="text" name="car_model">
            <p>Что сделали</p>
            <select name="accessory_id" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM accessories ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['accessory_description'] . '</option>';
            }
            ?>
            </select>
             <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM cars_accessories where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM cars_accessories" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Машина</p>
                            <input class='form_for-text' type='text' required name='car_make' value='{$supplier['car_make']}'/>
                            <p>Модельный ряд</p>
                            <input class='form_for-text' type='text' required name='car_model' value='{$supplier['car_model']}'/>
                            <p>Что сделали</p>
                            <select name='accessory_id'>
                           ";
                           $querys = mysqli_query($conn,"SELECT * FROM accessories ");
                           while($rows = mysqli_fetch_assoc($querys)){
                               echo '<option value='.$rows['id'].'>'.  $rows['accessory_description'] .'</option>';
                           } 
                           echo "
                           </select>
                            
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $car_make=$_POST['car_make'];
                    $car_model=$_POST['car_model'];
                    $accessory_id=$_POST['accessory_id'];
                    mysqli_query($conn, "UPDATE `cars_accessories` SET `car_make` = '$car_make', `car_model` = '$car_model', `accessory_id` = '$accessory_id' where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM cars_accessories WHERE id = {$_GET['del_id']}");        
                }   
            ?>
