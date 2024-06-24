<?php
        include_once("../php/bd.php");
    ?>
           <h2>Модификация</h2>

                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Клиент</th>
                        <th>Тип</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Дата</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM modifications";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM modifications" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM clients where id = '$supplier[client_id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $rows['name'] . "</td>";
                            echo "<td>" .  $supplier['modification_type'] . "</td>";
                            echo "<td>" .  $supplier['modification_description'] . "</td>";
                            echo "<td>" .  $supplier['modification_cost'] . "</td>";
                            echo "<td>" .  $supplier['modification_date'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['client_id'])) and !empty($_POST['modification_type']) and !empty($_POST['modification_description']) and !empty($_POST['modification_cost']) and !empty($_POST['modification_date'])){
        $client_id=$_POST['client_id'];
        $modification_type=$_POST['modification_type'];
        $modification_description=$_POST['modification_description'];
        $modification_cost=$_POST['modification_cost'];
        $modification_date=$_POST['modification_date'];

        
        mysqli_query($conn, "INSERT INTO `modifications` (`id`, `client_id`, `modification_type`, `modification_description`, `modification_cost`, `modification_date`) VALUES (NULL, '$client_id', '$modification_type', '$modification_description', '$modification_cost','$modification_date')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>

        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Клиент</p>
            <select name='client_id'>
             <?php $querys = mysqli_query($conn,"SELECT * FROM clients ");
             while($rows = mysqli_fetch_assoc($querys)){
                 echo '<option value='.$rows['id'].'>'.  $rows['name'] .'</option>';
             }?>
            </select>
            <p>Тип</p>
            <input class="form_for-text" type="text" name="modification_type">
            <p>Описание</p>
            <input class="form_for-text" type="text"  name="modification_description"> <br> 
            <p>Цена</p>
            <input class="form_for-text" type="text"  name="modification_cost"> <br> 
            <p>Дата</p>
            <input class="form_for-text" type="date"  name="modification_date"> <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM modifications where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM modifications" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Клиент</p>
                            <select name='client_id'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM clients ");
                            while($rows = mysqli_fetch_assoc($querys)){
                                echo '<option value='.$rows['id'].'>'.  $rows['name'] .'</option>';
                            }
                            echo "
                            </select>
                            
                            <p>Тип</p>
                            <input class='form_for-text' type='text' required name='modification_type' value='{$supplier['modification_type']}'/>
    
                            <p>Описание</p>
                            <input class='form_for-text' type='text' required name='modification_description' value='{$supplier['modification_description']}'/>
                            <p>Цена</p>
                            <input class='form_for-text' type='text' required name='modification_cost' value='{$supplier['modification_cost']}'/>
                            <p>Дата</p>
                            <input class='form_for-text' type='text' required name='modification_date' value='{$supplier['modification_date']}'/>
                        <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>  </div>';
                
                if (!empty($_POST['update'])){
                    $client_id=$_POST['client_id'];
                    $modification_type=$_POST['modification_type'];
                    $modification_description=$_POST['modification_description'];
                    $modification_cost=$_POST['modification_cost'];
                    $modification_date=$_POST['modification_date'];
                    mysqli_query($conn, "UPDATE `modifications` SET `client_id` = '$client_id', `modification_type` = '$modification_type', `modification_description` =  '$modification_description', `modification_cost` = '$modification_cost',  `modification_date` = '$modification_date' where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM modifications WHERE id = {$_GET['del_id']}");        
                }   
            ?>