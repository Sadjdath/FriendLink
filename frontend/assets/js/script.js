/**
 * FriendLink — script.js
 * Logique front-end pure (aucune dépendance hors Bootstrap 5 JS).
 * Toutes les données sont mockées ; à remplacer par des appels fetch()
 * vers l'API Laravel lors de l'intégration back-end.
 */

document.addEventListener('DOMContentLoaded', () => {
    initLoader();
    initRevealOnScroll();
    initBackToTop();
    initStatsCounters();
    renderLatestMembers();
    renderFullMemberList();
    initFilters();
    initWhatsappConfirm();
    initReportModal();
    initNewMemberNotification();
    initRegisterForm();
});

/* ---------------------------------------------------------------------- */
/* Loader                                                                  */
/* ---------------------------------------------------------------------- */
function initLoader() {
    const loader = document.querySelector('.page-loader');
    if (!loader) return;
    window.addEventListener('load', () => {
        setTimeout(() => loader.classList.add('fade-out'), 300);
    });
}

/* ---------------------------------------------------------------------- */
/* Apparition progressive au scroll                                       */
/* ---------------------------------------------------------------------- */
function initRevealOnScroll() {
    const items = document.querySelectorAll('.fl-reveal');
    if (!items.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    items.forEach((item) => observer.observe(item));
}

/* ---------------------------------------------------------------------- */
/* Bouton retour en haut                                                  */
/* ---------------------------------------------------------------------- */
function initBackToTop() {
    const btn = document.querySelector('.fl-back-to-top');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        btn.classList.toggle('show', window.scrollY > 400);
    });

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

