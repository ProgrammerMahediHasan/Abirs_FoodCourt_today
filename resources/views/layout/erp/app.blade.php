<!DOCTYPE html>
<html lang="en">

<head>
    <title>Abir's FoodCourt</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/png" href="{{ asset('assets/images/Abir.png') }}"> --}}

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================
           GLOBAL VARIABLES
        ============================ */
        :root {
            --primary: #FF7F50;
            /* Coral */
            --primary-light: rgba(255, 127, 80, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif !important;
        }

        /* ============================
           NAV HEADER / SIDEBAR / HEADER COLOR
        ============================ */
        .nav-header,
        .header,
        .header-content {
            background-color: #FF7F50 !important;
        }
        .deznav {
            background-color: #FFF4E6 !important;
            min-height: 100vh;
        }
        .deznav-scroll,
        .deznav .copyright {
            background-color: #FFF4E6 !important;
        }

        /* ============================
           HAMBURGER & ICONS & HOVER
        ============================ */
        /* Hamburger Color (Black for Coral bg) */
        .nav-header .hamburger .line {
            background-color: #000000 !important;
            background: #000000 !important;
            color: #000000 !important;
        }

        /* Ensure hamburger wrapper is transparent or visible */
        .nav-header .hamburger {
            background-color: transparent !important;
        }

        /* Toggle between Hamburger and Arrow */
        .hamburger.active-arrow .line {
            display: none !important;
        }

        .hamburger.active-arrow .arrow-icon {
            display: block !important;
        }

        /* Always show Logo */
        .nav-header .brand-logo,
        .nav-header img.brand-title {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Sidebar Icons Color (White for Coral bg) */
        .deznav .metismenu>li>a>i {
            color: #333333 !important;
        }

        /* Sidebar Menu Item Hover */
        .deznav .metismenu>li>a:hover,
        .deznav .metismenu>li>a:focus,
        .deznav .metismenu>li.mm-active>a,
        .deznav .metismenu>li:hover>a {
            color: #000000 !important;
            background-color: #FFE8D2 !important;
        }

        /* Ensure icon changes color on hover/active to match text */
        .deznav .metismenu>li>a:hover>i,
        .deznav .metismenu>li>a:focus>i,
        .deznav .metismenu>li.mm-active>a>i,
        .deznav .metismenu>li:hover>a>i {
            color: #000000 !important;
        }

        /* Sidebar Text Color (Default - White) */
        .header a {
            color: #ffffff !important;
            font-size: 15px;
        }
        .deznav a,
        .deznav .nav-label,
        .deznav .metismenu li a {
            color: #333333 !important;
            font-size: 15px;
        }

        /* Header Text Sizing & Color */
        .header .dashboard_bar {
            font-size: 18px !important;
            color: #ffffff !important;
            font-weight: 600;
        }

        /* Hover Text Color specifically */
        .deznav .metismenu li a:hover {
            color: #000000 !important;
        }

        /* Sub-menu styling if present */
        .deznav .metismenu ul a {
            color: #555555 !important;
            font-size: 14px;
        }

        .deznav .metismenu ul a:hover {
            color: #000000 !important;
            background-color: #FFE8D2 !important;
        }

        @media only screen and (max-width: 767px) {
            .nav-header {
                height: 80px;
                /* Smaller height on mobile */
                width: 80px;
                /* Adjust width to fit hamburger if needed, or keep standard */
            }

            .nav-header img.brand-title {
                display: block !important;
                /* Show logo on mobile */
                height: 40px;
                /* Adjust size for mobile */
                margin-right: 10px;
            }
        }

        /* ============================
           SIDEBAR & HEADER TEXT
        ============================ */
        /* Note: Text colors are handled above with !important */

        .nav-header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            /* Reduced from 120px */
            position: relative;
        }

        .header {
            height: 80px;
            /* Match nav-header */
        }

        .deznav {
            top: 80px;
            /* Match nav-header */
        }

        /* Adjust Content Body to match new header height */
        .content-body {
            /* margin-top: 80px; */
            /* Disabled to fix layout drop issue */
        }

        .nav-header img.brand-title {
            width: auto;
            height: 50px;
            /* Reduced from 70px */
            border-radius: 6px;
            background: transparent;
            /* Remove white background box if it looks odd on white header, or keep it */
            box-shadow: none;
            /* Remove shadow for cleaner look or keep it subtle */
            transition: transform 0.3s ease;
            max-width: 90%;
            object-fit: contain;
        }

        /* Professional Table Styling */
        .table thead th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
            color: #555;
            padding: 15px 10px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 127, 80, 0.05);
        }

        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 6px;
        }
        i.ti-headphone,
        i.ti-shopping-cart {
            display: none !important;
        }
        .ti-headphone::before,
        .ti-shopping-cart::before {
            display: none !important;
            content: none !important;
        }
        i.icon-support,
        i.icon-basket,
        i.icon-basket-loaded,
        i.la-shopping-cart,
        i.fa-shopping-cart,
        i.icon-earphones,
        i.icon-earphones-alt {
            display: none !important;
        }
        .icon-support::before,
        .icon-basket::before,
        .icon-basket-loaded::before,
        .la-shopping-cart::before,
        .fa-shopping-cart::before,
        .icon-earphones::before,
        .icon-earphones-alt::before {
            display: none !important;
            content: none !important;
        }
        .dz-support,
        .dz-buy-now {
            display: none !important;
            visibility: hidden !important;
        }
        a[href*="dexignzone"],
        a[href*="themeforest"] {
            display: none !important;
            visibility: hidden !important;
        }
        .deznav .copyright,
        .deznav .copyright p,
        .deznav .copyright a,
        .deznav .copyright .heart {
            color: #000000 !important;
        }
    </style>
