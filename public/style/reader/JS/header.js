document.getElementById('userImage').addEventListener('click', function() {
    var profileMenu = document.getElementById('profileMenu');
    if (profileMenu.style.display === 'block') {
        profileMenu.style.display = 'none';
    } else {
        profileMenu.style.display = 'block';
    }
});

document.addEventListener('click', function(event) {
    var profileMenu = document.getElementById('profileMenu');
    var userImage = document.getElementById('userImage');
    if (!profileMenu.contains(event.target) && !userImage.contains(event.target)) {
        profileMenu.style.display = 'none';
    }
});
