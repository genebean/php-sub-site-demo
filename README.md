This is a demo of having a site inside a site and letting PHP figure out where
each site's root is. Once the "real_root" is found it is used to prefix any
PHP or HTML includes. The structure of the site looks like this:

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
