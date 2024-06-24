
<?php
        include_once("../php/bd.php");
    ?>
<h2>Платежи</h2>
     
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Заказ</th>
                        <th>Дата</th>
                        <th>Сумма</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM payments";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM payments" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM modifications where id = '$supplier[modification_id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $rows['modification_type'] . "</td>";
                            echo "<td>" .  $supplier['payment_date'] . "</td>";
                            echo "<td>" .  $supplier['payment_amount'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>

            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['modification_id'])) and !empty($_POST['payment_date']) and !empty($_POST['payment_amount'])){
        $modification_id=$_POST['modification_id'];
        $payment_date=$_POST['payment_date'];
        $payment_amount=$_POST['payment_amount'];
        mysqli_query($conn, "INSERT INTO `payments` (`id`, `modification_id`, `payment_date`, `payment_amount`) VALUES (NULL, '$modification_id', '$payment_date', '$payment_amount')");
        header("Refresh:0");
    }else {
       
        echo "заполните все поля";
    }
}
?>
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Заказ</p>
            <select name="modification_id" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM modifications ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['modification_type'] . '</option>';
            }
            ?>
            </select>
            <p>Дата</p>
            <input class="form_for-text" type="date" name="payment_date">
            <p>Сумма</p>
            <input class="form_for-text" type="text" name="payment_amount"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM payments where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM payments" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Заказ</p>
                            <select name='modification_id'>
                           ";
                           $querys = mysqli_query($conn,"SELECT * FROM modifications ");
                            while($rows = mysqli_fetch_assoc($querys)){
                               echo '<option value='.$rows['id'].'>'.  $rows['modification_type'] .'</option>';
                           } 
                           echo "
                           </select>
                           <p>Дата</p>
                            <input class='form_for-text' type='date' required name='payment_date' value='{$supplier['payment_date']}'/>
                            <p>Сумма</p>
                            <input class='form_for-text' type='text' required name='payment_amount' value='{$supplier['payment_amount']}'/>
                           
                         <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form> </div>';
                
                if (!empty($_POST['update'])){
                    $modification_id=$_POST['modification_id'];
                    $payment_date=$_POST['payment_date'];
                    $payment_amount=$_POST['payment_amount'];
                    mysqli_query($conn, "UPDATE `payments` SET `modification_id` = '$modification_id', `payment_date` = '$payment_date',  `payment_amount` =  '$payment_amount' where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM payments WHERE id = {$_GET['del_id']}");        
                }   
            ?>
