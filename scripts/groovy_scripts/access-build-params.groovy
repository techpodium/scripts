import hudson.model.*

def output_array = []

try {
def params = (Thread.currentThread().toString() =~ /job\/(.*)\/([0-9]+)\/.*\//)[0]
def current_build_number = params[2].toString()
def job_name = params[1]

def current_build = jenkins.model.Jenkins.instance.getItem(job_name).getBuild(current_build_number)
output_array.add(current_build)

} catch(Exception ex2) {
output_array.add(ex2)
}
return output_array
