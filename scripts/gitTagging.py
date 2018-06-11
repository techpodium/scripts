#!/usr/bin/env python

import os
import datetime
import re
import subprocess
import json
import sys

current_version = str(sys.argv[1])
git_pr_author = str(sys.argv[2])
tag_message = str(sys.argv[3])
repository_name = str(sys.argv[4])
workspace_dir = str(sys.argv[5])
vip_plugin_dir = str(sys.argv[6])
postmedia_plugin_dir = str(sys.argv[7])
repo_dir_to_tag = workspace_dir + "/themes/{}".format(repository_name)


def generate_version(hotfix=True):
    """ increment the version number
        changes the version file and commit the result
    """
    new_version = None

    numbers = re.split(r'\W+', current_version[1:])
    if hotfix:
        numbers[2] = str(int(numbers[2]) + 1)
    else:
        numbers[1] = str(int(numbers[1]) + 1)
        numbers[2] = '0'
    new_version = 'v' + '.'.join(numbers)

    subprocess.call(["git", "config", "--global", "user.email", "jenkins@donotreply.com"])
    subprocess.call(["git", "config", "--global", "user.name", "jenkins"])
    subprocess.call(["git", "-C", repo_dir_to_tag, "tag", "-a", "{}".format(new_version), "-m", "{}".format(tag_message)])
    # subprocess.call(["git", "-C", repo_dir_to_tag, "push", "origin", "--tags"])
    return new_version


# TODO: add mu-plugin in release note
def release_notes(hotfix=True):
    version = generate_version(hotfix)
    notes = {
        'version': version,
        'author': git_pr_author,
        'date': datetime.datetime.now().strftime('%Y/%m/%d %H:%M:%S'),
        'name': repository_name,
        'dependencies': []
    }
    command_output = subprocess.Popen(
                    'find {}/ '
                    '{}/themes/postmedia-theme-core/ '
                    '{}/ '
                    '{}/ -type d -name ".git" 2>/dev/null'.format(repo_dir_to_tag, workspace_dir, vip_plugin_dir, postmedia_plugin_dir),
                    stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
    paths, err = command_output.communicate()

    for path in paths.split():
        repo, _ = os.path.split(path)
        _, repo_name = os.path.split(repo)
        with open(os.path.join(path, 'HEAD'), 'r') as head:
            reference = head.readlines()[0][5:].strip()

        if repo_name != repository_name:
            tag = repository_name + "-{}".format(version)
            subprocess.call(["git", "-C", repo, "tag", "-a", "{}".format(tag), "-m", "{}".format(tag_message)])
            # subprocess.call(["git", "-C", repo, "push", "origin", "--tags"])
        else:
            tag = version

        if 'refs/' in reference:
            with open(os.path.join(path, 'logs', reference), 'r') as current_ref:
                last_commit = current_ref.readlines()[-1].split()[1]
        else:
            last_commit = reference
            reference = ''

        notes['dependencies'].append(
            {
                'name': repo_name,
                'ref': reference,
                'last_commit': last_commit,
                'tag': tag
            })

    subprocess.Popen('sudo -u jenkins touch release.json', cwd=workspace_dir, shell=True)
    subprocess.Popen('sudo -u jenkins chmod 777 release.json', cwd=workspace_dir, shell=True)

    with open('{}/release.json'.format(workspace_dir), 'w') as fp:
        json.dump(notes, fp, indent=4, separators=(',', ': '))

    return version


new_version = release_notes()
print new_version
