<?php require '../root-finder.php'?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $url_prefix;?>css/style.css">
</head>
<body>
    <table>
        <tr> <td>Document Root</td> <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td> </tr>
        <tr> <td>File Path</td> <td><?php echo __FILE__; ?></td> </tr>
        <tr> <td>Site Root</td> <td><?php echo $real_root; ?></td> </tr>
        <tr> <td>URL Prefix</td> <td><?php echo $url_prefix; ?></td> </tr>
        <tr> <td>Style Sheet Path</td> <td><?php echo $url_prefix;?>css/style.css</td> </tr>
    </table>
    <ul><li><a href="../../">The top-level site</a>
        <li><a href="../">The second site's root</a></ul>
    <?php include $real_root . 'footer.php'; ?>
</body>
</html>

