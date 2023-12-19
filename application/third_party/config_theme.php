<script type="text/javascript">
    const firebaseConfig = {
        apiKey: "<?= $_ENV['API_KEY'] ?>",
        authDomain: '<?= $_ENV['AUTH_DOMAIN'] ?>',
        databaseURL: "<?= $_ENV['DATABASE_URL'] ?>",
        projectId: "<?= $_ENV['PROJECT_ID'] ?>",
        storageBucket: "<?= $_ENV['STORAGE_BUCKET'] ?>",
        messagingSenderId: "<?= $_ENV['MESSAGING_SENDER_ID'] ?>",
        appId: "<?= $_ENV['APP_ID'] ?>",
    };
    firebase.initializeApp(firebaseConfig);
    let db = firebase.database();

    const themes = db.ref('field_theme')

    themes.on('value', snapshot)

    function snapshot(success) {
        let val = success.val();

        if (val.theme_mode === "light") {
            $('#bootstrap-stylesheet').prop('href', '<?= base_url('assets/admin-assets') ?>' + val.theme_color_bootstrap_light);
            $('#app-stylesheet').prop('href', '<?= base_url('assets/admin-assets') ?>' + val.theme_color_app_light);
            $('#light-mode-switch').prop('checked', true);
            $('#dark-mode-switch').prop('checked', false);
        } else if (val.theme_mode === "dark") {
            $('#bootstrap-stylesheet').prop('href', '<?= base_url('assets/admin-assets') ?>' + val.theme_color_bootstrap_dark);
            $('#app-stylesheet').prop('href', '<?= base_url('assets/admin-assets') ?>' + val.theme_color_app_dark);
            $('#light-mode-switch').prop('checked', false);
            $('#dark-mode-switch').prop('checked', true);
        }
    }
</script>