#!/bin/bash

# This is a dummy script to to move artifacts from repository path to another 

current_status=`echo "${Current_Status}" | tr '[:upper:]' '[:lower:]'`
promote_status=`echo "${Target_Status}" | tr '[:upper:]' '[:lower:]'`
promote_artifacts=${ARTIFACTs}
target_repository=${Target_Artifactory_Repository}
source_repository=${Source_Artifactory_Repository}


if [ -z "$promote_artifacts" ]
then
      IFS=',' read -ra artifact_list <<< "$uploaded_artifacts"
      echo "Promoting all Artifacts..."
else
      IFS=',' read -ra artifact_list <<< "$promote_artifacts"
      echo "Promoting only selected Artifacts"
fi

for artifact in "${artifact_list[@]}"; do
	echo "Processing artifact: ${artifact}"
    artifact_arch=`echo ${artifact} | rev | cut -d '.' -f2 | rev`
	if [ "${artifact_arch}" == "noarch" ] || [ "${artifact_arch}" == "x86_64" ]; then
    	output=`/var/lib/jenkins/jfrog rt move ${source_repository}/${current_status}/<paths>/${artifact_arch}/${artifact} ${target_repository}/${promote_status}/<path>/${artifact_arch}/${artifact} --flat=true `
    else
    	output=`/var/lib/jenkins/jfrog rt move ${source_repository}/${current_status}/<paths-different-from-above>/${artifact} ${target_repository}/${promote_status}/<paths-different-from-above>/${artifact} --flat=true`
    fi
    
    success_count=`echo "$output" | python -c 'import json,sys;obj=json.load(sys.stdin);print obj["totals"]["success"]'`
    if [ ${success_count} == 0 ]; then
    	echo "artifact move was unsuccessful"
        exit 1
    fi
done
