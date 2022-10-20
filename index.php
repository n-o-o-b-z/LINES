<?php
error_reporting(0);
$page = 'Home';
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

    <?php include('includes/header.php'); ?>
    <link rel="manifest" href="manifest.json">
<body style="padding-top:0px !important">

    <!-- Navigation -->
    <?php 
    include('includes/nav.php'); ?>
    <?php include('includes/slider.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <h1 class="my-4">Maligayang Pagdating Sa LIFELINE Blood Seeker Website</h1>

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header">Pangangailangan Sa Dugo</h4>

                    <!-- paragraph -->
                    <?php
                        $pagetypes = 'needforblood';
                        $pagetype = $pagetypes;
                        $sql = "SELECT type,detail from tblpages where type=:pagetype";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                        <?php echo $result->detail; ?>
                        
                    <?php }} ?>
                    <!-- end paragraph -->

                </div>
                
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header">Sa Magbibigay Ng Dugo</h4>

                        <!-- paragraph -->
                        <?php
                        $pagetypes = 'bloodtips';
                        $pagetype = $pagetypes;
                        $sql = "SELECT type,detail from tblpages where type=:pagetype";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                        <?php echo $result->detail; ?>
                        <?php }} ?>
                        <!-- end paragraph -->
                </div>
            </div>

        <div class="col-lg-4 mb-4">
            <div class="card">
                <h4 class="card-header">Mga Iyong Matulongan</h4>

                <!-- paragraph -->
                    <?php
                        $pagetypes = 'whocouldyouhelp';
                        $pagetype = $pagetypes;
                        $sql = "SELECT type,detail from tblpages where type=:pagetype";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                        <?php echo $result->detail; ?>
                    <?php }} ?>
                <!-- end paragraph -->

            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Section -->
    <h2>Mga Donors</h2>

    <div class="row">
        <?php
        $status = 0;
        $sql = "SELECT * from tblblooddonars where status=:status order by rand() limit 6";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>

                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top img-fluid" src="images/blood-donor.jpg" alt=""></a>
                        <div class="card-block">
                            <h4 class="card-title"><a href="#"><?php echo htmlentities($result->FullName); ?></a></h4>
                            <p class="card-text"><b> Gender :</b> <?php echo htmlentities($result->Gender); ?></p>
                            <p class="card-text"><b>Blood Group :</b> <?php echo htmlentities($result->BloodGroup); ?></p>

                        </div>
                    </div>
                </div>

        <?php }
        } ?>





    </div>
    <!-- /.row -->

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-6">
            <h2>BLOOD GROUPS</h2>
            <p> Ang blood group ng isang tao ay maaring bumagsak sa anomang sumusod na grupo.</p>
            <ul>


                <li>A positive or A negative</li>
                <li>B positive or B negative</li>
                <li>O positive or O negative</li>
                <li>AB positive or AB negative.</li>
            </ul>
            <p>Ang healthy diet ay makakatulong para masiguradong magiging maayus ang iyong blood donation, at makakabuti sa iyong pakiramdam!</p>
            <h3>Requirements upang maging blood donor:</h3>
            <ul>
                <li>Weight: At least 110 lbs (50 kg).</li>
                <li>Blood volume collected will depend mainly on you body weight.</li>
                <li>Pulse rate: Between 60 and 100 beats/minute with regular rhythm.</li>
                <li> Blood pressure: Between 90 and 160 systolic and 60 and 100 diastolic.</li>
                <li> Hemoglobin: At least 125 g/L.</li>
                <p><i>For more info. visit:&nbsp;<a href="https://doh.gov.ph/node/1449" target="_blank">Department of Health</a></i></p>
            </ul>
            <br>
            <h3>Kadalasang mga Katanungan?</h3>
            <ol>
                <li>Gaano kadalas maaring mag donate?</li>
                <ul>
                    <li>Ang malusog na individual ay maaring magdonate tuwing tatlong buwan.</li>
                </ul>
                <li>Ang pagbibigay ng dugo ay nakakapagpahina sa tao?</li>
                <ul>
                    <li>Hindi, hindi nakakapagpahina ang pagbibigay ng dugo. Ang pagbibigay ng 450cc na dugo ay hindi nagreresulta ng karamdaman o panghihina.
                        Ang katawan ng tao ay may kakayahan palitan ang nawalang dami ng dugo. Further, the bone marrow is stimulated
                        to produce new blood cells which in turn makes the blood forming organs function more effectively.</li>
                </ul>
                <li>Maari parin bang ang may tattoo at body piercing sa katawan ay magkapagbigay ng dugo?</li>
                <ul>
                    <li>Kung ang pagtatattoo ay nangyari isang taon ng nakakalipas, siya ay maari parin makapag donate.
                        Applicable rin ito sa nagpa acupuncture, at iba pang proseso na may kinalaman ang karayom.</li>
                </ul>
                <li>Gaano katagal magdonate ng dugo?</li>
                <ul>
                    <li>Ang pangkalahatang proseso ng blood donation simula sa pagpapa-rehistro hanggang sa recovery, ay maaring umabot ng 30 na minuto.
                        Ang extraction ng dugo ay aabot ng 5-10 na minuto. The blood volume will start replenishing within 24 hours.
                        Theoretically, by the end of the month, the body will have the blood status before the blood donation.</li>
                </ul>
                <li>Makakakuha ba ako ng sakit kapag nagdonate ako ng dugo?</li>
                <ul>
                    <li>Hindi, gumagamit sila ng sterile, disposable needles and syringes.</li>
                </ul>
            </ol>
            <p><i>For more info. visit:&nbsp;<a href="https://redcross.org.ph/give-blood/" target="_blank">Philipine Red Cross</a></i></p>
        </div>
        <div class="col-lg-6">
            <img class="img-fluid rounded" src="images/blood-donor (1).jpg" alt="">
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h4>UNIVERSAL DONORS AND RECIPIENTS</h4>
            <p>
                Ang pinaka common blood type ay O, sumunod naman ay type A.

                Ang mga individual na may type O na dugo ay tinatawag na "universal donors" dahil ang kanilang dugo ay maisasalin sa ano mang klase ng dugo o blood type. Para naman sa mga individual na may blood type na AB ay tinatawag na "universal recipients" dahil pwedi silang tumanggap ng kahit anong klase ng dugo.</p>
        </div>
        <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="become-donor.php">Become a Donor</a>
        </div>
    </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>


    <!-- <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: 'Donate',
            showCloseButton: true,
            // cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Donated!',
                'You have been donated.',
                'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
    </script> -->

