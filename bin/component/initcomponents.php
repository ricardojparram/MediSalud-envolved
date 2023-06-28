<?php 

  namespace component;
   

   class initcomponents{
    

    public static function header(){

    $varHeader = '<link rel="icon" href="'._URL_.'assets/img/Logo_Medi.png">
              <!-- Vendor CSS Files -->
              <link href="'._URL_.'assets/sw2/sweetalert2.min.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/quill/quill.snow.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/quill/quill.bubble.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/remixicon/remixicon.css" rel="stylesheet">
              <link href="'._URL_.'assets/vendor/simple-datatables/style.css" rel="stylesheet">
              <link href="'._URL_.'assets/css/dataTables.bootstrap5.min.css"rel="stylesheet" type="text/css" >

              <!-- Template Main CSS File -->
              <link href="'._URL_.'assets/css/style.css" rel="stylesheet">';

    echo $varHeader;

    }
    
    public static function js(){
     $varJs = '
              <script src="'._URL_.'assets/js/jquery-3.6.0.js"></script>  
              <script src="'._URL_.'assets/sw2/sweetalert2.all.min.js"></script>
              <script src="'._URL_.'assets/vendor/apexcharts/apexcharts.min.js"></script>
              <script src="'._URL_.'assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
              <script src="'._URL_.'assets/vendor/chart.js/chart.min.js"></script>
              <script src="'._URL_.'assets/vendor/echarts/echarts.min.js"></script>
              <script src="'._URL_.'assets/vendor/quill/quill.min.js"></script>
              <script src="'._URL_.'assets/vendor/simple-datatables/simple-datatables.js"></script>
              <script src="'._URL_.'assets/vendor/tinymce/tinymce.min.js"></script>
              <script src="'._URL_.'assets/vendor/php-email-form/validate.js"></script>

              <!-- Template Main JS File -->

              <script src="'._URL_.'assets/js/main.js"></script>

              <!-- Page level plugins -->
              <script src="'._URL_.'assets/vendor/datatables/jquery.dataTables.min.js"></script>
              <script src="'._URL_.'assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

              <!-- Page level custom scripts -->
              <script src="'._URL_.'assets/js/datatables-demo.js"></script>
              <script src="'._URL_.'assets/js/validar.js"></script> ';
      echo $varJs;

    }
  }

?>