<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp - Faites de nouvelles connaissances via WhatsApp</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* === VARIABLES & THÈME === */
        :root {
            --bs-primary: #3b82f6;
            --bs-primary-rgb: 59, 130, 246;
            --color-whatsapp: #25d366;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-light);
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* === LOADER === */
        .page-loader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ffffff;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s ease, visibility 0.4s;
        }
        .page-loader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        /* === COULEURS WHATSAPP === */
        .text-whatsapp { color: var(--color-whatsapp) !important; }
        .bg-whatsapp { background-color: var(--color-whatsapp) !important; }
        .btn-whatsapp {
            background-color: var(--color-whatsapp);
            color: #ffffff;
            border: none;
            transition: background 0.2s ease;
        }
        .btn-whatsapp:hover {
            background-color: #20ba5a;
            color: #ffffff;
        }

        /* === UTILITIES SOFT COLORS === */
        .bg-primary-soft { background-color: rgba(59, 130, 246, 0.1) !important; }
        .bg-success-soft { background-color: rgba(37, 211, 102, 0.1) !important; }
        .bg-whatsapp-soft { background-color: rgba(37, 211, 102, 0.15) !important; }

        /* === HERO SHAPE === */
        .hero-shape-blob {
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(59,130,246,0.18) 0%, rgba(37,211,102,0.08) 100%);
            top: -30px;
            left: -30px;
            filter: blur(40px);
            border-radius: 50%;
            z-index: 0;
        }
        .hero-img {
            object-fit: cover;
            height: 380px;
            width: 100%;
            max-width: 480px;
        }

        /* === CARTES DE PROFIL === */
        .profile-card {
            border: none;
            background: #ffffff;
            border-radius: 1.25rem !important;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            overflow: hidden;
        }
        .profile-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.06) !important;
        }

        .avatar-placeholder {
            width: 75px;
            height: 75px;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #475569;
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .hobby-badge {
            font-size: 0.72rem;
            padding: 0.35em 0.85em;
            font-weight: 500;
            border-radius: 50px;
        }

        .btn-hover-scale {
            transition: transform 0.2s ease;
        }
        .btn-hover-scale:hover {
            transform: scale(1.03);
        }

        /* === RETOUR EN HAUT === */
        .btn-back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            display: none;
            z-index: 99;
            width: 45px;
            height: 45px;
            align-items: center;
            justify-content: center;
        }

        .hover-white:hover {
            color: #ffffff !important;
        }

        .selectable-hobby {
            cursor: pointer;
            user-select: none;
            transition: all 0.2s ease;
        }
        .selectable-hobby.active {
            background-color: var(--bs-primary) !important;
            color: #fff !important;
            border-color: var(--bs-primary) !important;
        }

        @media (max-width: 768px) {
            .hero-img { height: 260px; }
        }
    </style>
