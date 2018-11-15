import org.kohsuke.stapler.StaplerRequest
import org.kohsuke.stapler.Stapler;
import net.sf.json.JSONObject

StaplerRequest req = Stapler.getCurrentRequest();
def instance = Jenkins.getInstance()
def des = instance.getDescriptor("org.jenkinsci.plugins.p4.PerforceScm")

formData = [
	'autoSave': 'false',
  	'credential': 'p4-credential-id',
  	'clientName': 'test-workspaces',
  	'depotPath': 'test-path',
  	'autoSubmitOnChange': 'false'
]

formData = formData as JSONObject
des.configure(req, formData)
instance.save()
