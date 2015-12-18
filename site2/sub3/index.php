<?php
    $found     = FALSE;
    $real_root = dirname(__FILE__);

    do {
        $file = $real_root . '/.docroot';
        if (0 === strpos($real_root, $_SERVER['DOCUMENT_ROOT'])) {
            if (glob($file)) {
                $found = TRUE;
                if (substr($real_root, -1) !== '/') {
                    $real_root .= '/';
                }
            } else {
                $real_root = dirname($real_root);
            }
        } else {
            $found = TRUE;
        }
    } while (! $found);
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>
</head>
<body>
    <table>
        <tr> <td>Document Root</td> <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td> </tr>
        <tr> <td>File Path</td> <td><?php echo __FILE__; ?></td> </tr>
        <tr> <td>Site Root</td> <td><?php echo $real_root; ?></td> </tr>
    </table>
    <ul><li><a href="../../">The top-level site</a>
        <li><a href="../">The second site's root</a></ul>
    <?php include $real_root . 'footer.php'; ?>
</body>
</html>

