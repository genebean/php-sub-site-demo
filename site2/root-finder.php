<?php
$found = FALSE;
$real_root = dirname(__FILE__);

do {
    $file = $real_root . '/.docroot';
    if (0 === strpos($real_root, $_SERVER['DOCUMENT_ROOT'])) {
        if (glob($file)) {
            $found = TRUE;
            $url_prefix = substr($real_root, strlen($_SERVER['DOCUMENT_ROOT']));

            $url_prefix = str_replace('\\','/',$url_prefix);

            if ($url_prefix === $_SERVER['REQUEST_URI']) {
                $url_prefix = '.';
            } else {
                if (strlen($url_prefix) == 0) {
                    $url_prefix .= '/';
                    $arr = explode($url_prefix, $_SERVER['REQUEST_URI']);
                    $arr = array_slice($arr, 0, -1);
                    $url_prefix = implode('/', $arr);
                } else {
                    $arr = explode($url_prefix, $_SERVER['REQUEST_URI']);
                    $url_prefix = $arr[0] . $url_prefix;
                }
            }

            if (substr($real_root, -1) !== '/') {
                $real_root  .= '/';
                $url_prefix .= '/';
            }
        } else {
            $real_root  = dirname($real_root);
        }
    } else {
        $last_dir_in_root = end(explode('/',$real_root));
        $url_prefix = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], $last_dir_in_root)) . $last_dir_in_root . '/';
        $found = TRUE;
    }
} while (!$found);
?>

