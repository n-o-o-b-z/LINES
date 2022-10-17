  
  
    <footer class="py-5 bg-inverse">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Blood Donors Management Website 2022</p>
        </div>
        <!-- /.container -->
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="css/bootstrap/js/bootstrap.min.js"></script>

    <script>
            $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') ) {
        $(this).collapse('hide');
    }
});
    </script>