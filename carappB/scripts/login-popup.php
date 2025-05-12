
<div class="overlay" id="overlay" style="display:none;"></div>

<div class="login-popup" id="loginPopup" style="display:none;">
    <div class="close-btn" id="closeBtn">X</div>
    <h3>Login</h3>
    <form id="loginForm" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
        <p id="loginError" style="color: red;"></p>
    </form>
</div> 

<!-- 
<div class="login-popup" id="signupPopup" style="display:none;">
    <div class="close-btn" id="closeSignupBtn">X</div>
    <h3>Sign Up</h3>
    <form id="signupForm" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required><br><br>

        <label for="new_username">Username:</label>
        <input type="text" name="new_username" id="new_username" required><br><br>

        <label for="new_password">Password:</label>
        <input type="password" name="new_password" id="new_password" required><br><br>

        <input type="submit" value="Create Account">
        <p id="signupError" style="color: red;"></p>
    </form>
</div> !-->

<script>
$(document).ready(function () {

    $('#loginBtn').click(function () {
        $('#signupPopup').hide(); 
        $('#loginPopup').show();
        $('#overlay').show();
    });
/*
    $('#signupBtn').click(function () {
        $('#loginPopup').hide(); 
        $('#signupPopup').show();
        $('#overlay').show();
    });
*/
    $('#closeBtn, #closeSignupBtn, #overlay').click(function () {
        $('#loginPopup').hide();
        $('#signupPopup').hide();
        $('#overlay').hide();
    });

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        $('#loginError').text("");

        $.post('processLogin.php', $(this).serialize(), function (response) {
            if (response.success) {
                location.reload();
            } else {
                $('#loginError').text(response.message);
            }
        }, 'json');
    });

   /* $('#signupForm').on('submit', function (e) {
        e.preventDefault();

        $('#signupError').text("");

        $.post('processSignup.php', $(this).serialize(), function (response) {
            if (response.success) {
                $('#signupError').css('color', 'green').text("Account created successfully! You can now log in.");
                $('#signupForm')[0].reset();
            } else {
                $('#signupError').css('color', 'red').text(response.message);
            }
        }, 'json');
    });*/
});

</script>
