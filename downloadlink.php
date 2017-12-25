<?php
$dir ="uploads ";

if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          ?>
            <!-- echo "<a href='download.php?file=".$entry."'>".$entry."</a>\n"; -->
            <a href="download1.php?file=<?php echo $entry;?>"><?php echo "$entry"; ?></a> <br>

        <?php
        }
    }
    closedir($handle);
}
?>
