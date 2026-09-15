<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRA | Barangay San Bartolome</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >
    <style> 
        * {
            scroll-behavior: smooth;
        }

       body {
    background: #eef7fb;
    font-family: "Segoe UI", sans-serif;
    color: #244c63;
    position: relative;
}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('{{ asset('images/background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0.8;
    z-index: -1;
}
        
        .navbar-custom {
            background: #014f78;
            min-height: 95px;
            box-shadow: 0 2px 15px rgba(0,0,0,.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand-logo {
            width: 65px;
            height: 65px;
            border-radius: 12px;
            object-fit: cover;
        }

        .brand-title {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .brand-subtitle {
            color: #fff;
            margin: 0;
            font-size: 15px;
        }

        .login-btn {
            background: #F4A300;
            color: #003b5c;
            border: none;
            padding: 10px 28px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: .3s;
        }

        .login-btn:hover {
            background: #ffc247;
            color: #003b5c;
            transform: translateY(-2px);
        }


        .hero {
    position: relative;
    min-height: calc(100vh - 95px);
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 70px 20px;
}

.hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        180deg,
        rgba(1, 41, 63, .55),
        rgba(1, 41, 63, .70)
    );
    z-index: 0;
}

.hero .container {
    position: relative;
    z-index: 1;
}

        .hero-logo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 15px 35px rgba(0,0,0,.18);
        }

        .hero h1 {
    margin-top: 30px;
    color: #ffffff;
    font-weight: 800;
    font-size: 5rem;
    letter-spacing: 2px;
    text-shadow: 0 3px 12px rgba(0,0,0,.45);
}

.hero h3 {
    color: #d7edf7;
    margin-top: 20px;
    font-weight: 400;
    text-shadow: 0 2px 8px rgba(0,0,0,.4);
}

