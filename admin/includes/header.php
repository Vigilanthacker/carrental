<div class="brand clearfix">
    <a href="dashboard.php" style="font-size: 20px;">Car Rental Portal | Admin Panel</a>
    <a href="#" class="second-button" id="hamburgerButton" style="margin-left: 10px;"><i class="fa fa-bars"></i></a> <!-- Second button (hamburger) -->
    <a href="#" class="menu-btn" style="margin-left: 10px;"><i class="fa fa-bars"></i></a> <!-- Hamburger button -->
    <ul class="ts-profile-nav">

        <li class="ts-account">
            <a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>

<script>
    $(document).ready(function(){
        // Toggle visibility of the sidebar only with the hamburger button
        $('#hamburgerButton').click(function(){
            $('.left-sidebar').toggleClass('hidden');
        });
    });
</script>
