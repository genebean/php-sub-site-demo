This is a demo of having a site inside a site and letting PHP figure out where
each site's root is. This can be handy when you do not know ahead of time
whether your files will be in the document root or in a subfolder. Once the
"real_root" is found it is used to prefix any PHP or HTML includes. The
structure of the demo site looks like this:

```bash
$ tree -a
.
├── css
│   └── style.css
├── .docroot              # <-- denotes a sites's root directory
├── footer.php
├── index.php
├── README.md
├── root-finder.php
└── site2                 # <-- this is the start of a nested site
    ├── css
    ├── .docroot          # <-- denotes a sites's root directory
    ├── footer.php
    ├── index.php
    ├── root-finder.php
    └── sub3sub3
        └── index.php
```

The trick here is the placing of a `.docroot` in the root directory of each
site. PHP works up the tree until it finds this or it hits the web server's
document root. Once the root has been found it creates two PHP variables:
`$real_root` and `$url_prefix`. The first is the real file path to the site's
document root while the second is what to prefix URL's on your site with. Full
examples of both being used are in the three `index.php pages`.


### Use Case: Built-in PHP Webserver

In production your site is in the document root but while testing it is not.
If you use the webserver built into PHP your files are in the document root but
the URL is prefixed like
[http://localhost:63342/php-sub-site-demo/index.php][demo-site] which would
break a accessing CSS at `/css/style.css` because it would actually be at
`/php-sub-site-demo/css/style.css`.


### Use Case: Test server with each site in a sub directory

If you run your web sites with SSL then it is not practical to just make a
sub-domain for each site on your test server like many people have traditionally
done because you would have to buy a cert for each one if you want to avoid SSL
errors in your browsers. An alternate setup is to create a single document root
and place each site in a sub-folder. In this scenario you might end up with a
structure like the following in production:  

```bash
├── site1.example.com (this is a document root)
├── site2.example.com (this is a document root)
└── site3.example.com (this is a document root)
```

In your test environment, these same sites might also have multiple branches
as you work on new features and hotfixes. This might give you a structure like
so:

```bash
└── test.example.com (this is a document root)
    ├── test.example.com/index.php (provides links to all sub-sites)
    ├── test.example.com/site1__master/index.php
    ├── test.example.com/site1__develop/index.php
    ├── test.example.com/site1__feature__cool_new_thing/index.php
    ├── test.example.com/site1__feature__new_form/index.php
    ├── test.example.com/site1__hotfix__1.0.1/index.php
    |
    ├── test.example.com/site2__master/index.php
    ├── test.example.com/site2__develop/index.php
    |
    ├── test.example.com/site3__master/index.php
    └── test.example.com/site3__develop/index.php
```


### How using `root-finder.php` helps

The code in `root-finder.php` allows you to solve both of these issues. The
first can be solved by using the include on the first line in the code below and
combining that with the css reference shown. The pathing for additional includes
is demonstrated with the footer in the code samples. Sample 1 is in your root
directory while sample 2 is in a sub-folder. Take note that the only difference
between the two is on the first line.


#### Sample 1 (site index page):

```php
<?php require 'root-finder.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $url_prefix;?>css/style.css">
</head>
<body>
    <p> Hello World</p>
    <?php require $real_root . 'footer.php'; ?>
</body>
</html>
```


#### Sample 2 (sub-folder index page):

```php
<?php require '../root-finder.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $url_prefix;?>css/style.css">
</head>
<body>
    <p> Hello World</p>
    <?php require $real_root . 'footer.php'; ?>
</body>
</html>
```

[demo-site]: http://localhost:63342/php-sub-site-demo/index.php
