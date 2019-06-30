<div class="auth-wrapper">
    <form id="form-signin">
        <div class="auth-header">
            <div class="auth-title">Satu Data KKP Kalteng</div>
            <div class="auth-subtitle"><?=get_field('1','settings','meta_value')?></div>
            <!--<div class="auth-label"></div> -->
        </div>
        <div class="auth-body">
            <div class="auth-content">
                <div class="form-group">
                    <label for=""> Username</label>
                    <input class="form-control" placeholder="Enter Username" name="username" type="text" value="">
                    <div class="validation-message" data-field="username"></div>
                </div>
                <div class="form-group">
                    <label for=""> Password</label>
                    <input class="form-control" placeholder="Enter password" name="password" type="password" value="">
                    <div class="validation-message" data-field="password"></div>
                </div>
            </div>
            <div class="auth-footer">
                <button class="btn btn-primary" id="sign-in" type="button">Log me in</button>
                <div class="pull-right auth-link">
                    <label class="check-label"><input type="checkbox" name="keep_login" value="true"> Remember Me</label>
                    <div class="devider"></div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
	$('#sign-in').on("click", function() {
		login();
	});
	$("#form-signin").keypress(function(event) {
		if (event.which == 13) {
			login();
		}
	});

	function login() {
		$('#sign-in').html("Authenticating...").attr('disabled', true);
		var data = $('#form-signin').serialize();
		$.post("<?php echo base_url() . 'auth/login_attempt'; ?>", data).done(function(data) {
			if (data.status == "success") {
				window.location.replace("<?php echo base_url(); ?>");
			} else {
				$('#sign-in').html("Login").attr('disabled', false);
				$('.validation-message').html('');
				$('.validation-message').each(function() {
					for (var key in data) {
						if ($(this).attr('data-field') == key) {
							$(this).html(data[key]);
						}
					}
				});
			}
		});
	}
</script>