</head>
<body>

    <!-- Loader de page -->
    <div id="page-loader" class="page-loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
    </div>

    <!-- Toast Dynamique -->
    <div class="toast-container position-fixed bottom-0 start-0 p-3" style="z-index: 1055;">
        <div id="live-toast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast-message"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Barre de Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#" onclick="switchView('home')">
                <i class="bi bi-whatsapp text-whatsapp me-2 fs-3"></i>
                <span class="fw-bold text-dark fs-4">Link<span class="text-primary">Up</span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2 mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link active fw-medium" href="#" data-view="home" onclick="switchView('home')">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#" data-view="browse" onclick="switchView('browse')">Découvrir</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#about">À propos</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium me-lg-2" href="#contact">Contact</a></li>
                    <li class="nav-item w-100 w-lg-auto" id="nav-guest-actions">
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2 w-100 w-lg-auto my-1" onclick="switchView('login')">Connexion</button>
                        <button class="btn btn-primary btn-sm rounded-pill px-3 w-100 w-lg-auto my-1" onclick="switchView('register')">Inscription</button>
                    </li>
                    <li class="nav-item d-none" id="nav-user-actions">
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5 text-primary"></i> <span id="nav-username">Mon Profil</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                                <li><a class="dropdown-item" href="#" onclick="switchView('browse')"><i class="bi bi-grid me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="logout()"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- VUE ACCUEIL -->
    <main id="view-home" class="view-section">
        <!-- Hero Section -->
        <section class="bg-gradient-light py-5 d-flex align-items-center">
            <div class="container py-4">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 text-center text-lg-start">
                        <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2 mb-3 fw-semibold text-uppercase">Communauté WhatsApp</span>
                        <h1 class="display-4 fw-bold text-dark lh-sm mb-3">Faites de nouvelles connaissances grâce à <span class="text-whatsapp">WhatsApp</span>.</h1>
                        <p class="lead text-muted mb-4 fs-5">Découvrez des personnes partageant vos centres d'intérêt et commencez une conversation en un seul clic.</p>
                        <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                            <button class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm btn-hover-scale" onclick="switchView('register')">Rejoindre maintenant</button>
                            <button class="btn btn-outline-secondary btn-lg rounded-pill px-4 btn-hover-scale" onclick="switchView('browse')">Découvrir les profils</button>
                        </div>
                        <div class="row g-3 mt-4 pt-4 border-top border-light text-start justify-content-center justify-content-lg-start">
                            <div class="col-auto me-4">
                                <h4 class="fw-bold text-dark mb-0" id="stat-total">1,240</h4>
                                <small class="text-muted">Membres actifs</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="fw-bold text-whatsapp mb-0" id="stat-today">+34</h4>
                                <small class="text-muted">Inscrits aujourd'hui</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="position-relative d-inline-block">
                            <div class="hero-shape-blob"></div>
                            <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=600" alt="Networking" class="img-fluid rounded-4 shadow-lg position-relative z-1 hero-img">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Les 8 Derniers Membres -->
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="text-center max-w-xl mx-auto mb-5">
                    <h2 class="fw-bold text-dark">Derniers membres inscrits</h2>
                    <p class="text-muted">Rejoignez-les et commencez à échanger dès maintenant.</p>
                </div>
                <div class="row g-4" id="recent-members-grid"></div>
            </div>
        </section>

        <!-- Comment ça fonctionne ? -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">Comment ça fonctionne ?</h2>
                    <p class="text-muted">Une mise en relation simplifiée au maximum en 3 étapes.</p>
                </div>
                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-4 h-100 shadow-sm">
                            <div class="bg-primary-soft text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                <i class="bi bi-person-plus fs-3"></i>
                            </div>
                            <h5 class="fw-bold">1. Je m'inscris</h5>
                            <p class="text-muted mb-0 small">Un formulaire minimaliste, rapide et sécurisé pour définir vos affinités.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-4 h-100 shadow-sm">
                            <div class="bg-success-soft text-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                <i class="bi bi-search fs-3"></i>
                            </div>
                            <h5 class="fw-bold">2. Je découvre les profils</h5>
                            <p class="text-muted mb-0 small">Filtrez la communauté par pays, ville, centres d'intérêt et tranche d'âge.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-4 h-100 shadow-sm">
                            <div class="bg-whatsapp-soft text-whatsapp rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                <i class="bi bi-chat-whatsapp fs-3"></i>
                            </div>
                            <h5 class="fw-bold">3. Je discute sur WhatsApp</h5>
                            <p class="text-muted mb-0 small">Le bouton initie instantanément une discussion privée sécurisée.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pourquoi utiliser cette plateforme ? -->
        <section id="about" class="py-5 bg-white">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">Pourquoi utiliser LinkUp ?</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4"><div class="p-4 border rounded-4 h-100 d-flex gap-3"><i class="bi bi-currency-dollar text-primary fs-3"></i><div><h6 class="fw-bold">Gratuit</h6><p class="text-muted small mb-0">Aucun frais caché, l'accès complet aux fiches est libre.</p></div></div></div>
                    <div class="col-md-4"><div class="p-4 border rounded-4 h-100 d-flex gap-3"><i class="bi bi-lightning-charge text-warning fs-3"></i><div><h6 class="fw-bold">Rapide</h6><p class="text-muted small mb-0">Pas d'attente de "match" mutuel interminable. Écrivez quand vous le désirez.</p></div></div></div>
                    <div class="col-md-4"><div class="p-4 border rounded-4 h-100 d-flex gap-3"><i class="bi bi-heart text-danger fs-3"></i><div><h6 class="fw-bold">Rencontres selon les loisirs</h6><p class="text-muted small mb-0">Trouvez exactement des personnes partageant vos propres sujets d'intérêts.</p></div></div></div>
                    <div class="col-md-4"><div class="p-4 border rounded-4 h-100 d-flex gap-3"><i class="bi bi-whatsapp text-whatsapp fs-3"></i><div><h6 class="fw-bold">Discussion directe sur WhatsApp</h6><p class="text-muted small mb-0">Bénéficiez du confort de l'application que vous utilisez déjà.</p></div></div></div>
                    <div class="col-md-4"><div class="p-4 border rounded-4 h-100 d-flex gap-3"><i class="bi bi-shield-check text-success fs-3"></i><div><h6 class="fw-bold">Interface sécurisée</h6><p class="text-muted small mb-0">Option de signalement communautaire instantané pour écarter tout profil suspect.</p></div></div></div>
                    <div class="col-md-4"><div class="p-4 border rounded-4 h-100 d-flex gap-3"><i class="bi bi-people text-info fs-3"></i><div><h6 class="fw-bold">Communauté grandissante</h6><p class="text-muted small mb-0">Des dizaines de profils rejoignent la plateforme quotidiennement.</p></div></div></div>
                </div>
            </div>
        </section>
    </main>

    <!-- VUE INSCRIPTION -->
    <main id="view-register" class="view-section d-none py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Créer un compte</h2>
                            <p class="text-muted">Rejoignez la communauté en quelques instants.</p>
                        </div>
                        <form id="form-register" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Nom *</label>
                                    <input type="text" class="form-control" name="lastName" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Prénom *</label>
                                    <input type="text" class="form-control" name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Pseudo *</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Adresse e-mail *</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Numéro WhatsApp (ex: 229XXXXXXXX) *</label>
                                    <input type="tel" class="form-control" name="whatsapp" placeholder="229XXXXXXXX" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Sexe *</label>
                                    <select class="form-select" name="gender" required>
                                        <option value="" disabled selected>Choisir...</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Date de naissance</label>
                                    <input type="date" class="form-control" name="birthdate">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Pays *</label>
                                    <input type="text" class="form-control" name="country" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Ville *</label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-muted">Mot de passe *</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-muted">Loisirs *</label>
                                    <div class="d-flex flex-wrap gap-2 p-2 border rounded-3 bg-light" id="register-hobbies-container"></div>
                                    <input type="hidden" name="hobbies" id="hidden-hobbies-input" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-muted">Courte description personnelle</label>
                                    <textarea class="form-control" name="bio" rows="3"></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-medium">Finaliser mon inscription</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- VUE CONNEXION -->
    <main id="view-login" class="view-section d-none py-5 bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Connexion</h3>
                            <p class="text-muted small">Accédez à l'annuaire complet des profils</p>
                        </div>
                        <form id="form-login">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Email ou Numéro WhatsApp</label>
                                <input type="text" class="form-control" id="login-identifier" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-semibold text-muted">Mot de passe</label>
                                <input type="password" class="form-control" id="login-password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-medium">Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- VUE DECOUVRIR (DASHBOARD) -->
    <main id="view-browse" class="view-section d-none py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <!-- Filtres -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-white sticky-lg-top" style="top: 90px; z-index: 100;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-sliders me-2 text-primary"></i>Filtres</h6>
                            <button class="btn btn-link btn-sm text-decoration-none p-0" onclick="resetFilters()">Effacer</button>
                        </div>
                        <div class="row g-2">
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="filter-search" placeholder="Pseudo...">
                            </div>
                            <div class="col-12">
                                <label class="small text-muted fw-semibold mb-1">Genre</label>
                                <select class="form-select form-select-sm" id="filter-gender">
                                    <option value="">Tous</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="filter-country" placeholder="Pays...">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="filter-city" placeholder="Ville...">
                            </div>
                            <div class="col-12">
                                <label class="small text-muted fw-semibold mb-1">Tranche d'âge</label>
                                <select class="form-select form-select-sm" id="filter-age">
                                    <option value="">Tous âges</option>
                                    <option value="18-25">18 - 25 ans</option>
                                    <option value="26-35">26 - 35 ans</option>
                                    <option value="36+">36 ans et +</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="small text-muted fw-semibold mb-1">Loisir</label>
                                <select class="form-select form-select-sm" id="filter-hobby"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste -->
                <div class="col-lg-9">
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-0">Membres de la communauté</h3>
                        <p class="text-muted small mb-0" id="members-count-label"></p>
                    </div>
                    
                    <div class="row g-3" id="browse-members-grid"></div>

                    <nav class="mt-5">
                        <ul class="pagination justify-content-center" id="browse-pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <!-- MODALE CONFIRMATION WHATSAPP -->
    <div class="modal fade" id="whatsappConfirmModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-body text-center p-4">
                    <div class="bg-whatsapp-soft text-whatsapp mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-whatsapp fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Ouvrir WhatsApp ?</h6>
                    <p class="text-muted small mb-4">Vous allez être redirigé vers WhatsApp pour entamer votre discussion.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light rounded-pill btn-sm px-3" data-bs-dismiss="modal">Annuler</button>
                        <a href="#" id="modal-whatsapp-trigger" target="_blank" class="btn btn-whatsapp rounded-pill btn-sm px-3 text-white">Continuer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALE VOIR PROFIL -->
    <div class="modal fade" id="viewProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0 text-center" id="profile-modal-body"></div>
            </div>
        </div>
    </div>

    <!-- MODALE SIGNALEMENT -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold mb-0">Signaler un profil</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-report">
                    <div class="modal-body">
                        <input type="hidden" id="report-target-id">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Motif</label>
                            <select class="form-select form-select-sm" id="report-reason" required>
                                <option value="" disabled selected>Choisir un motif...</option>
                                <option value="Spam">Spam</option>
                                <option value="Faux profil">Faux profil</option>
                                <option value="Arnaque">Arnaque</option>
                                <option value="Comportement inapproprié">Comportement inapproprié</option>
                                <option value="Photo inappropriée">Photo inappropriée</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small fw-semibold text-muted">Description</label>
                            <textarea class="form-control form-control-sm" id="report-description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill btn-sm" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger rounded-pill btn-sm">Signaler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- PIED DE PAGE -->
    <footer id="contact" class="bg-dark text-white pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold text-white mb-3">Link<span class="text-primary">Up</span></h5>
                    <p class="text-muted small">Créateur de liens directs et instantanés.</p>
                </div>
                <div class="col-md-4 col-lg-3">
                    <h6 class="fw-bold mb-3 small text-uppercase text-secondary">Ressources</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="#" class="text-muted text-decoration-none hover-white">Mentions légales</a></li>
                        <li><a href="#" class="text-muted text-decoration-none hover-white">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-muted text-decoration-none hover-white">Conditions d’utilisation</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-3 small text-uppercase text-secondary">Contact</h6>
                    <p class="text-muted small mb-0">support@linkup.com</p>
                </div>
                <div class="col-md-4 col-lg-3 text-lg-end">
                    <h6 class="fw-bold mb-3 small text-uppercase text-secondary">Réseaux</h6>
                    <div class="d-flex gap-2 justify-content-lg-end">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle text-white"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary opacity-25">
            <div class="text-center text-muted small">
                <p class="mb-0">&copy; 2026 LinkUp. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Retour en haut -->
    <button type="button" class="btn btn-primary rounded-circle shadow btn-back-to-top" id="btn-back-to-top" onclick="scrollToTop()">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- LOGIQUE JAVASCRIPT -->
    <script>
        const HOBBIES_LIST = ["Football", "Lecture", "Cuisine", "Voyages", "Jeux vidéo", "Cinéma", "Musique", "Photographie", "Randonnée"];
        const BADGE_COLORS = ["bg-primary", "bg-success", "bg-secondary", "bg-dark", "bg-info", "bg-warning text-dark", "bg-danger"];

        let state = {
            currentUser: null,
            members: [
                { id: 1, firstName: "Jean", lastName: "Val", username: "Jean229", age: 24, gender: "M", country: "Bénin", city: "Cotonou", hobbies: ["Football", "Musique"], whatsapp: "22990000001", bio: "Passionné de football et de musique.", registrationDate: "2026-07-11" },
                { id: 2, firstName: "Amina", lastName: "Sidi", username: "Amina_A", age: 22, gender: "F", country: "Bénin", city: "Parakou", hobbies: ["Lecture", "Voyages"], whatsapp: "22961000002", bio: "Amoureuse de la nature et des voyages.", registrationDate: "2026-07-11" },
                { id: 3, firstName: "Marc", lastName: "Dupond", username: "Marc_Paris", age: 31, gender: "M", country: "France", city: "Paris", hobbies: ["Cuisine", "Cinéma"], whatsapp: "33612345678", bio: "Cuisinier amateur.", registrationDate: "2026-07-10" },
                { id: 4, firstName: "Sophie", lastName: "Koffi", username: "Soso_Dev", age: 27, gender: "F", country: "Côte d'Ivoire", city: "Abidjan", hobbies: ["Jeux vidéo", "Musique"], whatsapp: "22505010203", bio: "Gamer et développeuse.", registrationDate: "2026-07-10" },
                { id: 5, firstName: "Chérif", lastName: "Diallo", username: "Checo", age: 19, gender: "M", country: "Guinée", city: "Conakry", hobbies: ["Football", "Randonnée"], whatsapp: "22462011223", bio: "Grand sportif.", registrationDate: "2026-07-09" },
                { id: 6, firstName: "Fati", lastName: "Boro", username: "Fati_B", age: 26, gender: "F", country: "Bénin", city: "Porto-Novo", hobbies: ["Cuisine", "Lecture"], whatsapp: "22997000006", bio: "À la recherche de profils inspirants.", registrationDate: "2026-07-08" },
                { id: 7, firstName: "Lucas", lastName: "Muller", username: "Lulu_World", age: 35, gender: "M", country: "Canada", city: "Montréal", hobbies: ["Voyages", "Photographie"], whatsapp: "15149998888", bio: "Partageons nos itinéraires !", registrationDate: "2026-07-05" },
                { id: 8, firstName: "Inès", lastName: "Gomez", username: "Ines_G", age: 23, gender: "F", country: "France", city: "Lyon", hobbies: ["Cinéma", "Musique"], whatsapp: "33699887766", bio: "Cinéphile avertie.", registrationDate: "2026-07-01" },
                { id: 9, firstName: "Rodrigue", lastName: "Sessou", username: "Rod_229", age: 29, gender: "M", country: "Bénin", city: "Ouidah", hobbies: ["Voyages"], whatsapp: "22995443322", bio: "Découvrir le monde.", registrationDate: "2026-06-25" }
            ],
            selectedHobbiesRegister: [],
            reports: [],
            pagination: { currentPage: 1, perPage: 6 }
        };

        function getHobbyBadgeColor(hobbyName) {
            let index = Math.abs(hobbyName.split('').reduce((acc, char) => acc + char.charCodeAt(0), 0));
            return BADGE_COLORS[index % BADGE_COLORS.length];
        }

        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                document.getElementById("page-loader").classList.add("fade-out");
            }, 500);

            renderStats();
            renderRecentMembers();
            initRegistrationHobbies();
            initFiltersDropdowns();
            setupEventHandlers();

            window.addEventListener("scroll", handleScrollBehavior);
            setInterval(simulateIncomingUserRegistration, 40000);
        });

        function setupEventHandlers() {
            document.getElementById("form-register").addEventListener("submit", handleRegister);
            document.getElementById("form-login").addEventListener("submit", handleLogin);
            document.getElementById("form-report").addEventListener("submit", handleReportSubmission);

            ['filter-search', 'filter-country', 'filter-city'].forEach(id => {
                document.getElementById(id).addEventListener("input", () => {
                    state.pagination.currentPage = 1;
                    renderBrowseMembers();
                });
            });
            ['filter-gender', 'filter-age', 'filter-hobby'].forEach(id => {
                document.getElementById(id).addEventListener("change", () => {
                    state.pagination.currentPage = 1;
                    renderBrowseMembers();
                });
            });
        }

        function switchView(viewName) {
            document.querySelectorAll(".view-section").forEach(view => view.classList.add("d-none"));
            document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));

            const targetedView = document.getElementById(`view-${viewName}`);
            if (targetedView) targetedView.classList.remove("d-none");

            const activeNavLink = document.querySelector(`.nav-link[data-view="${viewName}"]`);
            if (activeNavLink) activeNavLink.classList.add("active");

            if (viewName === 'browse') renderBrowseMembers();
            window.scrollTo({ top: 0, behavior: "smooth" });
        }

        function renderStats() {
            document.getElementById("stat-total").innerText = state.members.length + 1420; 
            document.getElementById("stat-today").innerText = `+${state.members.filter(m => m.registrationDate === "2026-07-11").length + 32}`;
        }

        function createMemberCardHTML(member, isDashboard = false) {
            const initials = `${member.firstName.charAt(0)}${member.lastName.charAt(0)}`.toUpperCase();
            const hobbiesBadges = member.hobbies.map(h => `<span class="badge hobby-badge ${getHobbyBadgeColor(h)}">${h}</span>`).join(" ");
            const geoAndAge = [member.age ? `${member.age} ans` : "", `${member.city}, ${member.country}`].filter(Boolean).join(" • ");

            let actionButtons = "";
            if (!isDashboard) {
                actionButtons = `<button class="btn btn-whatsapp w-100 rounded-pill btn-sm py-2 fw-medium mt-3" onclick="triggerWhatsAppContact('${member.whatsapp}')"><i class="bi bi-whatsapp me-2"></i>Discuter sur WhatsApp</button>`;
            } else {
                actionButtons = `
                    <div class="row g-2 mt-2">
                        <div class="col-12"><button class="btn btn-whatsapp w-100 rounded-pill btn-sm py-2 fw-medium" onclick="triggerWhatsAppContact('${member.whatsapp}')"><i class="bi bi-whatsapp me-2"></i>WhatsApp</button></div>
                        <div class="col-6"><button class="btn btn-light w-100 rounded-pill btn-sm py-1 text-muted small" onclick="openProfileModal(${member.id})"><i class="bi bi-eye"></i> Voir</button></div>
                        <div class="col-6"><button class="btn btn-link text-danger w-100 text-decoration-none small p-0 my-1" onclick="openReportModal(${member.id})"><i class="bi bi-flag"></i> Signaler</button></div>
                    </div>`;
            }

            return `
                <div class="col-12 col-md-6 col-lg-${isDashboard ? '4' : '3'}">
                    <div class="card profile-card h-100 p-3 text-center shadow-sm">
                        <div class="d-flex justify-content-center mb-3"><div class="avatar-placeholder">${initials}</div></div>
                        <h5 class="fw-bold text-dark mb-1">${member.username}</h5>
                        <p class="text-muted small mb-3">${geoAndAge}</p>
                        <div class="d-flex flex-wrap gap-1 justify-content-center mb-3">${hobbiesBadges}</div>
                        ${member.bio ? `<p class="text-muted small text-truncate px-2 mb-2">${member.bio}</p>` : ''}
                        <div class="mt-auto">${actionButtons}</div>
                    </div>
                </div>`;
        }

        function renderRecentMembers() {
            const grid = document.getElementById("recent-members-grid");
            const recents = [...state.members].sort((a,b) => b.id - a.id).slice(0, 8);
            grid.innerHTML = recents.map(m => createMemberCardHTML(m, false)).join("");
        }

        function renderBrowseMembers() {
            const grid = document.getElementById("browse-members-grid");
            const filtered = filterMembersEngine();
            
            document.getElementById("members-count-label").innerText = `${filtered.length} membre(s) trouvé(s)`;
            
            const totalPages = Math.ceil(filtered.length / state.pagination.perPage) || 1;
            if(state.pagination.currentPage > totalPages) state.pagination.currentPage = totalPages;
            
            const startIndex = (state.pagination.currentPage - 1) * state.pagination.perPage;
            const paginatedItems = filtered.slice(startIndex, startIndex + state.pagination.perPage);

            if (paginatedItems.length === 0) {
                grid.innerHTML = `<div class="col-12 text-center py-5 text-muted"><p>Aucun utilisateur trouvé.</p></div>`;
                document.getElementById("browse-pagination").innerHTML = "";
                return;
            }

            grid.innerHTML = paginatedItems.map(m => createMemberCardHTML(m, true)).join("");
            renderPaginationControls(totalPages);
        }

        function filterMembersEngine() {
            const search = document.getElementById("filter-search").value.toLowerCase().trim();
            const gender = document.getElementById("filter-gender").value;
            const country = document.getElementById("filter-country").value.toLowerCase().trim();
            const city = document.getElementById("filter-city").value.toLowerCase().trim();
            const ageGroup = document.getElementById("filter-age").value;
            const hobby = document.getElementById("filter-hobby").value;

            return state.members.filter(m => {
                if (search && !m.username.toLowerCase().includes(search)) return false;
                if (gender && m.gender !== gender) return false;
                if (country && !m.country.toLowerCase().includes(country)) return false;
                if (city && !m.city.toLowerCase().includes(city)) return false;
                if (hobby && !m.hobbies.includes(hobby)) return false;
                if (ageGroup) {
                    if (!m.age) return false;
                    if (ageGroup === "18-25" && (m.age < 18 || m.age > 25)) return false;
                    if (ageGroup === "26-35" && (m.age < 26 || m.age > 35)) return false;
                    if (ageGroup === "36+" && m.age < 36) return false;
                }
                return true;
            });
        }

        function renderPaginationControls(totalPages) {
            const ul = document.getElementById("browse-pagination");
            ul.innerHTML = "";
            if (totalPages <= 1) return;

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement("li");
                li.className = `page-item ${state.pagination.currentPage === i ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link shadow-none" href="#">${i}</a>`;
                li.addEventListener("click", (e) => {
                    e.preventDefault();
                    state.pagination.currentPage = i;
                    renderBrowseMembers();
                });
                ul.appendChild(li);
            }
        }

        function initRegistrationHobbies() {
            const container = document.getElementById("register-hobbies-container");
            container.innerHTML = HOBBIES_LIST.map(h => `
                <span class="badge border bg-white text-dark selectable-hobby py-2 px-3 rounded-pill" onclick="toggleHobbySelection(this, '${h}')">${h}</span>
            `).join("");
        }

        function initFiltersDropdowns() {
            const select = document.getElementById("filter-hobby");
            select.innerHTML = `<option value="">Tous</option>` + HOBBIES_LIST.map(h => `<option value="${h}">${h}</option>`).join("");
        }

        function toggleHobbySelection(element, hobby) {
            if (state.selectedHobbiesRegister.includes(hobby)) {
                state.selectedHobbiesRegister = state.selectedHobbiesRegister.filter(h => h !== hobby);
                element.classList.remove("active");
            } else {
                state.selectedHobbiesRegister.push(hobby);
                element.classList.add("active");
            }
            document.getElementById("hidden-hobbies-input").value = state.selectedHobbiesRegister.join(",");
        }

        function handleRegister(e) {
            e.preventDefault();
            const form = e.target;
            
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                showToast("Veuillez remplir les champs obligatoires.", true);
                return;
            }

            const formData = new FormData(form);
            if (state.selectedHobbiesRegister.length === 0) {
                showToast("Sélectionnez au moins un loisir.", true);
                return;
            }

            let computedAge = null;
            if(formData.get("birthdate")) {
                computedAge = new Date().getFullYear() - new Date(formData.get("birthdate")).getFullYear();
            }

            const newMember = {
                id: state.members.length + 1,
                firstName: formData.get("firstName"),
                lastName: formData.get("lastName"),
                username: formData.get("username"),
                age: computedAge,
                gender: formData.get("gender"),
                country: formData.get("country"),
                city: formData.get("city"),
                hobbies: [...state.selectedHobbiesRegister],
                whatsapp: formData.get("whatsapp").replace(/\D/g, ''),
                bio: formData.get("bio"),
                registrationDate: "2026-07-11"
            };

            state.members.unshift(newMember);
            state.currentUser = newMember;
            updateAuthUI();

            showToast("Inscription visible sur la plateforme !");
            form.reset();
            form.classList.remove('was-validated');
            state.selectedHobbiesRegister = [];
            document.querySelectorAll(".selectable-hobby").forEach(el => el.classList.remove("active"));
            
            renderStats();
            renderRecentMembers();
            switchView("browse");
        }

        function handleLogin(e) {
            e.preventDefault();
            const ident = document.getElementById("login-identifier").value.trim();
            if(!ident) return;

            const user = state.members.find(m => m.username.toLowerCase() === ident.toLowerCase() || m.whatsapp === ident);
            state.currentUser = user || { username: ident, id: 999 };
            updateAuthUI();
            showToast(`Bienvenue !`);
            switchView("browse");
        }

        function logout() {
            state.currentUser = null;
            updateAuthUI();
            showToast("Déconnexion réussie.");
            switchView("home");
        }

        function updateAuthUI() {
            const guest = document.getElementById("nav-guest-actions");
            const user = document.getElementById("nav-user-actions");
            if (state.currentUser) {
                guest.classList.add("d-none"); user.classList.remove("d-none");
                document.getElementById("nav-username").innerText = state.currentUser.username;
            } else {
                guest.classList.remove("d-none"); user.classList.add("d-none");
            }
        }

        function triggerWhatsAppContact(phone) {
            const baseMsg = "Bonjour, je viens de découvrir ton profil sur la plateforme de nouvelles rencontres et j'aimerais faire connaissance avec toi si cela te convient.";
            const waUrl = `https://wa.me/${phone}?text=${encodeURIComponent(baseMsg)}`;
            document.getElementById("modal-whatsapp-trigger").setAttribute("href", waUrl);
            new bootstrap.Modal(document.getElementById('whatsappConfirmModal')).show();
        }

        function openProfileModal(id) {
            const m = state.members.find(member => member.id === id);
            if(!m) return;

            const initials = `${m.firstName.charAt(0)}${m.lastName.charAt(0)}`.toUpperCase();
            const badges = m.hobbies.map(h => `<span class="badge hobby-badge ${getHobbyBadgeColor(h)}">${h}</span>`).join(" ");

            document.getElementById("profile-modal-body").innerHTML = `
                <div class="d-flex justify-content-center my-3"><div class="avatar-placeholder">${initials}</div></div>
                <h4>${m.username}</h4>
                <p class="text-muted small">${m.city}, ${m.country}</p>
                <p class="bg-light p-3 rounded-3 small text-start">${m.bio || 'Aucune description.'}</p>
                <div class="d-flex flex-wrap gap-1 justify-content-center my-3">${badges}</div>
                <button class="btn btn-whatsapp w-100 rounded-pill py-2" onclick="bootstrap.Modal.getInstance(document.getElementById('viewProfileModal')).hide(); triggerWhatsAppContact('${m.whatsapp}')">Discuter sur WhatsApp</button>
            `;
            new bootstrap.Modal(document.getElementById('viewProfileModal')).show();
        }

        function openReportModal(id) {
            document.getElementById("report-target-id").value = id;
            document.getElementById("form-report").reset();
            new bootstrap.Modal(document.getElementById('reportModal')).show();
        }

        function handleReportSubmission(e) {
            e.preventDefault();
            state.reports.push({ targetId: document.getElementById("report-target-id").value, reason: document.getElementById("report-reason").value, timestamp: new Date() });
            bootstrap.Modal.getInstance(document.getElementById('reportModal')).hide();
            showToast("Signalement enregistré avec succès.");
        }

        function resetFilters() {
            ['filter-search', 'filter-country', 'filter-city', 'filter-gender', 'filter-age', 'filter-hobby'].forEach(id => document.getElementById(id).value = "");
            state.pagination.currentPage = 1;
            renderBrowseMembers();
        }

        function showToast(message, isError = false) {
            const toastEl = document.getElementById("live-toast");
            toastEl.classList.remove("bg-danger", "bg-success");
            toastEl.classList.add(isError ? "bg-danger" : "bg-success");
            document.getElementById("toast-message").innerText = message;
            new bootstrap.Toast(toastEl).show();
        }

        function handleScrollBehavior() {
            const btn = document.getElementById("btn-back-to-top");
            btn.style.display = (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) ? "flex" : "none";
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }

        function simulateIncomingUserRegistration() {
            const pseudos = ["GamerBenin", "Fleur_Cotonou", "Aventurier229", "TechBro"];
            showToast(`🌍 @${pseudos[Math.floor(Math.random() * pseudos.length)]} vient de rejoindre la plateforme !`);
        }
    </script>
</body>
</html>