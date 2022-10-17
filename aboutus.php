<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    include('includes/header.php');
?>
<?php
    $pagetype = $_GET['type'];
    $sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
?>

        
    <body>
        <?php include('includes/nav.php'); ?>

            <?php include('includes/header.php'); ?>
            <!-- Page Content -->
            <div class="container">
            
            <h3 class="text-center">LIFELINE: Blood Donations Terms</h3>
 
 <p>
    <strong>
    LIFELINE: Blood Donation Web app Feature Terms.
    </strong>
    <ul>
        <li>LIFELINE blood donation Web app aims to connect people who want to express interest in donating blood with blood camps voluntarily and blood requesters in emergencies in their geographical area that are seeking blood donors and allows people who use the Web app ("Users") to sign-up, to receive notifications from LIFELINE about blood donation opportunities near them. The donation app can also connect Users with people and non-Blood Bank organizations in the User's geographical area ("Donees"). Here are more details about the terms of service for the LIFELINE Web app Feature (the "Terms") upon which Users and Barangay Healthcare Centers, Rural Healthcare Centers, and Hospitals may use the LIFELINE Web app.</li>
    </ul>
 </p>
  
 <p>LIFELINE is not a blood bank.
    <ul>
        <li>LIFELINE is not a blood bank, and LIFELINE is not affiliated with any blood bank.</li>
    </ul>
</p>
  
<p> 
    <strong>
    LIFELINE's goal is to cooperate with the promotion of voluntary blood donation.
    </strong>
<ul>
    <li>Blood donation is a voluntary service, and LIFELINE does not guarantee that a person or User will agree to donate blood whenever called upon. Users may opt out of receiving notifications at any time.
 Users and Hospitals have the right to stop participating in this Web app at any time.
</li>
<li>
 No express or implied contract is created with this among any parties using the LIFELINE Web app features.</li>
</ul> 
</p>
  
 <p>
    <strong>LIFELINE serves only as an intermediary and facilitator.</strong>
    <ul>
        <li>When providing the Web app, LIFELINE does not engage with RHU, and Hospital activities and does not arrange blood donors. LIFELINE only facilitates contact between people, including Users, with BHW, RHU, and Hospitals in need of blood, providing relevant information about the organizations and those in need of blood to potential blood donors.</li>
        <li>LIFELINE is not responsible for the contact made between users, including Users, BHW, RHU, and Hospitals, nor is LIFELINE accountable for the User's or the organizations' actions before or after contact is made. LIFELINE is not responsible for any misuse of the contact information displayed. LIFELINE gives no assurance concerning the authenticity, accuracy, or correctness of the information provided by the User or the organization behind their activities. The people using the Web app, including Users, and the BHW, RHU, and Hospitals, are responsible for verifying the information provided by the others.</li>
        <li>LIFELINE does not receive any protected health information.</li>
        <li>Under no circumstances will LIFELINE have access to any User's health information or records obtained from or arising out of any eligibility exams or other procedures performed by the BHW, RHU, and Hospitals.</li>
        <li>LIFELINE will not, to the extent permitted under Applicable Law, be responsible for any claims, disputes, suits, actions, proceedings, losses, injury, damages, or harm (including, but not limited to, loss of personal data, personal injury, or loss of life) caused to the User, the Organizations, or any third party due to any interaction between people using the Web app, including Users, Organizations, or any third party.</li>
    </ul>
  </p>
  
 <p>
<strong> LIFELINE does not accept money or incentives for facilitating blood donation.</strong>
 <ul>
 <li> LIFELINE does not, directly or indirectly, receive or provide any cash or non-cash rewards or incentives for facilitating voluntary blood donation.</li>
 </ul>
  
 </p>
 
 <p>
    <strong>LIFELINE does not endorse or promote.</strong>
    <ul>
    <li>
 When providing the Web app, LIFELINE does not promote any treatment, drugs, services, remedies, or activities that claim to have the power to cure, diagnose, prevent, or mitigate any disease or other illness.
      </li>
    </ul>
  </p>

 <p>
<strong> Use of the Web app is subject to LIFELINE's other terms and conditions.</strong>
 <ul>
    <li>You understand that the collection, processing, storage, and transfer of information obtained by LIFELINE about your use of the Web app is by LIFELINE's Data Policy.</li>
    </li> You should only use any information or content provided in the Web app for these Terms.</li>
    </li>LIFELINE reserves the right to deny or terminate any User's or BHW, RHU, and Hospital's participation in or access to the Web app or to remove the Web app for any reason at any time.</li>
 </ul>
 
  
 </p>

 <p>
<strong> User Specific Terms</strong>
    <ul>
        <li>
                When you sign up as a User, you voluntarily express an interest in donating blood and agree to receive updates or notifications when BHW, RHU, Hospitals, and Blood Seekers in your geographical area are looking for blood donors.
        </li>
    </ul>

  
 </p>

 <p>
    
    <strong>Your use of the LIFELINE Web app Feature.</strong>   
<ul>
    <li>
 You may opt-out of the Web app as a User and stop receiving updates at any time through your LIFELINE profile.
  Blood donation is voluntary, and it is your discretion to donate blood.</li>
</ul>
  </p>
 
  <p>
  <strong>LIFELINE is not a medical provider and does not provide medical advice.</strong>
  <ul>
    <li>
You should seek and obtain appropriate medical advice from qualified medical professionals before participating in blood donation activities. LIFELINE does not conduct any independent health or background checks.
 
  </li>
  <li>
 LIFELINE does not guarantee that you will be eligible or able to donate blood. The RHU and the Hospitals are responsible for taking all steps required to determine your eligibility and ability to donate blood.
  </li>
</ul>
 
  </p>
 
 
  
 <p>
 <strong> LIFELINE is not responsible for the BHW, RHU, and Hospital activities or operations.</strong>   

    <ul>
        <li>
        LIFELINE is not responsible for assessing the licensure, accreditation, or reputation of a BHW, RHU, Hospitals, and even Blood Banks. Users are solely responsible for evaluating the fitness of a BHW, RHU, and Hospital before donating blood.

        </li>
        <li>
        LIFELINE is not responsible for any information collected, created by, or about the BHW, RHU, and Hospitals. Users should review local regulations and policies to confirm that they comply with Applicable Laws.
        </li>
    </ul>
  
  </p>

  <p>
  <strong>RHU and Hospitals Specific Terms</strong>
    <ul>
        

        <li>
        When you register as RHU or Hospital for the Feature, you express an interest in connecting with potential blood donors in your geographic regions. You agree that LIFELINE may share your interest through this Web app Feature. You may also use this feature to create posts and events/announcements on LIFELINE.
        </li>
    </ul>
  
  </p>

<p>
    <strong>The RHU and Hospitals are solely responsible for determining the Donor's eligibility to donate blood.</strong>
<ul>
    <li>
        LIFELINE does not conduct any independent health or background checks. LIFELINE cannot certify that any person, including a User, will be free from any disease or medical conditions preventing the person from donating blood when the Donor contacts the RHU or Hospital.
    </li>
    <li>
        RHU and Hospitals will not provide LIFELINE any protected health information.
    </li>
    <li>
        RHU, Hospitals, and Donees agree to provide LIFELINE upon request with anonymous or aggregated level data relating to the number of Donors who came to them through the LIFELINE Web app.
    </li>
</ul> 
 </p>
 
 
            </div>


                    
   

    <!-- Footer -->
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  

</body>

</html>