    <!-- Footer opened -->
    <div class="main-footer">
        <div class="container-fluid pd-t-0-f ht-100p">
            <span>Copyright © 2020 <a href="#">Dashfox</a>. Designed by <a href="https://www.spruko.com/">Spruko</a> All rights reserved.</span>
        </div>
    </div>
    <!-- Footer closed -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

    <!-- JQuery min js -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>

    <!-- Bootstrap4 js-->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Ionicons js -->
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

    <!-- Moment js -->
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

    <!-- Rating js-->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
    <script src="{{ asset('assets/plugins/rating/jquery.barrating.js') }}"></script>

    <!--Internal  Perfect-scrollbar js -->
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}" defer></script>

    <!-- Left-menu js-->
    <script src="{{ asset('assets/plugins/side-menu/sidemenu.js') }}" defer></script>

    <!-- Eva-icons js -->
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

    <!-- right-sidebar js -->
    <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/sidebar/sidebar-custom.js') }}" defer></script>

    <!-- Sticky js -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/js/modal-popup.js') }}"></script>

    <!-- Suggestion js-->
    <script src="{{ asset('assets/plugins/suggestion/jquery.input-dropdown.js') }}" defer></script>
    
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('assets/js/custom.js') }}" defer></script>
    @yield('script')

    <script>
        $(document).ready(function() {
            @if(Session::has('pass_error'))
            swal(
                {
                    title: 'Gagal!',
                    text: "{{ Session::get('pass_error') }}!",
                    type: 'error',
                    confirmButtonColor: '#57a94f'
                }
            )
            @endif
        })
    </script>

    </body>
</html>