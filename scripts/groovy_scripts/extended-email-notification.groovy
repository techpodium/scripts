import hudson.model.*;
import jenkins.model.*;

def instance = Jenkins.getInstance()

def extmailServer = instance.getDescriptor("hudson.plugins.emailext.ExtendedEmailPublisher")
extmailServer.setDefaultSuffix("@something.com")
extmailServer.setSmtpServer("zone-relay-local.something.com")
extmailServer.setDebugMode(true)

println extmailServer.getSmtpServer()

instance.save()
