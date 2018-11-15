import jenkins.plugins.coverity.CIMInstance

def instance = jenkins.model.Jenkins.getInstance()
List <CIMInstance> instances = new ArrayList<CIMInstance>();

CIMInstance cimInstance = new CIMInstance("name", "coverity-url", 41080, "credential-id")
instances.add(cimInstance)

def des = instance.getDescriptorByType(jenkins.plugins.coverity.CoverityPublisher.DescriptorImpl)
des.setInstances(instances)
des.save()

des.getInstances()
