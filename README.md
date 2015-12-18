This is a demo of having a site inside a site
and letting PHP figure out where each site's
root is. Once the "real_root" is found it is
used to prefix any includes. The strucure of
the site looks like this:

```bash
$ tree -a
.
├── .docroot
├── footer.php
├── index.php
└── site2
    ├── .docroot
    ├── footer.php
    ├── index.php
    └── sub3
        └── index.php
```

The trick here is the placing of a `.docroot`
in the root directory of each site. PHP
works up the tree until it finds this or
it hits the web server's document root.

