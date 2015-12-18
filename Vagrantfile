# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "centos-7-puppet"

  if Vagrant.has_plugin?("vagrant-cachier")
    # Configure cached packages to be shared between instances of the same base box.
    # More info on http://fgrehm.viewdocs.io/vagrant-cachier/usage
    config.cache.scope = :box
  end

  config.vm.network "forwarded_port", guest: 80,   host: 8080

  config.vm.synced_folder ".", "/opt/rh/httpd24/root/var/www/html"

  config.vm.provision "shell", inline: <<-SHELL1
    yum -y install scl-utils
    yum -y install https://www.softwarecollections.org/en/scls/rhscl/httpd24/epel-7-x86_64/download/rhscl-httpd24-epel-7-x86_64.noarch.rpm
    yum -y install https://www.softwarecollections.org/en/scls/rhscl/rh-php56/epel-7-x86_64/download/rhscl-rh-php56-epel-7-x86_64.noarch.rpm
    yum -y install httpd24 rh-php56-php rh-php56-php-fpm rh-php56-php-cli rh-php56-php-common

    puppet resource service httpd24-httpd ensure=running enable=true
    puppet resource service rh-php56-php-fpm ensure=running enable=true

  SHELL1
end
