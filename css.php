<style>
        :root {
            --primary-color: #00d2ff;
            --primary-hover: #3a86ff;
            --bg-black: #0a0e17;
            --bg-card: #121824;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --border-color: #1e293b;
        }

        body {
            font-family: 'Muli', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--bg-black);
            color: var(--text-main);
        }

        @media (min-width: 992px) {
            body {
                padding-left: 17rem;
            }
        }

        #sideNav {
            background-color: var(--bg-black) !important;
            border-right: 1px solid var(--border-color);
        }

        #sideNav .navbar-brand .img-profile {
            max-width: 10rem;
            max-height: 10rem;
            border: 0.5rem solid rgba(0, 210, 255, 0.2);
            border-radius: 50%;
        }

        #sideNav .navbar-nav .nav-item .nav-link {
            font-weight: 800;
            letter-spacing: 0.05rem;
            text-transform: uppercase;
            color: var(--text-muted) !important;
            transition: color 0.2s ease-in-out;
        }

        #sideNav .navbar-nav .nav-item .nav-link:hover,
        #sideNav .navbar-nav .nav-item .nav-link.active {
            color: var(--primary-color) !important;
        }

        @media (min-width: 992px) {
            #sideNav {
                text-align: center;
                position: fixed;
                top: 0;
                left: 0;
                display: flex;
                flex-direction: column;
                width: 17rem;
                height: 100vh;
            }
            #sideNav .navbar-collapse {
                display: flex !important;
                align-items: flex-start;
                flex-grow: 0;
                width: 100%;
            }
            #sideNav .navbar-collapse .navbar-nav {
                flex-direction: column;
                width: 100%;
            }
            #sideNav .navbar-collapse .navbar-nav .nav-item {
                display: block;
            }
            #sideNav .navbar-collapse .navbar-nav .nav-item .nav-link {
                display: block;
                padding: 0.5rem 1rem;
            }
        }

        .resume-section {
            display: flex;
            align-items: center;
            padding: 5rem 1rem;
            max-width: 75rem;
            border-bottom: 1px solid var(--border-color);
        }

        /* Make Login section look like a prominent opening screen */
        #login {
            min-height: 100vh;
            background-color: var(--bg-black);
        }

        @media (min-width: 768px) {
            .resume-section {
                padding: 6rem 4rem;
            }
        }

        .resume-section-content {
            width: 100%;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Saira Extra Condensed', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            color: #ffffff;
        }

        h1 { font-size: 3.5rem; line-height: 3.5rem; }
        h2 { font-size: 2.5rem; }

        .subheading {
            font-family: 'Saira Extra Condensed', sans-serif;
            font-weight: 500;
            font-size: 1.35rem;
        }

        .text-primary { color: var(--primary-color) !important; }
        p, li { color: var(--text-muted); }

        .social-icons .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 3.5rem;
            width: 3.5rem;
            background-color: var(--bg-card);
            color: var(--text-main);
            border-radius: 100%;
            font-size: 1.5rem;
            margin-right: 1rem;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }

        .social-icons .social-icon:hover {
            background-color: var(--primary-color);
            color: var(--bg-black);
            border-color: var(--primary-color);
        }

        .dev-icons {
            font-size: 3rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            list-style: none;
            padding: 0;
        }

        .dev-icons .list-inline-item {
            color: var(--text-muted);
        }

        .dev-icons .list-inline-item:hover {
            color: var(--primary-color);
        }

        .card {
            background-color: var(--bg-card) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-main);
        }

        .form-label {
            color: var(--text-main);
            font-weight: 600;
        }

        .form-control {
            background-color: #080c14 !important;
            border: 1px solid var(--border-color) !important;
            color: #ffffff !important;
        }

        .form-control:focus {
            background-color: #080c14 !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 210, 255, 0.25) !important;
            color: #ffffff !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--bg-black);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #ffffff;
        }

        hr {
            border-color: var(--border-color);
            opacity: 1;
        }

        /* ===== Portal additions ===== */

        /* Login screen has no sidebar, so remove the sidebar spacing */
        body.login-page { padding-left: 0; }

        /* Login / Register tabs */
        .nav-pills .nav-link { color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05rem; }
        .nav-pills .nav-link.active { background-color: var(--primary-color); color: var(--bg-black); }
        .nav-pills .nav-link:hover:not(.active) { color: var(--primary-color); }

        .form-control::placeholder { color: var(--text-muted); }

        /* Welcome bar at the top of the dashboard */
        .welcome-bar {
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 1rem 1.5rem;
        }

        /* Initial avatar used when assets/img/profile.jpg does not exist */
        .avatar-initial {
            width: 10rem;
            height: 10rem;
            border-radius: 50%;
            border: 0.5rem solid rgba(0, 210, 255, 0.2);
            background-color: var(--bg-card);
            color: var(--primary-color);
            font-size: 4rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>