<form method="post">
<?php
    echo "<span>Share contact information of <b>". $firstName . "</b> with following users</span>";
    echo "<br>";
    echo "</table>";
    echo "<table>";
    echo "<th></th>";
    echo "<th>Users</th>";
    echo "<tbody>";
    foreach($data as $dt)
    {
        echo "<tr><td>";
        echo CHtml::checkBox( $dt->id,'',array('class'=>'selectTarget') );
        echo "</td>";
        echo "<td>";
        echo $dt->user_name;
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
?>
    <br>
<div class="row submit">
    <?php echo CHtml::submitButton('Share'); ?>
</div>
</form>
<style>
    table, th, td {
        border : 1px solid #ddd;
    }
    table{
        width : 100%;
    }
    th{
        background-color : #EBF7FB;
    }
</style>
