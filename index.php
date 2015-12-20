<?php require 'root-finder.php' ?>

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
    <ul><li><a href="site2">Second website in a subfolder</a>
        <li><a href="site2/sub3">A folder inside the second site</a></ul>
    <?php require $real_root . 'footer.php'; ?>
</body>
</html>

