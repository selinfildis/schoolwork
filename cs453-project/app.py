import time
import requests
import json
import datetime


def main():
    for i in xrange(0, 1000):
        time.sleep(1)
        try:
            if (i % 10 == 0):
                raise Exception()
            else:
                print "EVERYTHING IS FINE."
        except Exception:
            print "EXCEPTION OCCURRED CREATING ALERT"
            send_exception_alert(i)


def send_exception_alert(i):
    priority_types = ["P1", "P2", "P3", "P4", "P5"]
    create_alert = "https://api.opsgenie.com/v2/alerts"
    create_alert_header = {
        "Content-Type": "application/json",
        "Authorization": "GenieKey *******"
    }
    create_alert_data = {
        "message": "Message {}",
        "alias": "alias {}",
        "description": "Description",
        "responders": [{"id": "******", "type": "schedule"}],
        "visibleTo": [{"id": "*******", "type": "team"}],
        "actions": [],
        "teams":[{"id": "******", "type": "team"}],
        "tags": ["OverwriteQuietHours", "Critical"],
        "details": {"key1": "value1", "key2": "value2"},
        "entity": "An example entity",
        "priority": ""

    }
    create_alert_data["priority"] = priority_types[(i % 50) % 5]  # TODO
    create_alert_data["message"] = create_alert_data["message"].format(datetime.datetime.now())
    create_alert_data["alias"] = create_alert_data["alias"].format(datetime.datetime.now())
    print create_alert_data
    req = requests.post(url=create_alert, headers=create_alert_header, data=json.dumps(create_alert_data))
    print req.text


if __name__ == '__main__':
    main()
