<script>
    // Clear login notice agreement keys when the user is on the login page (logged out)
    Object.keys(localStorage)
        .filter(function(key) {
            return key.startsWith('docucast_notice_agreed_');
        })
        .forEach(function(key) {
            localStorage.removeItem(key);
        });
</script>
