import jenkins.plugins.publish_over_ssh.*
import net.sf.json.JSONObject;
import org.kohsuke.stapler.StaplerRequest;
import org.kohsuke.stapler.Stapler;

Jenkins.instance.getDescriptorByType(BapSshPublisherPlugin.Descriptor.class).with {

	final List<BapSshHostConfiguration> configs = new ArrayList<BapSshHostConfiguration> ()
 	StaplerRequest req = Stapler.getCurrentRequest();

	JSONObject json = JSONObject.fromObject("""
	{
		'commonConfig': {
			'encryptedPassphrase': '<encryptedPassphrase>',
			'keyPath': '.ssh/id_rsa',
			'key': '<priv-key>',
			'disableAllExec': false
		},
		'instance': [{
			'name': 'eeeee',
			'hostname': 'eee-host',
			'username': 'eee-user',
			'remoteRootDir': '/',
			'overrideKey': true,
			'encryptedPassword': '<encryptedPassword>',
			'keyPath': '.ssh/id_rsa',
			'key': '<ee-test-key>',
			'port': '22',
			'timeout': '300000'
		}],
		'defaults': {
			'stapler-class': 'jenkins.plugins.publish_over_ssh.options.SshPluginDefaults'
		}
	}""")
  	it.configure(req, json);
 	println it.hostConfigurations
}


====================== in jinja2 format
import jenkins.plugins.publish_over_ssh.*
import net.sf.json.JSONObject;
import org.kohsuke.stapler.StaplerRequest;
import org.kohsuke.stapler.Stapler;

Jenkins.instance.getDescriptorByType(BapSshPublisherPlugin.Descriptor.class).with {

	final List<BapSshHostConfiguration> configs = new ArrayList<BapSshHostConfiguration> ()
 	StaplerRequest req = Stapler.getCurrentRequest();

 	JSONObject json = JSONObject.fromObject(
	"""\
	{
		'commonConfig': {
			'encryptedPassphrase': '{{ published_over_ssh.common_config.passphrase }}',
			'keyPath': '{{ published_over_ssh.common_config.path_to_key }}',
			'key': '{{ published_over_ssh.common_config.private_key | replace('\n','\\\\n') }}',
			'disableAllExec': false
		},
		'instance': [
{% for server in published_over_ssh.ssh_servers %}
		{
			'name': '{{ server.name }}',
			'hostname': '{{ server.hostname }}',
			'username': '{{ server.username }}',
			'remoteRootDir': '{{ server.remote_directory }}',
			'overrideKey': '{{ server.overrideKey }}',
			'encryptedPassword': '{{ server.passphrase }}',
			'keyPath': '{{ server.path_to_key }}',
			'key': '{{ server.private_key | replace('\n','\\\\n') }}',
			'port': '22',
			'timeout': '300000'
		},
{% endfor %}
		],
		'defaults': {
			'stapler-class': 'jenkins.plugins.publish_over_ssh.options.SshPluginDefaults'
		}
	}
	""")

  	it.configure(req, json);
 	println it.hostConfigurations
}
