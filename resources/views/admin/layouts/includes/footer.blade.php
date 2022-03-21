{{-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admins/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admins/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admins/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('admins/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('admins/plugins/sparklines/sparkline.js')}}"></script>
{{-- <!-- JQVMap -->
<script src="{{ asset('admins/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('admins/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ asset('admins/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admins/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('admins/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admins/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('admins/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admins/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admins/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('admins/dist/js/pages/dashboard.js')}}"></script> --}}

<script>
  // $(function(){
  //   // Add active class to nav-link based on url dynamically
  //   // Active class can be hard coded directly in html file also as required
  //   var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
  //   $('#sidebar > .nav > .nav-item > a').each(function() {
  //     var $this = $(this);
  //       //for other url
  //       if(current != 'admin'){
  //           if ($this.attr('href').indexOf(current) !== -1) {
  //           $(this).parents('.nav-item').last().addClass('active');
  //           if ($(this).parents('.nav-item').length) {
  //             $(this).addClass('active');
  //           }
  //         }
  //       }

  //   });
  // });

  var make_button_active = function()
  {
    //Get item siblings
    var siblings =($(this).siblings());
    console.log("siblings:: ",siblings);

    //Remove active class on all buttons
    siblings.each(function (index)
      {
        $(this).removeClass('active');
      }
    )


    //Add the clicked button class
    $(this).addClass('active');
}

//Attach events to menu
$(document).ready(
  function()
  {
    // $(".nav-link").click(make_button_active);
  }  
)

</script>