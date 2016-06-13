<?php
$my_email = "registration@vmwconference.com";
$errors = array();

// Remove $_COOKIE elements from $_REQUEST.
if(count($_COOKIE)){foreach(array_keys($_COOKIE) as $value){unset($_REQUEST[$value]);}}

// Check referrer is from same site.
if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){$errors[] = "You must enable referrer logging to use the form";}

// Display any errors and exit if errors exist.
if(count($errors)){foreach($errors as $value){print "$value<br>";} exit;}
if(!defined("PHP_EOL")){define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");}

// Build message.
function build_message($request_input){
  if(!isset($message_output)){
    $message_output ="";
  }
  if(!is_array($request_input)){
    $message_output = $request_input;
  }else{
    foreach($request_input as $key => $value){
      if(!empty($value)){
        if(!is_numeric($key)){
          $message_output .= str_replace("_"," ",ucfirst($key)).": ".build_message($value).PHP_EOL.PHP_EOL;
        }else{
          $message_output .= build_message($value).", ";
        }
      }
    }
  }
  return rtrim($message_output,", ");
}

// Defining the Variables

$date = date("Y-m-d,h_i_s A");

$message = build_message($_REQUEST);

$message = 'Dear Colleague,

Thank you for registering for VMW 2017. If you have requested any official letters, please allow up to 5 business days to receive your documents.

If you are an author, please make sure to send us your camera ready version and a signed copyright form via email to info@vmwconference.com. You can find the copyright form here: www.vmwconference.com/papers. Please note that failing to do so may result in an unsuccessful process of your registration.

You can find your registration details below. If there are any errors in the information you have provided, please write an email to us at registration@vmwconference.com mentioning the correct information. Please note that you SHOULD NOT refill the form.

---

' . $message;

$message = $message . 'File uploaded: ';

$message = $message . $date.'_'.$_FILES['file']['name'];

$message = $message . PHP_EOL.PHP_EOL."-- ".PHP_EOL."";

$message = stripslashes($message);

$subject = "Registration Details for " . $_REQUEST['Email'];

$headers = "From: " . $_REQUEST['Email'];

$your_email = $_REQUEST['Email'];

$your_subject = "Your Registration Details for VMW'17";

$your_headers = "From: VMW'17 <" . $my_email . ">";

if ((($_FILES["file"]["type"] == "image/gif")

|| ($_FILES["file"]["type"] == "image/jpeg")

|| ($_FILES["file"]["type"] == "image/png")

|| ($_FILES["file"]["type"] == "image/jpg")

|| ($_FILES["file"]["type"] == "image/tif"))

&& ($_FILES["file"]["size"] < 20000000))

  {

  if ($_FILES["file"]["error"] > 0)

    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
      move_uploaded_file($_FILES["file"]["tmp_name"],"receipts/" . $_FILES["file"]["name"]);
      rename("receipts/".$_FILES['file']['name'],"receipts/".$date.'_'.$_FILES['file']['name']);
  $filename = $date.'_'.$_FILES['file']['name'];
    }
  }
