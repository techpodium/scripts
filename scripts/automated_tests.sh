AUTO_TEST_DIR="/var/lib/jenkins/workspace/Automation*Test"

org_string=$APP_NAME
APP_DIR=${APP_NAME%.*}
TEST_CONFIG="tests/acceptance.suite.yml"
HEADLESS_CONFIG="/var/lib/jenkins/chrome_headless.config"

host={{host_environment}}

if [ $host = "local" ]
then
   testUrl=" url: http:\/\/"$APP_NAME".local"
else
   testUrl=" url: https:\/\/"$APP_NAME".stage.postmedia.digital\/"
fi


cd $AUTO_TEST_DIR/$APP_DIR
chmod a+w $TEST_CONFIG
cp -f $HEADLESS_CONFIG ./.

#Replace the original url with testing url
sed -i "s/[^#]url.*/$testUrl/" $TEST_CONFIG

#Add lines for headless chrome browser
sed -i '/browser: chrome.*/r chrome_headless.config' $TEST_CONFIG

rm -f chrome_headless.config

#Clean the output file in test/_output
chmod -R a+w tests/_output
rm -rf tests/_output/*

#Run Acceptance test
codecept run acceptance