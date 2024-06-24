<?php
        include_once("../php/bd.php");
    ?>
     <h2>Клиенты</h2>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>ФИО</th>
                        <th>Номер Телефон</th>
                        <th>Почта</th>
                        <th>Марка машины</th>
                        <th>Модель машины</th>
                        <th>Год машины</th>
                        <th>Цвет машины</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM clients";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM clients" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                           
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['name'] . "</td>";
                            echo "<td>" .  $supplier['phone_number'] . "</td>";
                            echo "<td>" .  $supplier['email'] . "</td>";
                            echo "<td>" .  $supplier['car_make'] . "</td>";
                            echo "<td>" .  $supplier['car_model'] . "</td>";
                            echo "<td>" .  $supplier['car_year'] . "</td>";
                            echo "<td>" .  $supplier['car_color'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name'])) and !empty($_POST['phone_number']) and !empty($_POST['email']) and !empty($_POST['car_make']) and !empty($_POST['car_model']) and !empty($_POST['car_year']) and !empty($_POST['car_color'])){
        $name=$_POST['name'];
        $phone_number=$_POST['phone_number'];
        $email=$_POST['email'];
        $car_make=$_POST['car_make'];
        $car_model=$_POST['car_model'];
        $car_year=$_POST['car_year'];
        $car_color=$_POST['car_color'];
        mysqli_query($conn, "INSERT INTO `clients` (`id`, `name`, `phone_number`, `email`, `car_make`, `car_model`, `car_year`,`car_color`) VALUES (NULL, '$name', '$phone_number', '$email', '$car_make','$car_model','$car_year', '$car_color')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
   
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>ФИО</p>
            <input class="form_for-text" type="text" name="name">
            <p>Номер Телефон</p>
            <input class="form_for-text" type="text" name="phone_number">
            <p>Почта</p>
            <input class="form_for-text" type="email" name="email"> <br> 
            <p>Марка машины</p>
            <input class="form_for-text" type="text"  name="car_make"> <br> 
            <p>Модель машины</p>
            <input class="form_for-text" type="tel"  name="car_model"> <br> 
            <p>Год машины</p>
            <input class="form_for-text" type="text"  name="car_year"> <br> 
            <p>Цвет машины</p>
            <input class="form_for-text" type="text"  name="car_color"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM clients where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM clients" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>ФИО</p>
                            <input class='form_for-text' type='text' required name='name' value='{$supplier['name']}'/>
                            <p>Номер Телефон</p>
                            <input class='form_for-text' type='text' required name='phone_number' value='{$supplier['phone_number']}'/>
                            <p>Почта</p>
                            <input class='form_for-text' type='email' required name='email' value='{$supplier['email']}'/>
                            <p>Марка машины</p>
                            <input class='form_for-text' type='text' required name='car_make' value='{$supplier['car_make']}'/>
                            <p>Модель машины</p>
                            <input class='form_for-text' type='text' required name='car_model' value='{$supplier['car_model']}'/>
                            <p>Год машины</p>
                            <input class='form_for-text' type='text' required name='car_year' value='{$supplier['car_year']}'/>
                            <p>Цвет машины</p>
                            <input class='form_for-text' type='text' required name='car_color' value='{$supplier['car_color']}'/>
                        ";
                    }
                echo '<br><br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $name=$_POST['name'];
                    $phone_number=$_POST['phone_number'];
                    $email=$_POST['email'];
                    $car_make=$_POST['car_make'];
                    $car_model=$_POST['car_model'];
                    $car_year=$_POST['car_year'];
                    $car_color=$_POST['car_color'];
                    mysqli_query($conn, "UPDATE `clients` SET `name` = '$name', `phone_number` = '$phone_number',
                     `email` =  '$email', `car_make` = '$car_make',  `car_model` = '$car_model', `car_year` = '$car_year',
                      `car_color` = '$car_color'  where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM clients WHERE id = {$_GET['del_id']}");        
                }   
            ?>
