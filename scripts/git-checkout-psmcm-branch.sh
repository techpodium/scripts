#!/bin/bash

job_name=$1
cd /var/lib/jenkins/workspace/$job_name/themes

# Themes
cd postmedia-theme-core
printf "Checking out postmedia-theme-core repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"

cd postmedia-theme-communities
printf "Checking out postmedia-theme-communities repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"

# Plugins
cd postmedia-plugins
printf "Checking out postmedia-wp-plugins repository"
cd dfp-ads
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd paywall-whitelist
printf "Checking out paywall-whitelist repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd pm-advertorial-plugin
printf "Checking out pm-advertorial-plugin repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd pn-socialmedia-widget
printf "Checking out pn-socialmedia-widget repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-geolocation
printf "Checking out postmedia-geolocation repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-library
printf "Checking out postmedia-library repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-newsroom
printf "Checking out postmedia-newsroom repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-custom-amp
printf "Checking out postmedia-plugin-custom-amp repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-layouts
printf "Checking out postmedia-plugin-layouts repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-longform
printf "Checking out postmedia-plugin-longform repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-newsletter
printf "Checking out postmedia-plugin-newsletter repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-snapgalleries
printf "Checking out postmedia-plugin-snapgalleries repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-sunshinegalleries
printf "Checking out postmedia-plugin-sunshinegalleries repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
cd postmedia-plugin-wcm-push
printf "Checking out postmedia-plugin-wcm-push repository"
git fetch --all
git checkout psmcm
git pull
cd ..
printf "\n"
