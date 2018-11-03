<?php
require_once('config.php');
// require_once ('google/apiclient/src/Google/Client.php');
require_once 'vendor/autoload.php';
require_once ('php-jwt-master/src/JWT.php');
use \Firebase\JWT\JWT;


if (isset($_POST['type']) && !empty($_POST['type'])) {
   date_default_timezone_set('Asia/Calcutta');
    $appoitment_data['name'] = $_POST['name'];
    $appoitment_data['email'] = $_POST['email'];
    $appoitment_data['phone'] = $_POST['phone'];
    $appoitment_data['information'] = $_POST['information'];
    $appoitment_data['booking_type'] = $_POST['booking_type'];
    $appoitment_data['websiteId'] = WEBSITE_ID;
    $appoitment_data['time_slot'] = $_POST['time_slot'];
    $appoitment_data['date_of_appointment'] = date('Y-m-d', strtotime($_POST['book_date']));
   
    $appoitmentdata = (array) $curl->send_api($appoitment_data, 'Uappointments/add');


  $privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC0FbOma3MBuYoI\nvBnUC+eGXq82tqTsaRparNIymvLLl73cIKWstwW2/30ftBoJNJydTHZ/aNh7wszI\nSD2yja17a1GcCKtDd1xNX6Lyk5WfC5sfDfO8JLi5VXHdpfj2IZRKDe0kVOJe/gwv\nzUvw03iiW92uHVG+T5R/8IFbZz1lNaoo/3CixxFIKjT9EXmQn4+nyEw2GC2mTEJg\ncybop0jmLDKKgxJKbiymC94uGTcHILRWw6VyqO9831NdBB78WM8jUgrqNhJQb87v\nAcLS+R7ZTreJqecHySX5JwjnkTApWw1hSKWwCZkKPLOVeoCCueOlyFPm7QqlNHd9\nCdwrwd3hAgMBAAECggEABCFM6R7E7M3LkWoHN32JByQa9Yy+ez6pNln5IYSLx8Ue\ne07XPt71EVCCZxakS9iQVJQUQgV6hMrbw4aC3fpdZ5efV95L53qMaBi+z+x4I5VO\nhsmlGMggsY0w5P77XuF39TN04ELXPNuLpfFh3eNrNHHJ+5Yv/ablhHJElLcZRZXR\ny/Vm+RaXSJ1Lyf/+nZgrhXViKpU/6EY+mT8uBUrf9NVeOJbCMYIhOwMG6yLoPZ5I\n5SDGhx1XpwXFVqo/7k60nRndxMfrUFyYsThWSiLtEw4mB+NTbTnuAzZtS1tcZu7d\nC2Ud1SOtXUbgXNFOAb5m6wJcThQe4X8w5epI6xbHAQKBgQDbue4GzFvSv5BYz5VE\n68WE2K8sDh7ayoQeNTwB7gDKz2gu9ovFvCxNtHg054aZrsz4o2jezozeTyrgmXaE\nSjLmcHctAAQG8prxS3t8aPKlWM+zTAkBww4ZKTfhiUSEDGzCIWiF7KgCIOkVnH7y\nSfZ+sXSr2IlfHSMg1EkPS3dBAQKBgQDR0HFPsdeIWs15O9hXT4psYcG2g5b8QY+V\ne44Ma44A6LUXQJNJotPGd7W0phhCRXm6k5DTqFIT5Q83cavqfi0usmaPDT6du22m\n3QplT5gJrYIrOO6JIDMdAt70u/dkeAz7f/l2nxBH+uiew7kZ5NTCz9dJ8S5ZnO4+\nTQu/zzW84QKBgQDYXQ/sFdPdhNEJAu/DvD71f8GOqiDr5TuP22/JnqmdC/tVM2WT\nQqaFpc4wmkPKlXw04gRkUhQY3PAl1jgEMGRK0jgoUbmldcPpEyD38wfslbWAosDD\nwWTildn29opHVUzLJMaeCdmuruWWaFIBF5/oRanThhhPVou+ygtfSjqWAQKBgQCF\ndZhOACrAIjonDokbaI39SOVmSifFR5KknBYMEnIeY+ek5b+KjFc3HDhps2kk5np6\n0pjB+YRUAVT/iH+5Rg9Jb9NK1TrqLCmghWOyc8GbDlIJWkpo0SGSJ5xYgiPoNXDU\nnV+6M42wq4pCSu836FXpoTkpYI+CEw98c5ewp4ZgIQKBgEpeAJhRPczeCHU4bak/\n0mQNDDHXhMAqyMOsJwq+PrLFgIf2KW9aCwtj0VuvXjMfPFTTPsBcFVb+u0r9YYUP\naUnGu5YG3/580xiy95WfnCvrFdiWv6f8TDDBRqpNQy3SZTi/hQpkU3m6UExniv+h\n8Spc3zCto72wnCCQxh4RBAhE\n-----END PRIVATE KEY-----\n
EOD;

    $token = array(
        "iss"=>"cpa-calender@cpa-portal-207106.iam.gserviceaccount.com",
        "sub"=>"cpa-calender@cpa-portal-207106.iam.gserviceaccount.com",
        "scope"=>"https://www.googleapis.com/auth/calendar",
        "aud"=>"https://www.googleapis.com/oauth2/v4/token",
        "iat"=> time(),
        "exp"=> time()+3600
    );

    $jwt = JWT::encode($token, $privateKey, 'RS256');
    

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.googleapis.com/oauth2/v4/token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "grant_type=urn%3Aietf%3Aparams%3Aoauth%3Agrant-type%3Ajwt-bearer&assertion=".$jwt."",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
      
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $accessToken='';
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $accessToken = json_decode($response)->access_token;
    }
    
    $client = new \Google_Client();
    $client->setApplicationName('CPA');
    $client->setScopes(\Google_Service_Calendar::CALENDAR);
    $client->setSubject('sanjay.technostacks@gmail.com');
    $client->setAccessToken($accessToken);
    $client->setAccessType('offline');
    $service = new \Google_Service_Calendar($client);

    $event = new \Google_Service_Calendar_Event(array(
      'summary' => $appoitment_data['name'],
      'description' => $appoitment_data['name'].' has book appointment on '.$appoitment_data['date_of_appointment'].'<br/> email :- '.$appoitment_data['email'].'<br/> phone :-'.$appoitment_data['phone'].'<br/> Time slot :- '.$appoitment_data['time_slot'].'<br/> Comments :- '.$appoitment_data['information'].'<br> Booking type :- '.$appoitment_data['booking_type'],
      'start' => array(
        'dateTime' => $appoitment_data['date_of_appointment'].'T0:00:00-12:00',
        'timeZone' => 'Asia/Calcutta',
      ),
      'end' => array(
        'dateTime' => $appoitment_data['date_of_appointment'].'T0:00:00-12:00',
        'timeZone' => 'Asia/Calcutta',
      )
    ));

    $calendarId = 'sanjay.technostacks@gmail.com';
    $event = $service->events->insert($calendarId, $event);

    $adminemail = 'sanjay@technostacks.com';
    sendemails($_POST['email'],$_POST['information'],$adminemail,'Appointment',$_POST['name']);
    sendemails($adminemail,$_POST['information'],$_POST['email'],'Appointment',$_POST['name']);

    echo json_encode($appoitmentdata);
    exit;
} else {

    $date = date('Y-m-d', strtotime($_POST['c_date']));
    $parram = array('date_of_appointment' => $date);
    $appoitmentlist = (array) $curl->send_api($parram, 'Uappointments/getAppoitmentListByDate');

    $timeSlot = array();
    foreach ($appoitmentlist['Uappointments'] as $key => $value) {
        $timeSlot[$key] = $value->time_slot;
    }
    echo json_encode($timeSlot);
    exit;
}
?>		
