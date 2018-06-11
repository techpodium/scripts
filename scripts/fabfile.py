from __future__ import with_statement
from fabric.api import local, lcd
import os

def deploy(version):
    deploy_dir = '/opt/wordpress/wp-content/release-{}'.format(version)
    themes_target = '/opt/wordpress/wp-content/themes'
    wp_plugins_target = '/opt/wordpress/wp-content/plugins'
    mu_plugins_target = '/opt/wordpress/wp-content/mu-plugins'

    #TODO: Need to delete themes, plugins, mu-plugins folders defore first time deploy

    if os.path.isdir(deploy_dir):
        if os.path.isfile(themes_target):
            local('unlink' + themes_target)
            local('unlink' + wp_plugins_target)
            local('unlink' + mu_plugins_target)
        local('rm -rf ' + deploy_dir)

    local('mkdir {}'.format(deploy_dir))
    with (lcd('/opt/temp-release-folder')):
        local('cp -r . ' + deploy_dir)

    local('sudo find %s -type d -exec chmod 755 {} \;' % deploy_dir)
    local('sudo find %s -type f -exec chmod 644 {} \;' % deploy_dir)
    local('sudo chown -R www-data:www-data {};'.format(deploy_dir))

    if os.path.islink(themes_target):
        local('sudo rm /opt/wordpress/wp-content/previous-release-themes; sudo mv {} /opt/wordpress/wp-content/previous-release-themes'.format(themes_target))
        local('sudo rm /opt/wordpress/wp-content/previous-release-wp-plugins; sudo mv {} /opt/wordpress/wp-content/previous-release-wp-plugins'.format(wp_plugins_target))
        local('sudo rm /opt/wordpress/wp-content/previous-release-mu-plugins; sudo mv {} /opt/wordpress/wp-content/previous-release-mu-plugins'.format(mu_plugins_target))
    local('sudo ln -sf {0}/themes {1}'.format(deploy_dir, themes_target))
    local('sudo ln -sf {0}/plugins {1}'.format(deploy_dir, wp_plugins_target))
    local('sudo ln -sf {0}/mu-plugins {1}'.format(deploy_dir, mu_plugins_target))
    local('sudo systemctl restart php7.0-fpm.service')

# TODO
# def rollback():
#     target = '/opt/wordpress/wp-content/themes'
#     local('sudo rm {}; sudo mv /opt/wordpress/wp-content/previous-release {}'.format(target))
#     # local('sudo service php7.0-fpm.service restart')