/* ---------------------------------------------------------------------- */
/* Compteurs animés (nombre de membres / inscriptions du jour)            */
/* ---------------------------------------------------------------------- */
function initStatsCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const animate = (el) => {
        const target = parseInt(el.dataset.counter, 10);
        const duration = 1200;
        const start = performance.now();

        function step(now) {
            const progress = Math.min((now - start) / duration, 1);
            el.textContent = Math.floor(progress * target).toLocaleString('fr-FR');
            if (progress < 1) requestAnimationFrame(step);
            else el.textContent = target.toLocaleString('fr-FR');
        }
        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animate(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach((c) => observer.observe(c));
}

/* ---------------------------------------------------------------------- */
/* Construction d'une carte membre (réutilisée sur plusieurs pages)       */
/* ---------------------------------------------------------------------- */
function buildMemberCard(member) {
    const initials = member.pseudo.slice(0, 2).toUpperCase();

    const badges = member.loisirs.map((loisir) => {
        const color = LOISIR_COLORS[loisir] || 'secondary';
        return `<span class="badge fl-badge-loisir bg-${color} bg-opacity-75">${loisir}</span>`;
    }).join(' ');

    return `
    <div class="col-sm-6 col-lg-3">
        <div class="card fl-member-card fl-reveal p-3">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="fl-avatar">${initials}</div>
                <div>
                    <h3 class="h6 mb-0 fw-bold">${member.pseudo}</h3>
                    <p class="text-muted small mb-0">
                        <i class="bi bi-geo-alt"></i> ${member.ville}${member.age ? ' · ' + member.age + ' ans' : ''}
                    </p>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-1 mb-3">${badges}</div>
            <div class="d-flex gap-2 mt-auto">
                <button class="btn btn-whatsapp btn-sm flex-fill"
                        data-whatsapp-btn
                        data-phone="${member.phone}"
                        data-pseudo="${member.pseudo}">
                    <i class="bi bi-whatsapp me-1"></i> Discuter
                </button>
                <button class="btn btn-outline-fl btn-sm" title="Voir le profil" data-bs-toggle="tooltip">
                    <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-outline-fl btn-sm" title="Signaler"
                        data-report-btn data-pseudo="${member.pseudo}">
                    <i class="bi bi-flag"></i>
                </button>
            </div>
        </div>
    </div>`;
}

/* ---------------------------------------------------------------------- */
/* Section "8 derniers membres inscrits" (page d'accueil)                 */
/* ---------------------------------------------------------------------- */
function renderLatestMembers() {
    const container = document.getElementById('latest-members');
    if (!container) return;

    const latest = [...MOCK_MEMBERS].slice(-8).reverse();
    container.innerHTML = latest.map(buildMemberCard).join('');

    initRevealOnScroll();
    initWhatsappConfirm();
    initReportModal();
}

/* ---------------------------------------------------------------------- */
/* Liste complète des membres avec recherche, filtres, pagination         */
/* (page members.html, accessible après connexion)                       */
/* ---------------------------------------------------------------------- */
const MEMBERS_PER_PAGE = 8;
let currentPage = 1;
let filteredMembers = [...MOCK_MEMBERS];

function renderFullMemberList() {
    const container = document.getElementById('full-member-list');
    if (!container) return;

    const start = (currentPage - 1) * MEMBERS_PER_PAGE;
    const pageItems = filteredMembers.slice(start, start + MEMBERS_PER_PAGE);

    container.innerHTML = pageItems.length
        ? pageItems.map(buildMemberCard).join('')
        : `<div class="col-12 text-center py-5 text-muted">
             <i class="bi bi-search fs-1 d-block mb-2"></i>
             Aucun membre ne correspond à votre recherche.
           </div>`;

    renderPagination();
    initRevealOnScroll();
    initWhatsappConfirm();
    initReportModal();

    const countEl = document.getElementById('member-count-label');
    if (countEl) {
        countEl.textContent = `${filteredMembers.length} membre${filteredMembers.length > 1 ? 's' : ''} trouvé${filteredMembers.length > 1 ? 's' : ''}`;
    }
}

function renderPagination() {
    const pagination = document.getElementById('members-pagination');
    if (!pagination) return;

    const totalPages = Math.ceil(filteredMembers.length / MEMBERS_PER_PAGE) || 1;
    let html = '';

    html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <button class="page-link" data-page="${currentPage - 1}">&laquo;</button>
    </li>`;

    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
            <button class="page-link" data-page="${i}">${i}</button>
        </li>`;
    }

    html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <button class="page-link" data-page="${currentPage + 1}">&raquo;</button>
    </li>`;

    pagination.innerHTML = html;

    pagination.querySelectorAll('[data-page]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const page = parseInt(btn.dataset.page, 10);
            const totalPages = Math.ceil(filteredMembers.length / MEMBERS_PER_PAGE) || 1;
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderFullMemberList();
            document.getElementById('full-member-list')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
}

/* ---------------------------------------------------------------------- */
/* Filtres et recherche (page members.html)                               */
/* ---------------------------------------------------------------------- */
function initFilters() {
    const searchInput = document.getElementById('search-input');
    const paysFilter = document.getElementById('filter-pays');
    const villeFilter = document.getElementById('filter-ville');
    const sexeFilter = document.getElementById('filter-sexe');
    const ageFilter = document.getElementById('filter-age');
    const loisirFilter = document.getElementById('filter-loisir');
    const resetBtn = document.getElementById('reset-filters');

    if (!document.getElementById('full-member-list')) return;

    const applyFilters = () => {
        const search = (searchInput?.value || '').toLowerCase().trim();
        const pays = paysFilter?.value || '';
        const ville = villeFilter?.value || '';
        const sexe = sexeFilter?.value || '';
        const age = ageFilter?.value || '';
        const loisir = loisirFilter?.value || '';

        filteredMembers = MOCK_MEMBERS.filter((m) => {
            if (search && !m.pseudo.toLowerCase().includes(search)) return false;
            if (pays && m.pays !== pays) return false;
            if (ville && m.ville !== ville) return false;
            if (sexe && m.sexe !== sexe) return false;
            if (loisir && !m.loisirs.includes(loisir)) return false;
            if (age) {
                const [min, max] = age.split('-').map(Number);
                if (m.age < min || m.age > max) return false;
            }
            return true;
        });

        currentPage = 1;
        renderFullMemberList();
    };

    [searchInput, paysFilter, villeFilter, sexeFilter, ageFilter, loisirFilter].forEach((el) => {
        el?.addEventListener('input', applyFilters);
        el?.addEventListener('change', applyFilters);
    });

    resetBtn?.addEventListener('click', () => {
        [searchInput, paysFilter, villeFilter, sexeFilter, ageFilter, loisirFilter].forEach((el) => {
            if (el) el.value = '';
        });
        filteredMembers = [...MOCK_MEMBERS];
        currentPage = 1;
        renderFullMemberList();
    });
}

/* ---------------------------------------------------------------------- */
/* Confirmation avant ouverture de WhatsApp                                */
/* ---------------------------------------------------------------------- */
function initWhatsappConfirm() {
    document.querySelectorAll('[data-whatsapp-btn]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const phone = btn.dataset.phone;
            const pseudo = btn.dataset.pseudo;

            const modalEl = document.getElementById('whatsappConfirmModal');
            if (!modalEl) return;

            modalEl.querySelector('[data-target-pseudo]').textContent = pseudo;

            const confirmBtn = modalEl.querySelector('[data-confirm-whatsapp]');
            confirmBtn.onclick = () => {
                const message = encodeURIComponent(
                    `Bonjour ! Je viens de découvrir ton profil sur FriendLink et j'aimerais faire connaissance avec toi si cela te convient.`
                );
                window.open(`https://wa.me/${phone}?text=${message}`, '_blank');
                bootstrap.Modal.getInstance(modalEl)?.hide();
            };

            new bootstrap.Modal(modalEl).show();
        });
    });
}

