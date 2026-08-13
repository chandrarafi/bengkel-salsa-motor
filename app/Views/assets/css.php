    <!-- JQuery Modal css (Commented out to prevent conflict with Bootstrap 5 modals) -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/lib/jquery.modal.min.css'); ?>"> -->
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/remixicon.css'); ?>">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/bootstrap.min.css'); ?>">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/apexcharts.css'); ?>">
    <!-- SweetAlert2 css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/sweetalert2.min.css'); ?>">
    <!-- Data Table css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/dataTables.min.css'); ?>">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/editor-katex.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/editor.atom-one-dark.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/editor.quill.snow.css'); ?>">
    <!-- Date picker css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/flatpickr.min.css'); ?>">
    <!-- Calendar css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/full-calendar.css'); ?>">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/jquery-jvectormap-2.0.5.css'); ?>">
    <!-- Popup css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/magnific-popup.css'); ?>">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/slick.css'); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/select2.min.css'); ?>">
    <!-- main css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <style>
        /* SweetAlert2 Popup Clean Styling */
        .swal2-container {
            z-index: 1060 !important;
        }
        .swal2-popup {
            width: 380px !important;
            max-width: 90vw !important;
            padding: 24px 20px !important;
            border-radius: 16px !important;
            font-family: inherit !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        }
        .swal2-icon {
            margin: 4px auto 16px auto !important;
        }
        .swal2-title {
            font-size: 18px !important;
            font-weight: 700 !important;
            color: #1f2937 !important;
            padding: 0 !important;
            margin: 0 0 8px 0 !important;
            line-height: 1.4 !important;
            overflow: visible !important;
        }
        .swal2-html-container {
            font-size: 14px !important;
            color: #4b5563 !important;
            margin: 0 0 16px 0 !important;
            padding: 0 !important;
            line-height: 1.5 !important;
        }
        .swal2-actions {
            margin-top: 12px !important;
            gap: 10px !important;
        }
        .swal2-actions button {
            font-size: 13px !important;
            padding: 8px 20px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
        }

        /* Clean Form Validation Normalization */
        .icon-field {
            position: relative !important;
            display: block !important;
        }
        .icon-field .icon {
            position: absolute !important;
            left: 12px !important;
            top: 19px !important;
            transform: translateY(-50%) !important;
            font-size: 16px !important;
            color: #9ca3af !important;
            pointer-events: none !important;
            z-index: 5 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 16px !important;
            width: 16px !important;
        }
        .icon-field .form-control,
        .icon-field .form-select {
            padding-left: 38px !important;
        }
        .form-control.is-invalid, .form-control.is-valid,
        .form-select.is-invalid, .form-select.is-valid,
        .was-validated .form-control:invalid, .was-validated .form-control:valid,
        .was-validated .form-select:invalid, .was-validated .form-select:valid {
            background-image: none !important;
            padding-right: 12px !important;
        }
        .was-validated .form-control:valid,
        .was-validated .form-select:valid,
        .form-control.is-valid,
        .form-select.is-valid {
            border-color: #d1d5db !important;
            box-shadow: none !important;
        }
        .was-validated .form-control:invalid,
        .was-validated .form-select:invalid,
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.15) !important;
        }
        .invalid-feedback {
            font-size: 12px !important;
            color: #dc3545 !important;
            margin-top: 4px !important;
            font-weight: 500 !important;
        }
        .is-invalid ~ .invalid-feedback,
        .is-invalid + .invalid-feedback {
            display: block !important;
        }

        /* Sidebar Group Header & Badge Styling */
        .sidebar-menu-group-title {
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            color: #94a3b8 !important;
            padding: 16px 20px 8px 16px !important;
            list-style: none !important;
        }
        .text-xxs {
            font-size: 10px !important;
        }

        /* Bootstrap 5 Modal Clean Normalization */
        .modal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            z-index: 1055 !important;
            width: 100% !important;
            height: 100% !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
            outline: 0 !important;
            background: rgba(0, 0, 0, 0.4) !important;
            padding: 0 !important;
            max-width: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
        }
        .modal-dialog {
            position: relative !important;
            width: auto !important;
            margin: 1.75rem auto !important;
            pointer-events: none !important;
            max-width: 480px !important;
        }
        .modal-dialog-centered {
            display: flex !important;
            align-items: center !important;
            min-height: calc(100% - 3.5rem) !important;
        }
        .modal-content {
            position: relative !important;
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            pointer-events: auto !important;
            background-color: #ffffff !important;
            background-clip: padding-box !important;
            border: 0 !important;
            border-radius: 12px !important;
            outline: 0 !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        }
        .modal-backdrop {
            display: none !important;
        }
    </style>