.hero p {
    max-width: 760px;
    margin: 35px auto;
    color: #e8f4fb;
    font-size: 1.4rem;
    line-height: 1.8;
    text-shadow: 0 2px 6px rgba(0,0,0,.35);
}
        .btn-start {
            background: #F4A300;
            color: #003b5c;
            border: none;
            padding: 16px 40px;
            border-radius: 15px;
            font-size: 22px;
            font-weight: 700;
            text-decoration: none;
            transition: .3s;
        }

        .btn-start:hover {
            background: #ffc247;
            color: #003b5c;
            transform: translateY(-3px);
        }

        .btn-outline-custom {
            padding: 16px 40px;
            border-radius: 15px;
            border: 2px solid #99d8ff;
            color: #014f78;
            font-size: 22px;
            font-weight: 700;
            transition: .3s;
        }

        .btn-outline-custom:hover {
            background: #014f78;
            color: #fff;
            transform: translateY(-3px);
        }

        .section {
            padding: 90px 20px;
        }

        .section-light {
            background: #ffffff;
        }

        .section-blue {
            background: #e5f4fb;
        }

        .section-title {
            text-align: center;
            color: #014f78;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .section-subtitle {
            text-align: center;
            max-width: 750px;
            margin: 0 auto 55px;
            color: #668399;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .about-card {
            background: #fff;
            border-radius: 24px;
            padding: 45px;
            box-shadow: 0 12px 35px rgba(0, 68, 100, .08);
        }

        .about-icon {
            width: 75px;
            height: 75px;
            border-radius: 20px;
            background: #e6f6fd;
            color: #014f78;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin-bottom: 25px;
        }

        .about-card h3 {
            color: #014f78;
            font-weight: 750;
            margin-bottom: 18px;
        }

        .about-card p {
            color: #5d7587;
            line-height: 1.8;
            margin-bottom: 0;
        }

        .feature-card {
            background: #fff;
            border: none;
            border-radius: 20px;
            padding: 35px 28px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 68, 100, .07);
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 40px rgba(0, 68, 100, .12);
        }

        .feature-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            background: #e8f6fc;
            color: #014f78;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 22px;
        }

        .feature-card h5 {
            color: #014f78;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #698293;
            line-height: 1.7;
            margin: 0;
        }

        .step-card {
            text-align: center;
            padding: 25px;
        }

        .step-number {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #014f78;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 25px;
            font-weight: 800;
        }

        .step-card h5 {
            color: #014f78;
            font-weight: 700;
        }

        .step-card p {
            color: #6b8292;
            line-height: 1.6;
        }



        .contact-section {
            background: #014f78;
            color: #fff;
        }

        .contact-section .section-title {
            color: #fff;
        }

        .contact-section .section-subtitle {
            color: #cce7f4;
        }

        .contact-card {
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: .3s;
        }

        .contact-card:hover {
            background: rgba(255,255,255,.15);
            transform: translateY(-4px);
        }

        .contact-icon {
            font-size: 30px;
            margin-bottom: 18px;
            color: #F4A300;
        }

        .contact-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .contact-card p {
            color: #d7edf7;
            margin: 0;
            line-height: 1.7;
        }

        .contact-card a {
            color: #fff;
            text-decoration: none;
        }

        .contact-card a:hover {
            color: #F4A300;
        }

        .facebook-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            color: #014f78 !important;
            padding: 12px 22px;
            border-radius: 12px;
            font-weight: 700;
            margin-top: 18px;
            transition: .3s;
        }

        .facebook-btn:hover {
            background: #F4A300;
            color: #003b5c !important;
            transform: translateY(-2px);
        }


        .footer {
            background: #003b5c;
            color: #bcd8e5;
            text-align: center;
            padding: 25px 15px;
            font-size: 14px;
        }

        .footer strong {
            color: #fff;
        }
        .map-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #13b36d;
            color: white;
            border-radius: 50px;
            padding: 16px 28px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(0,0,0,.2);
            z-index: 900;
            transition: .3s;
        }

        .map-btn:hover {
            color: white;
            background: #10985d;
            transform: translateY(-3px);
        }

        @media(max-width:768px) {

            .navbar-custom {
                min-height: 80px;
            }

            .brand-logo {
                width: 50px;
                height: 50px;
            }

            .brand-title {
                font-size: 17px;
            }

            .brand-subtitle {
                font-size: 12px;
            }

            .login-btn {
                padding: 8px 18px;
            }

            .hero {
                min-height: auto;
                padding: 70px 20px;
            }

            .hero-logo {
                width: 130px;
                height: 130px;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .hero h3 {
                font-size: 1.2rem;
            }

            .hero p {
                font-size: 1rem;
                padding: 0 10px;
            }

            .btn-start,
            .btn-outline-custom {
                width: 100%;
                margin-bottom: 10px;
                font-size: 18px;
            }

            .section {
                padding: 65px 20px;
            }

            .section-title {
                font-size: 2rem;
            }

            .about-card {
                padding: 30px;
            }

            .map-btn {
                bottom: 18px;
                right: 18px;
                padding: 12px 18px;
                font-size: 13px;
            }
        }

    </style>

</head>


<body>

<nav class="navbar navbar-custom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img  src="{{ asset('images/logo.png') }}"  class="brand-logo" alt="Barangay San Bartolome Logo">
            <div class="ms-3">
                <h4 class="brand-title">
                    REGISTRA
                </h4>
                <p class="brand-subtitle">
                    Barangay San Bartolome
                </p>
            </div>
        </a>

        <a
            href="{{ route('login') }}"
            class="login-btn"
        >
            Login
        </a>

    </div>

</nav>
<section class="hero">

    <div class="container">

        <img
            src="{{ asset('images/logo.png') }}"
            class="hero-logo"
            alt="REGISTRA Logo"
        >

        <h1>
            REGISTRA
        </h1>

        <h3>
            Barangay San Bartolome, Sta. Magdalena, Sorsogon
        </h3>

        <p>
            A comprehensive digital solution for efficient business
            registration, fee assessment, payment processing, document
            management, and business records administration.
        </p>


        <div class="d-flex justify-content-center gap-3 flex-wrap">

            <a
                href="{{ route('login') }}"
                class="btn btn-start"
            >
                Get Started <i class="bi bi-arrow-right"></i>
            </a>


            <a
                href="#about"
                class="btn btn-outline-custom"
            >
                Learn More
            </a>

        </div>

    </div>

</section>

<section
    id="about"
    class="section section-light"
>

    <div class="container">

        <h2 class="section-title">
            About REGISTRA
        </h2>

        <p class="section-subtitle">
            REGISTRA is a digital Barangay Management System designed
            to make business-related services more organized,
            accessible, and efficient for Barangay San Bartolome.
        </p>


        <div class="row g-4">

            <div class="col-lg-6">

                <div class="about-card h-100">

                    <div class="about-icon">
                        <i class="bi bi-buildings"></i>
                    </div>

                    <h3>
                        What is REGISTRA?
                    </h3>

                    <p>
                        REGISTRA provides a centralized system for
                        managing business records and transactions
                        within the barangay. It helps authorized
                        personnel manage business registration,
                        business profiles, payments, documents,
                        reports, and business closure records.
                    </p>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="about-card h-100">

                    <div class="about-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <h3>
                        Why Use REGISTRA?
                    </h3>

                    <p>
                        The system reduces manual paperwork, improves
                        record organization, provides easier access
                        to business information, and helps maintain
                        a clear history of important transactions
                        performed by authorized users.
                    </p>

                </div>

            </div>

        </div>

    </div>
</section>

<section class="section section-blue">
    <div class="container">
        <h2 class="section-title">
            System Features
        </h2>
        <p class="section-subtitle">
            REGISTRA brings important barangay business management
            functions together in one centralized platform.
        </p>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-building-add"></i>
                    </div>
                    <h5>
                        Business Registration
                    </h5>
                    <p>
                        Register new businesses and maintain important
                        business information such as owner details,
                        address, category, permit information, and
                        location.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>
                    <h5>
                        Business Profiling
                    </h5>
                    <p>
                        View and manage organized business profiles,
                        making it easier for authorized personnel to
                        access and maintain business records.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-calculator"></i>
                    </div>

                    <h5>
                        Fee Assessment
                    </h5>

                    <p>
                        Manage assessed fees associated with business
                        transactions and maintain accurate financial
                        records.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>

                    <h5>
                        Payment Processing
                    </h5>

                    <p>
                        Record business payments, generate reference
                        numbers, monitor payment status, and keep
                        collection records organized.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h5>
                        Document Management
                    </h5>

                    <p>
                        Manage the issuance of barangay business-related
                        documents and generate official documents
                        when required.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>

                    <h5>
                        Financial Reports
                    </h5>

                    <p>
                        Generate daily, monthly, annual, and summary
                        collection reports for easier monitoring and
                        financial record management.
                    </p>

                </div>

            </div>
            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-building-x"></i>
                    </div>

                    <h5>
                        Business Closure
                    </h5>

                    <p>
                        Record businesses that have ceased operations
                        and maintain their information in the business
                        history or archive.
                    </p>

                </div>

            </div>
            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <h5>
                        Business Hotspot Map
                    </h5>
                    <p>
                        View the geographic distribution of businesses
                        through an interactive map for easier location
                        monitoring and planning.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <h5>
                        History Logs
                    </h5>

                    <p>
                        Keep a record of important system activities
                        and transactions performed by authorized
                        users for better accountability.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="section section-light">

    <div class="container">

        <h2 class="section-title">
            How REGISTRA Works
        </h2>

        <p class="section-subtitle">
            The system organizes the business management process
            into a simple and centralized workflow.
        </p>


        <div class="row g-4">
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">
                        1
                    </div>

                    <h5>
                        Register
                    </h5>

                    <p>
                        Business information is recorded and
                        organized within the system.
                    </p>

                </div>

            </div>


            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">
                        2
                    </div>
                    <h5>
                        Process
                    </h5>
                    <p>
                        Authorized personnel manage assessments,
                        payments, documents, and other transactions.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="step-card">

                    <div class="step-number">
                        3
                    </div>

                    <h5>
                        Monitor
                    </h5>

                    <p>
                        Reports, business records, maps, and history
                        logs provide information for monitoring and
                        decision-making.
                    </p>

                </div>

            </div>

        </div>

    </div>
</section>


<section
    id="contact"
    class="section contact-section"
>

    <div class="container">

        <h2 class="section-title">
            Contact Barangay San Bartolome
        </h2>

        <p class="section-subtitle">
            For inquiries, assistance, business-related concerns,
            or information about barangay services, you may contact
            the Barangay San Bartolome office through the following
            channels.
        </p>


        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5>
                        Barangay Office
                    </h5>
                    <p>
                        Purok Laboy, San Bartolome<br>
                        Sta. Magdalena, Sorsogon<br>
                        Philippines
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">

                <div class="contact-card">

                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>

                    <h5>
                        Contact Number
                    </h5>

                    <p>
                        <a href="tel:+639XXXXXXXXX">
                            +63 977 630 0340
                        </a>
                    </p>

                </div>

            </div>



            <div class="col-md-6 col-lg-3">

                <div class="contact-card">

                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>

                    <h5>
                        Email
                    </h5>

                    <p>
                        <a href="mailto:barangaysanbartolometalaongan@gmail.com">
                           barangaysanbartolometalaongan
                           @gmail.com
                        </a>
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="contact-card">

                    <div class="contact-icon">
                        <i class="bi bi-facebook"></i>
                    </div>

                    <h5>
                        Facebook
                    </h5>

                    <p>
                        Follow the official Facebook page of
                        Barangay San Bartolome for announcements
                        and updates.
                    </p>

                    <a
                        href="#"
                        target="_blank"
                        class="facebook-btn"
                    >
                        <i class="bi bi-facebook"></i>
                        Official Facebook Page
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     FOOTER
====================================================== --}}

<footer class="footer">

    <div class="container">

        <p class="mb-1">
            <strong>REGISTRA</strong>
            — Barangay Management System
        </p>

        <p class="mb-0">
            Barangay San Bartolome, Sta. Magdalena, Sorsogon
        </p>

        <small>
            © {{ date('Y') }} Barangay San Bartolome. All Rights Reserved.
        </small>

    </div>

</footer>



{{-- =====================================================
     BUSINESS HOTSPOT MAP
====================================================== --}}

<a
    href="{{ route('map.index') }}"
    class="map-btn"
>
    <i class="bi bi-geo-alt-fill"></i>
    Business Hotspot Map
</a>


</body>

</html>