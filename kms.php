<html>
<title>KMS Switch Page</title>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: fashioncj
 * Date: 2016/8/29
 * Time: 14:34
 */
if (isset($_GET["state"])) {
    //0->open
    //1->close
    $state = $_GET["state"];
    if ($state == 0) {
        $pid = system("ps |grep kms-server", $result);
        if (explode(" ", $pid)[0] < 1) {
            system("kms-server", $result);
            if ($result == 0) {
                echo "<br>KMS started.";
            }
        } else {
            echo "<br>KMS already started.";
        }
    } else {
        $pid = system("ps |grep kms-server", $result);
        $pid = explode(" ", $pid)[0];
        if ($pid > 1) {
            echo 'kill ' . $pid;
            system("kill " . $pid, $result);
            echo $result;
            if ($result == 0) {
                echo "<br>KMS killed.";
            } else {
                echo "<br>KMS killed fail.";
            }
        } else {
            echo "<br>KMS Already killed.";
        }
    }
} else {
    $pid = system("ps |grep kms-server", $result);
    echo "<br>now kms pid:";
    echo explode(" ", $pid)[0];
}
?>
<p><a href="https://blog.chenjia.me/articles/160330-213214.html">How to use?</a></p>

<form target="_self" method="get" action="kms.php?state=0">
    <input type="hidden" name="state" value="0">
    <input type="submit" value="Open!">
</form>

<form target="_self" method="get" action="kms.php?state=1">
    <input type="hidden" name="state" value="1">
    <input type="submit" value="Close!">
</form>

</body>
</html>
