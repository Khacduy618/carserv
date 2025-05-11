<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo (!empty($page_title)) ? $page_title : 'Shop-PHP2' ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/site/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= _WEB_ROOT; ?>/public/assets/toastr.css">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/owlcarousel/assets/owl.carousel.min.css"
        rel="stylesheet">
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/site/css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/site/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <?php
    $this->render('frontend/blocks/header');
    $this->render($content, $sub_content);
    $this->render('frontend/blocks/footer');
    ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/wow/wow.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/easing/easing.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/counterup/counterup.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script
        src="<?php echo _WEB_ROOT; ?>/public/assets/site/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/site/js/main.js"></script>
    <script src="<?= _WEB_ROOT; ?>/public/assets/toastr.js"></script>
    <script>
        const _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";
    </script>
    <?php
    if (isset($_SESSION['flash_message'])) {
        $flash_message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message after reading
        // Use addslashes to escape quotes in the message for JavaScript
        echo "<script>
        const toasts = new Toasts({
            width: 300,
            timing: 'ease',
            duration: '.5s',
            dimOld: false,
            position: 'top-right'
        });

        toasts.push({
            title: '" . $flash_message['title'] . "',
            content: '" . $flash_message['message'] . "',
            style: '" . $flash_message['type'] . "',
            closeButton: true,
            // link: 'https://codeshack.io',
            // linkTarget: '_blank',
            onOpen: toast => {
                console.log(toast);
            },
            onClose: toast => {
                console.log(toast);
            }
        });

        // toasts.push({
        //     title: 'Success Toast',
        //     content: 'My notification description.',
        //     style: 'success'
        // });

        // toasts.push({
        //     title: 'Verified Toast',
        //     content: 'My notification description.',
        //     style: 'verified'
        // });

        // toasts.push({
        //     title: 'Error Toast',
        //     content: 'My notification description.',
        //     style: 'error'
        // });

        // toasts.push({
        //     title: 'Toast',
        //     content: 'My notification description.'
        // });

        // Press SPACE to add a custom toast
        // window.onkeyup = event => {
        //     if (event.key == ' ') {
        //         toasts.push({
        //             title: 'Custom ' + (toasts.numToasts+1),
        //             content: 'Custom description ' + (toasts.numToasts+1) + '.'
        //         });
        //     }
        // };
        </script>
        ";
    }
    ?>
</body>

</html>