<script>
    $(document).ready(function () {
        var url = './includes/xhr.php';
        $.ajax({
            type: "GET",
            url: url,
            data: "data",
            dataType: "dataType",
            success: function (response) {
                console.log(response[0].data);
            }
        });
    

        self.addEventListener("install", function(event) {
  event.waitUntil(preLoad());
});

var preLoad = function(){
  console.log("Installing web app");
  return caches.open("offline").then(function(cache) {
    console.log("caching index and important routes");
    return cache.addAll(["/blog/", "/blog", "/", "/contact", "/resume", "/offline.html"]);
  });
};

self.addEventListener("fetch", function(event) {
  event.respondWith(checkResponse(event.request).catch(function() {
    return returnFromCache(event.request);
  }));
  event.waitUntil(addToCache(event.request));
});

var checkResponse = function(request){
  return new Promise(function(fulfill, reject) {
    fetch(request).then(function(response){
      if(response.status !== 404) {
        fulfill(response);
      } else {
        reject();
      }
    }, reject);
  });
};

var addToCache = function(request){
  return caches.open("offline").then(function (cache) {
    return fetch(request).then(function (response) {
      console.log(response.url + " was cached");
      return cache.put(request, response);
    });
  });
};

var returnFromCache = function(request){
  return caches.open("offline").then(function (cache) {
    return cache.match(request).then(function (matching) {
     if(!matching || matching.status == 404) {
       return cache.match("offline.html");
     } else {
       return matching;
     }
    });
  });
};

document.addEventListener("DOMContentLoaded", showCoffees);

if ("serviceWorker" in navigator) {
  window.addEventListener("load", function() {
    navigator.serviceWorker
      .register("/serviceWorker.js")
      .then(res => console.log("service worker registered"))
      .catch(err => console.log("service worker not registered", err));
  });
}



</script>
    
</body>

</html>