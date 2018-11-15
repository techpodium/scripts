import hudson.model.*

def thr = Thread.currentThread()
def build = thr?.executable
def PROMOTED_NUMBER = build.getEnvironment(listener).get("ARTIFACT_JOB_BUILD_NUMBER")
def ARTIFACT_DEPLOY_TO = build.getEnvironment(listener).get("ARTIFACT_DEPLOY_TO")
def DEPLOYMENT_ENV = build.getEnvironment(listener).get("DEPLOYMENT_ENV")

def filename = "/<path>/build.properties"
def file = new File(filename)
Properties props = new Properties()
props.load(file.newDataInputStream())

if ( ! ARTIFACT_DEPLOY_TO.equalsIgnoreCase( props.getProperty("ARTIFACT_DEPLOY_TO") ) ) {
	file.append("ARTIFACT_DEPLOY_TO=${ARTIFACT_DEPLOY_TO}" + System.getProperty("line.separator"))
	file.append("DEPLOYMENT_ENV=${DEPLOYMENT_ENV}" + System.getProperty("line.separator"))
}