/* ---------------------------------------------------------------------- */
/* Modale de signalement                                                  */
/* ---------------------------------------------------------------------- */
function initReportModal() {
    document.querySelectorAll('[data-report-btn]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const pseudo = btn.dataset.pseudo;
            const modalEl = document.getElementById('reportModal');
            if (!modalEl) return;

            modalEl.querySelector('[data-report-target]').textContent = pseudo;
            new bootstrap.Modal(modalEl).show();
        });
    });

    const reportForm = document.getElementById('report-form');
    reportForm?.addEventListener('submit', (e) => {
        e.preventDefault();
        const modalEl = document.getElementById('reportModal');
        bootstrap.Modal.getInstance(modalEl)?.hide();

        showToast('Signalement envoyé', 'Merci, notre équipe va examiner ce profil.', 'bi-flag-fill text-danger');
        reportForm.reset();
    });
}

/* ---------------------------------------------------------------------- */
/* Notification discrète de nouveau membre (simulation)                   */
/* ---------------------------------------------------------------------- */
function initNewMemberNotification() {
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) return;

    const names = ['Chloé_M', 'David_N', 'Ines_K', 'Paul_R', 'Aïcha_D'];

    setInterval(() => {
        const name = names[Math.floor(Math.random() * names.length)];
        showToast('Nouveau membre 🎉', `${name} vient de rejoindre FriendLink.`, 'bi-person-plus-fill text-primary');
    }, 25000);
}

function showToast(title, message, iconClass = 'bi-info-circle') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = 'fl-toast';
    toast.innerHTML = `
        <i class="bi ${iconClass} fs-4"></i>
        <div>
            <p class="fw-bold mb-0 small">${title}</p>
            <p class="text-muted mb-0 small">${message}</p>
        </div>`;
    container.appendChild(toast);

    requestAnimationFrame(() => toast.classList.add('show'));

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 5000);
}

/* ---------------------------------------------------------------------- */
/* Formulaire d'inscription (validation Bootstrap + message de succès)    */
/* ---------------------------------------------------------------------- */
function initRegisterForm() {
    const form = document.getElementById('register-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        document.getElementById('register-success')?.classList.remove('d-none');
        form.classList.add('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}