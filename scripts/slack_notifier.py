import requests
import time
import sys
import json

title = str(sys.argv[1])
message = str(sys.argv[2])
repo = str(sys.argv[3])
pr = str(sys.argv[4])
remark = str(sys.argv[5])
color = str(sys.argv[6])


def send_to_slack():
    url = '{{ jenkins.slack_url_key }}'

    payload = {"attachments": [{
                    "fallback": "Jenkins Notification",
                    "color": '{}'.format(color),
                    "pretext": "Jenkins Notification",
                    "title": '{}'.format(title),
                    "text": '{}'.format(message),
                    "fields": [
                        {
                            "title": "Repository",
                            "value": '{}'.format(repo),
                        },
                        {
                            "title": "Pull Request",
                            "value": '{}'.format(pr),
                        },
                        {
                            "title": "Additional Remark",
                            "value": '{}'.format(remark),
                        }
                    ],
                    "image_url": "http://my-website.com/path/to/image.jpg",
                    "thumb_url": "http://example.com/path/to/thumb.png",
                    "ts": time.time()
                }]}

    if url:
        response = requests.post(
            url,
            json=payload
        )
        if response.status_code != 200:
            print("Error communicating with slack, getting a {} code : {}".format(response.status_code,
                                                                                             response.text))
    else:
        print("Slack URL is not defined")


send_to_slack()
