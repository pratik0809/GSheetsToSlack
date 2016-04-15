# Google Sheets to Slack 

GSheetsToSlack is a script written for Google Sheets that allows Slack's API to pull data from your spreadsheet.  This means you can create a Slack Bot, a slash command or any other custom integration in Slack.  In this case, this script was written to accomodate my on-campus organization's needs [`(UNICEF at Illinois Tech)`](http://www.facebook.com/UNICEFatIIT).  

At UNICEF, we use [Slack](http://www.slack.com) for communication between our members. We initially used [GroupMe](http://groupme.com/) but realized that Slack was much more powerful and open to customization. We also use a point system to keep track of members' volunteering hours, attendance, and eligibility for prizes. This point system is updated via a private spreadsheet on Google Drive accessible only to our executive board.   The biggest problem was members had no way of instantly seeing their points. This script is that answer! Members are able to see their own points by simply typing a slash command, "/points". 

For reference, the spreadsheet's layout is as follows:

First Name | Last Name | Email | Total Points | *Event 1* | *Event 2* | *More Events*
------------ | ------------- | ------------- | ------------- | ------------- | ------------- | -------------
Pratik | Sampat | pratiks0809@gmail.com | 5 | 2 | 3 | 0
 

## Resources
* Adapted from [mccreath's isitup-for-slack tutorial](https://github.com/mccreath/isitup-for-slack/blob/master/docs/TUTORIAL.md) 
* [Google Developer Apps Script Documentation](https://developers.google.com/apps-script/)


