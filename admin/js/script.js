$(document).ready(function(){
    $('#toggle-btn').click(function(){
        $('.ts-sidebar').toggleClass('show');
    }); 
    
    // Add new event listener for moving sidebar left/right
    const menuBtn = document.querySelector('.menu-btn');
    const sidebar = document.querySelector('.ts-sidebar');

    menuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-open');
    });
});
