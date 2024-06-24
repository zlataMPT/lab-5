 
    <?php
        include_once("../php/bd.php");
    ?>
    <h2>Аксессуары</h2>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Описание</th>
                        <th>Затраты</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM accessories";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM accessories" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['accessory_name'] . "</td>";
                            echo "<td>" .  $supplier['accessory_description'] . "</td>";
                            echo "<td>" .  $supplier['accessory_cost'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['accessory_name'])) and !empty($_POST['accessory_description'])  and !empty($_POST['accessory_cost'])){
        $name_category=$_POST['accessory_name'];
        $accessory_description=$_POST['accessory_description'];
        $accessory_cost=$_POST['accessory_cost'];
    
        mysqli_query($conn, "INSERT INTO `accessories` (`id`, `accessory_name`, `accessory_description`,`accessory_cost`) VALUES (NULL, '$name_category', '$accessory_description','$accessory_cost')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Наименование</p>
            <input type="text" name="accessory_name"><br>
            <p>Описание</p>
            <input type="text" name="accessory_description"><br>
            <p>Затраты</p>
            <input type="text" name="accessory_cost"><br><br>
            <input type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM accessories where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM accessories" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Наименование</p>
                            <input class='form_for-text' type='text' required name='accessory_name' value='{$supplier['accessory_name']}'/>
                            <p>Описание</p>
                            <input class='form_for-text' type='text' required name='accessory_description' value='{$supplier['accessory_description']}'/>
                            <p>Затраты</p>
                            <input class='form_for-text' type='text' required name='accessory_cost' value='{$supplier['accessory_cost']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $name_category=$_POST['accessory_name'];
                    $accessory_description=$_POST['accessory_description'];
                    $accessory_cost=$_POST['accessory_cost'];
                  
                    // $query = "UPDATE `accessories` SET `accessory_name` = '$accessory_name', `accessory_description` = '$accessory_description', `accessory_cost` = '$accessory_cost' where id = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `accessories` SET `accessory_name` = '$accessory_name', `accessory_description` = '$accessory_description', `accessory_cost` = '$accessory_cost' where id = {$_GET['red_id']}");
                    // var_dump($query);
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM accessories WHERE id = {$_GET['del_id']}");        
                }   
            ?>
