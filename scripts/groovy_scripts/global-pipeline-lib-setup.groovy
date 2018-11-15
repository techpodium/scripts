import org.jenkinsci.plugins.p4.PerforceScm;
import org.jenkinsci.plugins.p4.workspace.ManualWorkspaceImpl;
import org.jenkinsci.plugins.p4.workspace.Workspace;
import org.jenkinsci.plugins.p4.workspace.WorkspaceSpec;
import hudson.plugins.filesystem_scm.FSSCM
import org.jenkinsci.plugins.workflow.libs.GlobalLibraries
import org.jenkinsci.plugins.workflow.libs.LibraryConfiguration
import org.jenkinsci.plugins.workflow.libs.SCMRetriever
import net.sf.json.JSONObject

def retriever

/* Library configuration */
pipeline_shared_libraries = [
    'shared-lib': [
        'defaultVersion': 'default',
        'implicit': false,
        'allowVersionOverride': true,
        'includeInChangesets': true,
        'scm': 'perforce',
        'scm_config': [
            'workspace': [
                'workspace_name': 'jenkins-${NODE_NAME}-${JOB_NAME}-shared-lib',
                'char_set': 'none',
                'pin_to_build_host': false,
                'spec': [
                    'view': '//depot/<shared-lib-path>/... //<checkout-path-of-shared-lib>/...'
                ]
            ],
            'credentialsId': '<cred-id>'
        ]
    ],
    'shared-test': [
        'defaultVersion': 'master',
        'implicit': false,
        'allowVersionOverride': false,
        'includeInChangesets': false,
        'scm': 'filesystem',
        'scm_config': [
            'path': '/var/lib/jenkins/shared-test',
            'clearWorkspace ': false,
            'copyHiddens': false
        ]
    ]
]

if(!binding.hasVariable('pipeline_shared_libraries')) {
    println "checking MAP"
    pipeline_shared_libraries = [:]
}

if(!pipeline_shared_libraries in Map) {
    throw new Exception("pipeline_shared_libraries must be an instance of Map but instead is instance of: ${pipeline_shared_libraries.getClass()}")
}

pipeline_shared_libraries = pipeline_shared_libraries as JSONObject

List libraries = [] as ArrayList
pipeline_shared_libraries.each { name, config ->
    if(name && config && config in Map && 'scm' in config && 'scm_config' in config && config['scm_config'] in Map) {

        def scm = config.optString('scm')

        if(scm.equalsIgnoreCase("perforce")) {
            def workspace_name = config['scm_config']['workspace'].optString('workspace_name')
            def char_set = config['scm_config']['workspace'].optString('char_set')
            def pin_to_build_host = config['scm_config']['workspace'].optBoolean('pin_to_build_host', false)
            def p4_view = config['scm_config']['workspace']['spec'].optString('view')
            def credential = config['scm_config'].optString('credentialsId')

            WorkspaceSpec workspace_spec = new WorkspaceSpec(p4_view, null)       //change-view is set to null
            Workspace workspace = new ManualWorkspaceImpl(char_set, pin_to_build_host, workspace_name, workspace_spec)
            PerforceScm p4scm = new PerforceScm(credential, workspace, null)      //populate is set to null (i.e. default config)
            retriever = new SCMRetriever(p4scm)
        }
        else if(scm.equalsIgnoreCase("filesystem")) {
            def fs_path = config['scm_config'].optString('path')
            def clearWorkspace = config['scm_config'].optBoolean('clearWorkspace', false)
            def copyHiddens = config['scm_config'].optBoolean('copyHiddens', false)
            FSSCM fsScm = new FSSCM(fs_path, clearWorkspace, copyHiddens, null)     //filterSettings is set to null (i.e. default config)
            retriever = new SCMRetriever(fsScm)
        }

        def library = new LibraryConfiguration(name, retriever)

        library.defaultVersion = config.optString('defaultVersion')
        library.implicit = config.optBoolean('implicit', false)
        library.allowVersionOverride = config.optBoolean('allowVersionOverride', true)
        library.includeInChangesets = config.optBoolean('includeInChangesets', true)
        libraries << library
    }
}

def global_settings = Jenkins.instance.getExtensionList(GlobalLibraries.class)[0]

if(libraries) {
    global_settings.libraries = libraries
    global_settings.save()
    println 'Configured Pipeline Global Shared Libraries:\n    ' + global_settings.libraries.collect { it.name }.join('\n    ')
}
else {
    if(pipeline_shared_libraries) {
        println 'Nothing changed.  Pipeline Global Shared Libraries already configured.'
    }
    else {
        println 'Nothing changed.  Skipped configuring Pipeline Global Shared Libraries because settings are empty.'
    }
}
