#!/usr/bin/env zsh
###################################################################
# @Author: huangxiolu
# @Created Time : 六  4/29 17:52:38 2017
#
# @File Name: tmp.sh
# @Description:
###################################################################
cd /private/etc/               && sudo rm -rf php-fpm.conf.default php.ini php.ini.default
cd /usr/bin/               && sudo rm -rf php php-config phpdoc phpize
cd /usr/include                && sudo rm -rf php
cd /usr/lib                && sudo rm -rf php
cd /usr/sbin               && sudo rm -rf php-fpm
cd /usr/share              && sudo rm -rf php
cd /usr/share/man/man1         && sudo rm -rf php-config.1 php.1 phpize.1
cd /usr/share/man/man8         && sudo rm -rf php-fpm.8