else
  {
  die("The file you have selected for upload is invalid. <br />
  Please make sure the file you are trying to upload is an image (.jpg, .jpeg, .png, .gif, .tif) <br />
  No other file types are allowed.");
  }

mail($my_email,$subject,$message,$headers);
mail($your_email,$your_subject,$message,$your_headers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noarchive">
<meta name="description" content="">
<meta name="keywords" content="smart glass, wearable imaging, projection devices, smart watch, smart apparel, smart jewelry, wearable health, wearable technologies conference, activity tracking, ubiquitous systems, novel energy management solutions, context awareness, notification delivery, wearable biometrics, mobile biometrics, vehicular technologies conference, mobile technologies conference 2017, haptics, prosthetics, energy harnessing, brain-interfaces, electromyography (emg) interfaces, 3d printing in wearables, wearable infrastructure, mobile technologies conference, mobile systems, mobile applications, mobile services, mobile computing, electric vehicles, vehicular electronics, intelligent transportation, vehicular communications, networks, telematics, mobile satellite systems, positioning, navigation, wireless networks, protocols, security, services, ad-hoc, m2m, sensor networks, communications networks, antenna systems, propagation, rf design, signal transmission, reception, 3D printing in Wearables, Activity Tracking, Ad-Hoc, M2M, and Sensor Networks, Antenna Systems, Propagation, and RF Design, Brain-interfaces, Context Awareness, Communications and Networks, Electric Vehicles, Vehicular Electronics, and Intelligent Transportation, Electromyography (EMG) Interfaces, Energy Harnessing, Haptics, Mobile Applications, Mobile Computing, Mobile Satellite Systems, Positioning and Navigation, Mobile Services, Mobile Systems, Notification Delivery, Novel Energy Management Solutions, Prosthetics, Signal Transmission and Reception, Smart Glass, Wearable Imaging, and Projection Devices, Smart Watch, Smart Apparel, Smart Jewelry, Ubiquitous Systems, Vehicular Communications, Networks, and Telematics, Wearable and Mobile Biometrics for Payment and Authentication, Wearable Health and Fitness, Wearable Infrastructure and Toolkits, Wireless Networks: Protocols, Security and Services, Global Market Analysis, Standardization and regulation process in China, Big Data and Cloud computing, Panel discussion on wearable ecosystem: Powering, security, design.etc, Battery and power solutions, Flexible Electronics: Flexible Display, OPV, battery. etc, XR(AR/VR/MR) in wearables, Immersive solution for visual, auditory, haptic, tracking, Latest development for content and platform in XR, Human-Computer Integration, The challenges and opportunity facing adoption, Application of XR in healthcare, industry, education. Etc, Artificial Intelligence, Big Data and Analytics, Connected Car, Digital Content, Enterprise Transformation, Identity, Industrial Internet of Things, Innovation, Marketing and Advertising, Mobile for Development, Next Generation Networks (5G, LP WAN, etc), NFV, Privacy, Security, Smart Cities, Smart Home, Wearables, Application Domains in Mobility, Mobile Applications, Mobile Internet; m-Business: m-office, m-commerce, m-payment, m-banking, Mobile Gaming, Mobile sensor networks, Internet and Web of Things, Ubiquitous Computing for Mobile Entertainment, Machine-to-Machine Communications, Mobile Computing, Other Mobile Applications, Human factor in Mobility, Human Factors for Mobile Collaboration and Interaction, HCI and Multi-modal Interaction with Mobile Devices, User Interface and Mobile Devices, Software Challenges for Mobility, Middleware for Mobile and Ubiquitous Computing, Context-based computing for mobile applications, Mobile Security: Access; Data; Device security, Location Based Services, Resource Management, Mobile Agents, Mobile System Performance, Mobile System Platforms, Mobile OS, User Interface and Mobile Devices, Standards and Interoperability, Mobile Computing, Cross-Layer Design and Optimization, Small Objects for Mobility, System Level Approaches for Small Communicating Objects, Antennas for Small Communicating Objects, Networks for Mobility, Vehicular Ad Hoc Networks, Vehicular Sensor Networks, and Vehicular Technology, WiMax Technology, Wireless and Mobile Networks: Wireless Personal Area Networking; Wireless Home LAN; Wi-Fi; WLAN, Next Generation Networks, Mobility Management, 3G/4G/UMTS/IMT2000, UWB/Bluetooth, Wireless Communications Technology, 4G Wireless Networks and Systems, Wireless and New Generation Media, Wireless Sensor Networks, Wireless communications Management, Software defined wireless networks, Wireless Internet and Multimedia, Mobile Operating Systems and Architectures, Wireless Modeling, Algorithms and Simulation, Molecular and nano-scale wireless communications, Mobile and Cloud Computing, M2M communications and the Internet of Things, Adaptive content distribution in on-demand services, Mobility management in User-centric services, Context and location-aware wireless services and applications, User-centric networks and adaptive services, Internet of Things services, Wireless networks and e-health services, Intelligent transportation systems, Dynamic sensor networks for urban applications, QoS-based differential business models for adaptive networks, Audio, image, video processing, Digital Multimedia Broadcasting, Multimedia and Artificial Intelligence, Mobile Multimedia and Applications, Multimedia Communication and Networking, Multimedia Databases and File Systems, Multimedia Interface and Interaction, Multimedia Signal Processing, Multimedia Big Data, Multimedia Systems and Devices, Mobile and wireless communications, Mobility protocols, Mobile sensing, Mobile performance evaluation, Vehicular ad hoc network (VANET), Mobile ad hoc network (MANET), Wireless ad hoc network (WANET), Wireless telecommunications networks, Wireless application protocols (WAP), Cellular wireless systems, Testing and monitoring of mobile applications, Fault tolerance of mobile services, Mobile content delivery networks, Software engineering for wireless sensor networks, Sensor network applications, Cognitive sensor networks, Software engineering for wireless sensor networks, Mobile malware security, Mobile platform security, Mobile network fraud, Mobile network security, NFC and smart payment applications, GPS-based security, Security for mobile sensing, Security for mobile sensor networks, Bluetooth and RFID Security, Privacy in Wireless Communications, Mobile Applications Control, Privacy-Preserving Protocols, Vehicular Networks Security, Software Vulnerabilities, Access Control/Threat Awareness, Multimedia Security and Privacy, Physical Tracking Security, Performance in data management, Reliability in data management, Configuration management, Mobile device management, Mobility modelling and management, Reasoning in mobile environments, Mobile performance management, Mobile Data mining, Mobile Data streaming, Mobile Data replication, Mobile Data migration, Mobile Data models, Mobile Data architectures, Managing pervasive data for mobile, Mobile Query Processing, Mobile Data integration, Operational management for mobile services, Operational models for mobile services, Capacity management for mobile services, Capacity research for mobile services, Mobile workflows in mobile services, Mobile transactions in mobile services, Capacity management for mobile services, Capacity research for mobile services, Mobile website design, Ux mobile design, Software for mobile web, Software for smart devices, Software for mobile embedded platforms, Modelling of mobile systems, Mobile application development, Mobile requirements analysis and design, Mobile software testing and evaluation, Intelligent Vehicle Technologies, Intelligent Transport Systems and Infrastructure, Connected Vehicles, Sustainable Transport">
<title>VMW'17 - Registration Form Filled!</title>

<meta name="handheldfriendly" content="true">
<meta name="mobileoptimized" content="240">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="../css/ffhmt.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<!--[if IE-9]><html lang="en" class="ie9"><![endif]-->

<script src="../js/modernizr.custom.63321.js"></script>
<script>
  (function() {
    var cx = '016656741306535874023:icfb0hogkjc';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
</head>

<body>
<nav id="slide-menu">
  <h1>VMW'17</h1>
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="../papers">Paper Submissions</a></li>
    <li><a href="../program">Program</a></li>
    <li><a href="../dates">Important Dates</a></li>
    <li><a href="../registration">Registration</a></li>
    <li><a href="../committee">Committee</a></li>
    <li><a href="../keynote">Keynotes</a></li>
    <li><a href="../sponsor">Sponsors</a></li>
    <li><a href="../venue">Venue</a></li>
    <li><a href="../accommodation">Accommodation</a></li>
    <li><a href="../symposium">Symposiums</a></li>
    <li><a href="#contact">Contact Us</a></li>
  </ul>
</nav>

<div id="content">
  <div class="desktop">
  <div class="cbp-af-header">
  <div class="cbp-af-inner">
    <a href="/"><img src="../img/logo.png" class="flex-logo"></a>
      <nav>
        <a href="/">Home</a><p class="dot">&middot;</p><a href="../papers">Paper Submission</a><p class="dot">&middot;</p><a href="../program">Program</a><p class="dot">&middot;</p><a href="../dates">Important Dates</a><p class="dot">&middot;</p><a href="../registration">Registration</a><p class="dot">&middot;</p><a href="../committee">Committee</a><p class="dot">&middot;</p><a href="../keynote">Keynotes</a><p class="dot">&middot;</p><a href="../sponsor">Sponsors</a><p class="dot">&middot;</p><a href="../venue">Venue</a><p class="dot">&middot;</p><a href="../accommodation">Accommodation</a><p class="dot">&middot;</p><a href="../symposium">Symposiums</a><p class="dot">&middot;</p><a href="#contact">Contact Us</a>
    </nav>
  </div>
</div>
</div>

  <header>
    <div class="mobile">
      <div class="cbp-af-header">
  <div class="cbp-af-inner">
    <div class="unit unit-s-3-4 unit-m-1-3 unit-l-1-3">
          <a href="/"><img src="../img/logo.png" class="flex-logo"></a>
      </div>
      <div class="unit unit-s-1-3 unit-m-2-3 unit-m-2-3-1 unit-l-2-3">
          <div class="menu-trigger"></div>
      </div>
  </div>
</div>
        <div class="bg">
          <h1>International Conference on Vehicular,<br>Mobile and Wearable Technology (VMW'17)</h1>
          <p class="subhead">June 5 - 6, 2017 | Rome, Italy</p>

          <a href="../papers" class="bg-link">Paper Submission</a> <p class="dot">&middot;</p> <a href="../dates" class="bg-link">Important Dates</a> <p class="dot">&middot;</p> <a href="../registration" class="bg-link">Registration</a>

        <div class="searchbox grid">
        <div class="unit unit-s-1 unit-m-3-4 unit-l-3-4">
          <div class="unit unit-s-1 unit-m-1-4-2 unit-l-1-4-2">
            <p class="body">Search:</p> 
          </div>
 <div class="unit unit-s-3-4 unit-m-3-4 unit-l-3-4">
        <gcse:searchbox-only resultsUrl="../results"></gcse:searchbox-only>
  </div>
</div>
</div>
        </div>
    </div>

    <div class="desktop">
      <div class="grid">
        <div class="unit unit-s-1 unit-m-1 unit-l-1">
        <div class="bg-img">
          <img src="../img/header.jpg" class="flex-img" alt="Header">
        </div>

        <div class="bg">
          <h1>International Conference on Vehicular,<br>Mobile and Wearable Technology (VMW'17)</h1>
          <p class="subhead">June 5 - 6, 2017 | Rome, Italy</p>

          <a href="../papers" class="bg-link">Paper Submission</a> <p class="dot">&middot;</p> <a href="../dates" class="bg-link">Important Dates</a> <p class="dot">&middot;</p> <a href="../registration" class="bg-link">Registration</a>

        <div class="searchbox grid">
        <div class="unit unit-s-1 unit-m-3-4 unit-l-3-4">
          <div class="unit unit-s-1 unit-m-1-4-2 unit-l-1-4-2">
            <p class="body">Search:</p> 
          </div>
 <div class="unit unit-s-3-4 unit-m-3-4 unit-l-3-4">
        <gcse:searchbox-only resultsUrl="../results"></gcse:searchbox-only>
  </div>
</div>
</div>
        </div>
        </div> 
      </div>
    </div>
  </header>

  <div class="grid main-content">
  <div class="unit unit-s-1 unit-m-1-3-1 unit-l-1-3-1">
    <div class="unit-spacer">
      <h2>Announcements</h2>
      <div id="main-slider" class="liquid-slider">
    <div>
      <h2 class="title">1</h2>
      <p class="bold">VMW 2017:</p>
      <p class="body">VMW 2017 will  be held in Rome, Italy on June 5 - 6, 2017.</p>
<!-- 
      <p class="bold">Poster Board Dimensions:</p>
      <p class="body">Authors presenting via poster boards are to be informed that poster boards are 110 cm height and 80 cm width.</p> -->
    </div>          
    <div>
      <h2 class="title">2</h2>
      <p class="bold">Best Paper Award:</p>
      <p class="body">Two best paper awards will be conferred to author(s) of the papers that receive the highest rank during the peer-review and by the respected session chairs. Please visit <a href="../papers" class="body-link">Paper Submission</a> for more information.</p>
    </div>
    <div>
      <h2 class="title">3</h2>
      <p class="bold">Propose Exhibits, Workshops & More</p>
      <p class="body">SNSM attracts a wide range of researchers in the field of nanotechnology. As a prominent company in the field of nanotechnology, we would like to offer you an exhibit at SNSM. Please visit <a href="../events" class="body-link">Events</a> for more information.</p>
    </div>

  </div>

    </div>
  </div>

<div class="unit unit-s-1 unit-m-1-4-1 unit-l-1-4-1">
  <div class="unit-spacer content">
    <p class="body">Thank you for filling out the registration form. You should receive an email with your information. Please keep this email for your reference.</p>

    <p class="body">If you do not receive an email, <strong>please check your SPAM folder</strong>.</p>

  <p class="body">If you have requested any official invitation letters, please allow up to 5 business days to receive your documents.</p> 

    <p class="body">If there are any problems in the information you have filled out, please write an email to us at <a href="mailto:registration@vmwconference.com" class="body-link">registration@vmwconference.com</a> mentioning the mistakes made. Please note that you SHOULD NOT refill the form.</p>

  <p class="body">We are looking forward to seeing you at VMW'17!</p>
  </div>
</div>

  <div class="unit unit-s-1 unit-m-1-3-1 unit-l-1-3-1">
  <div class="unit-spacer">
    <section class="main">
        <div class="custom-calendar-wrap">
          <div id="custom-inner" class="custom-inner">
            <div class="custom-header clearfix">
              <nav>
                <span id="custom-prev" class="custom-prev"></span>
                <span id="custom-next" class="custom-next"></span>
              </nav>
              <h2 id="custom-month" class="custom-month"></h2>
              <h3 id="custom-year" class="custom-year"></h3>
            </div>
            <div id="calendar" class="fc-calendar-container"></div>
          </div>
        </div>
      </section>
    <h2>Upcoming Dates</h2>

<div class="grid events">
<div class="unit unit-s-1 unit-m-1-4 unit-l-1-4">
  <div class="date">
    Dec. 1, 2016
  </div>
</div>

<div class="unit unit-s-1 unit-m-3-4 unit-l-3-4">
  <div class="unit-spacer">
    Paper Submission Deadline
  </div>
</div>
</div>

<div class="grid events">
<div class="unit unit-s-1 unit-m-1-4 unit-l-1-4">
  <div class="date">
    Feb. 15, 2017
  </div>
</div>

<div class="unit unit-s-1 unit-m-3-4 unit-l-3-4">
  <div class="unit-spacer">
    Notification of Authors
  </div>
</div>
</div>

<div class="grid events">
<div class="unit unit-s-1 unit-m-1-4 unit-l-1-4">
  <div class="date">
    Mar. 1, 2017
  </div>
</div>

<div class="unit unit-s-1 unit-m-3-4 unit-l-3-4">
  <div class="unit-spacer">
    Final Version of Extended Abstract or Paper Submission Deadline
  </div>
</div>
</div>

  </div>
  </div>
</div>

<footer id="contact">
  <div class="grid">
  <div class="unit unit-s-1 unit-m-1-3 unit-l-1-3">
  <div class="unit-spacer">
    <h2>Contact Us</h2>
    <p class="body">International ASET Inc.<br>
    Unit No. 417, 1376 Bank St.<br>
    Ottawa, Ontario, Canada<br>
    Postal Code: K1H 7Y3<br>
    +1-613-695-3040<br>
    <a href="mailto:info@vmwconference.com">info@vmwconference.com</a></p>
    </div>
  </div>

  <div class="unit unit-s-1 unit-m-2-3 unit-l-2-3 contact">
  <div class="unit-spacer">
  <p class="body">For questions or comments regarding VMW'17, please fill out the form below:</p>

    <form action="../contactus.php" method="post" enctype="multipart/form-data" name="ContactForm">
  
  <table border="0" class="contact">
    <tbody>
      <tr>
        <td class="label">Name:</td>
        <td class="text"><span id="sprytextfield1">
              <input name="Name" type="text" id="Name" size="40" autocomplete="off">

              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
        </tr>

        <tr>
            <td class="label">Email:</td>
            <td class="text"><span id="sprytextfield2">
            <input name="Email" type="text" id="Email" size="40" autocomplete="off">
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
          </tr>

          <tr>
            <td class="label">Confirm Email:</td>
             <td class="text"><span id="spryconfirm4">
              <input name="Confirm Email" type="text" id="Confirm Email" size="40" autocomplete="off">
              <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">Emails don't match.</span></span></td>
          </tr>

          <tr>
            <td class="label">Subject:</td>
            <td class="text"><span id="sprytextfield3">
              <input name="Subject" type="text" id="Subject" size="40" autocomplete="off">
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>

          <tr>
            <td valign="top" class="label">Message:</td>
            <td class="text"><span id="sprytextarea1">
              <textarea name="Message" id="Message" cols="31" rows="10" autocomplete="off"></textarea>
              <span class="textareaRequiredMsg">A value is required.</span></span>
              <center>
        <input type="submit" name="Submit" value="Submit" accept="image/jpeg">
        <input type="reset" name="Reset" value="Reset"></center></td>
          </tr>

        </tbody></table><br>

        
</form>
    </div>
  </div>
  </div>
</footer> 

<div class="copyright">
  <a href="http://international-aset.com">International ASET Inc.</a> | <a href="http://international-aset.com/phplistpublic/?p=subscribe&id=1">Subscribe</a> | <a href="../terms">Terms of Use</a> | <a href="../sitemap">Sitemap</a>
  <p class="body">&copy; Copyright International ASET Inc., 2016. All rights reserved.</p>
  <p class="copyright1">Have any feedback? Please provide them here: <script>var refURL = window.location.protocol + "//" + window.location.host + window.location.pathname; document.write('<a href="http://international-aset.com/feedback/?refURL=' + refURL+'" class="body-link">Feedback</a>');</script></p>
</div>
</div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="../js/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="../js/jquery.calendario.js"></script>
    <script type="text/javascript" src="../js/data.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
  <script src="../js/jquery.liquid-slider.min.js"></script>  
  <script src="../js/classie.js"></script>
    <script src="../js/cbpAnimatedHeader.min.js"></script>
    <script src="../js/SpryValidationSelect.js" type="text/javascript"></script>

    <script src="../js/SpryValidationTextField.js" type="text/javascript"></script>

    <script src="../js/SpryValidationConfirm.js" type="text/javascript"></script>

    <script src="../js/SpryValidationCheckbox.js" type="text/javascript"></script>
    <script src="../js/SpryValidationTextarea.js" type="text/javascript"></script>

    <script type="text/javascript">
/*
  Slidemenu
*/
(function() {
  var $body = document.body
  , $menu_trigger = $body.getElementsByClassName('menu-trigger')[0];

  if ( typeof $menu_trigger !== 'undefined' ) {
    $menu_trigger.addEventListener('click', function() {
      $body.className = ( $body.className == 'menu-active' )? '' : 'menu-active';
    });
  }

}).call(this);
</script>

    <script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");

var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");

var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");

var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");

var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1"});

var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "email");

var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");

var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {invalidValue:"-1", isRequired:false});

var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "date", {format:"mm/dd/yyyy"});

var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
</script>


    <script type="text/javascript"> 
      $(function() {
      
        var transEndEventNames = {
            'WebkitTransition' : 'webkitTransitionEnd',
            'MozTransition' : 'transitionend',
            'OTransition' : 'oTransitionEnd',
            'msTransition' : 'MSTransitionEnd',
            'transition' : 'transitionend'
          },
          transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
          $wrapper = $( '#custom-inner' ),
          $calendar = $( '#calendar' ),
          cal = $calendar.calendario( {
            onDayClick : function( $el, $contentEl, dateProperties ) {

              if( $contentEl.length > 0 ) {
                showEvents( $contentEl, dateProperties );
              }

            },
            caldata : codropsEvents,
            displayWeekAbbr : true
          } ),
          $month = $( '#custom-month' ).html( cal.getMonthName() ),
          $year = $( '#custom-year' ).html( cal.getYear() );

        $( '#custom-next' ).on( 'click', function() {
          cal.gotoNextMonth( updateMonthYear );
        } );
        $( '#custom-prev' ).on( 'click', function() {
          cal.gotoPreviousMonth( updateMonthYear );
        } );

        function updateMonthYear() {        
          $month.html( cal.getMonthName() );
          $year.html( cal.getYear() );
        }

        // just an example..
        function showEvents( $contentEl, dateProperties ) {

          hideEvents();
          
          var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
            $close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );

          $events.append( $contentEl.html() , $close ).insertAfter( $wrapper );
          
          setTimeout( function() {
            $events.css( 'top', '0%' );
          }, 25 );

        }
        function hideEvents() {

          var $events = $( '#custom-content-reveal' );
          if( $events.length > 0 ) {
            
            $events.css( 'top', '100%' );
            Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();

          }

        }
      
      });
    </script>

        <script>
    $('#main-slider').liquidSlider();
  </script>
  <script>
(function($){
        $(window).load(function(){
            $("html").niceScroll();
        });
    })(jQuery);
</script>
</body>
</html>
