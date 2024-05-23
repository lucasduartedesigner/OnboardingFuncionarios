<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://www.unifeso.edu.br/images/favicon.png">

    <title>Portal do Colaborador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com.br/docs/4.1/examples/starter-template/starter-template.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">

    <style>  
        body
        {
            margin-top: 0px !important;
        }

        .btn-success
        {
            background: #008675;
            border-color: #008675;
        }

        .btn-success:hover
        {
            background: #046d5f;
            border-color: #046d5f;
        }
    </style>

<style>
    
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #ffff;    
    }

    .inner-wrapper {
        position: relative;
        height: calc(100vh - 3.5rem);
        transition: transform 0.3s;
    }

    @media (min-width: 992px) {
        .sticky-navbar .inner-wrapper {
            height: calc(100vh - 3.5rem - 48px);
        }
    }

    .inner-main,
    .inner-sidebar {
        position: absolute;
        top: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
    }
        

    .inner-main {
        right: 0;
        left: 235px;
    }
    
    .inner-main-footer,
    .inner-main-header,
    .inner-sidebar-footer,
    .inner-sidebar-header {
        height: 3.5rem;        
        display: flex;
        align-items: center;
        padding: 0 1rem;
        flex-shrink: 0;
    }

    .inner-main-body,
    .inner-sidebar-body {
        padding: 1rem;
        overflow-y: auto;
        position: relative;
        flex: 1 1 auto;
    }

    .inner-main-body .sticky-top,
    .inner-sidebar-body .sticky-top {
        z-index: 999;
    }

    .inner-main-footer,
    .inner-main-header {
        background-color: #ffff;
    }

    .inner-main-footer,
    .inner-sidebar-footer {
        border-top: 1px solid #cbd5e0;
        border-bottom: 0;
        height: auto;
        min-height: 3.5rem;
    }

    @media (max-width: 767.98px) {
        .inner-sidebar {
            left: -235px;
        }
        .inner-main {
            left: 0;
        }
        .inner-expand .main-body {
            overflow: hidden;
        }
        .inner-expand .inner-wrapper {
            transform: translate3d(235px, 0, 0);
        }
    }

    .nav .show>.nav-link.nav-link-faded, .nav-link.nav-link-faded.active, 
    .nav-link.nav-link-faded:active, .nav-pills .nav-link.nav-link-faded.active, 
    .navbar-nav .show>.nav-link.nav-link-faded {
        color: #389C81;
        background-color: #E1F3F2;
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #389C81;
    }

    .nav-link.has-icon {
        display: flex;
        align-items: center;
    }
    
    .nav-link.active {
        color: #389C81;
    }
    .nav-pills .nav-link {
        border-radius: .25rem;
        color: #389C81;
    }
    
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 10 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }    
    
    .card-header, .card-footer {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #E1F3F2;
        background-clip: border-box;
        border: 10 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    } 
    
</style>
</head>