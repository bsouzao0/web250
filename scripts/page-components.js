$(document).ready(function() {
    
    // Head
 

    // Header
    $('body').prepend($('<header>').load('components/header.html'));

    // Footer
    $('body').append($('<footer>').load('components/footer.html'));
});