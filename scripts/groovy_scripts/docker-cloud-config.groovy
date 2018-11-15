import com.nirima.jenkins.plugins.docker.DockerCloud
import com.nirima.jenkins.plugins.docker.DockerTemplate
import com.nirima.jenkins.plugins.docker.DockerTemplateBase
import io.jenkins.docker.client.DockerAPI
import io.jenkins.docker.connector.DockerComputerSSHConnector
import io.jenkins.docker.connector.DockerComputerSSHConnector.ManuallyConfiguredSSHKey
import org.jenkinsci.plugins.docker.commons.credentials.DockerServerEndpoint
import jenkins.model.Jenkins

List<DockerTemplate> templates = new ArrayList<DockerTemplate> ()

def dockerCloudParameters = [
  connectTimeout: 60,
  containerCapicity: 3,
  dockerHostUrl: 'tcp://something.com:2376/',
  name: 'docker',
  readTimeout: 60
]


def dockerTemplateBaseParameters = [
  connector_cred_id: '<cred-id>',
  dnsString: 'ip1 ip2',
  extraHostsString: 'host1:host2',
  image: '<full-image-url-of-registry>',
  instanceCapacity: '2',
  labelString: '<label-to-use-in-build>',
  volumesString: 'vol-1:vol-2:ro',
  remoteFs: '/var/lib/jenkinsuser'
]


ManuallyConfiguredSSHKey sshKeyStrategy = new ManuallyConfiguredSSHKey(dockerTemplateBaseParameters.connector_cred_id, hudson.plugins.sshslaves.verifiers.NonVerifyingKeyVerificationStrategy sshHostKeyVerificationStrategy)
DockerComputerSSHConnector connector = new DockerComputerSSHConnector(sshKeyStrategy)

DockerTemplateBase dockerTemplateBase = new DockerTemplateBase(dockerTemplateBaseParameters.image)
dockerTemplateBase.setDnsString(dockerTemplateBaseParameters.dnsString)
dockerTemplateBase.setVolumesString(dockerTemplateBaseParameters.volumesString)

DockerTemplate dockerTemplate = new DockerTemplate(dockerTemplateBase, connector, dockerTemplateBaseParameters.labelString, dockerTemplateBaseParameters.remoteFs, dockerTemplateBaseParameters.instanceCapacity)
templates.add(dockerTemplate)

DockerServerEndpoint dockerHost = new DockerServerEndpoint(dockerCloudParameters.dockerHostUrl, null)
DockerAPI dockerApi = new DockerAPI(dockerHost, dockerCloudParameters.connectTimeout, dockerCloudParameters.readTimeout, null, null)

DockerCloud dockerCloud = new DockerCloud(dockerCloudParameters.name, dockerApi, templates)
dockerCloud.setContainerCap(dockerCloudParameters.containerCapicity)

// get Jenkins instance
Jenkins jenkins = Jenkins.getInstance()

// add cloud configuration to Jenkins
jenkins.clouds.add(dockerCloud)

// save current Jenkins state to disk
jenkins.save()
