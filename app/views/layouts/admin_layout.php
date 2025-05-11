<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title><?php echo (!empty($page_title)) ? $page_title : 'Carser' ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/images/favicon.svg" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/admin/css/style-preset.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT; ?>/public/assets/toastr.css">


</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <?php
    if (isset($_SESSION['user'])) {
        $this->render('backend/blocks/sidebar_menu');
        $this->render('backend/blocks/header');
    }
    $this->render($content, $sub_content);
    if (isset($_SESSION['user'])) {
        $this->render('backend/blocks/footer');
    }
    ?>





    <!-- [Page Specific JS] start -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/plugins/apexcharts.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/plugins/popper.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/plugins/simplebar.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/plugins/bootstrap.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/fonts/custom-font.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/pcoded.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/plugins/feather.min.js"></script>





    <script>layout_change('light');</script>




    <script>change_box_container('false');</script>



    <script>layout_rtl_change('false');</script>


    <script>preset_change("preset-1");</script>


    <script>font_change("Public-Sans");</script>
    <script src="<?= _WEB_ROOT; ?>/public/assets/toastr.js"></script>
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
            position: 'top-right' // top-left | top-center | top-right | bottom-left | bottom-center | bottom-right
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
<!-- [Body] end -->

</html>