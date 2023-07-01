<!-- Bootstrap core JavaScript-->

<script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script>


<!-- 
<script>
    document.querySelector('.toggle-password').addEventListener('click', function() {
        var passwordInput = document.querySelector(this.getAttribute('toggle'));
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
</script> -->

<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
</script>

<script>
    setTimeout(function() {
        $('.preloader').fadeOut(1000);
    }, 500);
</script>

<script>
    $(function() {
        $('.alert').delay(2000).fadeOut(1500);
    });
</script>
</body>

</html>