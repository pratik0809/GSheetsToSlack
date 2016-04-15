<?php 
// Enable debugging
error_reporting(E_ALL);
ini_set('display_errors', true);

// set up POST variables
$command = $_POST['command'];
$username = $_POST['user_name'];
$userid = $_POST['user_id'];
$token = $_POST['token'];
// public JSON version of your google spreadsheet
$url_to_check = "https://spreadsheets.google.com/feeds/list/<work sheet id>/<sheet id>/public/values?alt=json";
/*
*"Users.info" is a Slack API method that returns information about a team member.
*URL: https://api.slack.com/methods/users.info/test
*/
$authtoken = "xxxx-xxxxxxxxx-xxxx";
$slack_user_info = "https://slack.com/api/users.info?token=".$authtoken."&user=".$userid."&pretty=1";

//token is from Slack Integrations Page
if($token != '<insert token number here for verification>'){ 
    $msg = "The token for the slash command doesn't match. Check your script.";
    die($msg);
    echo $msg;
}

//Create a new cURL resource

$ch = curl_init($url_to_check); //public JSON version of your google spreadsheet
$ch2 = curl_init($slack_user_info);//JSON of slack user info

// set URL and other appropriate options

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //public JSON version of your google spreadsheet
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); //JSON of slack user info

// grab URL and pass it to the browser
$ch_response = curl_exec($ch); //public JSON version of your google spreadsheet
$ch_response2 = curl_exec($ch2); //JSON of slack user info

//close cURL connection
curl_close($ch); //public JSON version of your google spreadsheet
curl_close($ch2); //JSON of slack user info

//convert slack user info JSON into PHP array
$userinfo_response_array = json_decode($ch_response2, TRUE);
//filter the JSON down to email address
$email = $userinfo_response_array['user']['profile']['email'];

//convert google spreadsheet JSON into PHP array
$response_array = json_decode($ch_response, TRUE);
//filter the JSON down
$filteredarray = ($response_array['feed']['entry']);
//Use array_column to return the values from a single column in this case: first name, points, email
$first_name_column = array_column((array_column($filteredarray, 'gsx$firstname')), '$t');
$points_column = array_column((array_column($filteredarray, 'gsx$points')), '$t');
$email_column = array_column((array_column($filteredarray, 'gsx$email')), '$t');

//If target email is found, capture index value
$index_of_target = (array_search($email, $email_column, false));

if($index_of_target !== false) {    
    //Use previously captured index value to return first name and points value
    $reply= $first_name_column[$index_of_target].", you have " . $points_column[$index_of_target]." point(s).";
}

else {
    //else die
    $reply = "No email found.";
}
echo $reply;

?>