</head>

<body>

    <div id="main-wrapper">

        <!-- Nav header start -->
        <div class="nav-header">
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <img class="brand-title" src="{{ asset('assets/images/logo.svg') }}" alt="Abir FoodCourt Logo">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                    <i class="fas fa-arrow-right arrow-icon" style="display:none; color: #000; font-size: 24px;"></i>
                </div>
            </div>

            <script>
                document.querySelector('.hamburger').addEventListener('click', function() {
                    this.classList.toggle('active-arrow');
                });
            </script>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header">
            @include('layout.erp.partials.header')
        </div>
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="deznav">
            @include('layout.erp.partials.sidebar')
        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            @yield('content')
        </div>
        <!-- Content body end -->

        <!-- Footer start -->
        <div class="footer">
            @include('layout.erp.partials.footer')
        </div>
        <!-- Footer end -->

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart-js/chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>

    {{-- Page-specific scripts --}}
    @yield('scripts')

    {{-- Optional: dashboard page charts --}}
    @if(Request::routeIs('/'))
    {{-- <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script> --}}
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (window.jQuery && jQuery.fn.selectpicker) {
                jQuery('select[data-content]').each(function(){
                    const $el = jQuery(this);
                    if (!$el.hasClass('selectpicker')) {
                        $el.addClass('selectpicker');
                    }
                });
                jQuery('.selectpicker').selectpicker('render');
                jQuery('.selectpicker').selectpicker('refresh');
            }
            try {
                const selectors = [
                    'i.ti-headphone',
                    'i.ti-shopping-cart',
                    'i.icon-support',
                    'i.icon-basket',
                    'i.icon-basket-loaded',
                    'i.la-shopping-cart',
                    'i.fa-shopping-cart',
                    'i.icon-earphones',
                    'i.icon-earphones-alt'
                ];
                document.querySelectorAll(selectors.join(',')).forEach(function (icon) {
                    var anchor = icon.closest('a');
                    if (anchor && anchor.parentElement) {
                        anchor.parentElement.removeChild(anchor);
                        return;
                    }
                    var container = icon.closest('.dz-support, .dz-buy-now, .rounded-circle, .fixed, .fixed-bottom, .fixed-left');
                    if (container && container.parentElement) {
                        container.parentElement.removeChild(container);
                    }
                });
                // Remove anchors by text or href patterns
                document.querySelectorAll('a').forEach(function(a){
                    const text = (a.textContent || '').toLowerCase().trim();
                    const href = (a.getAttribute('href') || '').toLowerCase();
                    const isSupport = text.includes('support') || href.includes('support') || href.includes('dexignzone');
                    const isBuyNow = text.includes('buy now') || href.includes('buy') || href.includes('themeforest');
                    const stylePos = window.getComputedStyle(a).position;
                    if (isSupport || isBuyNow || stylePos === 'fixed') {
                        const iconInside = a.querySelector('i.ti-headphone, i.icon-support, i.ti-shopping-cart, i.icon-basket, i.icon-basket-loaded, i.la-shopping-cart, i.fa-shopping-cart, i.icon-earphones, i.icon-earphones-alt');
                        if (iconInside || stylePos === 'fixed') {
                            if (a.parentElement) a.parentElement.removeChild(a);
                        }
                    }
                });
                // Observe future injections
                const mo = new MutationObserver(function(mutations){
                    mutations.forEach(function(m){
                        (m.addedNodes || []).forEach(function(node){
                            try {
                                if (!(node instanceof Element)) return;
                                const candidates = node.matches ? [node] : [];
                                const icons = node.querySelectorAll ? node.querySelectorAll('i.ti-headphone, i.icon-support, i.ti-shopping-cart, i.icon-basket, i.icon-basket-loaded, i.la-shopping-cart, i.fa-shopping-cart, i.icon-earphones, i.icon-earphones-alt') : [];
                                candidates.concat(Array.from(icons)).forEach(function(el){
                                    const a = el.closest('a');
                                    if (a && a.parentElement) a.parentElement.removeChild(a);
                                    const cont = el.closest('.dz-support, .dz-buy-now, .rounded-circle, .fixed, .fixed-bottom, .fixed-left');
                                    if (cont && cont.parentElement) cont.parentElement.removeChild(cont);
                                });
                            } catch(e){}
                        });
                    });
                });
                mo.observe(document.body, { childList: true, subtree: true });
            } catch (e) {}
        });
    </script>

</body>

</html>
