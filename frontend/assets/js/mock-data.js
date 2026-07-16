/**
 * Données factices pour le prototype front-end.
 * À remplacer par de vrais appels API Laravel lors de l'intégration.
 */
const MOCK_MEMBERS = [
    { id: 1, pseudo: "Léa_29", age: 29, ville: "Cotonou", pays: "Bénin", sexe: "Femme", loisirs: ["Randonnée", "Photographie", "Cuisine"], phone: "22990000001", avatar: null, description: "Passionnée de photo et de randonnée, toujours partante pour découvrir de nouveaux endroits." },
    { id: 2, pseudo: "Karim_T", age: 34, ville: "Porto-Novo", pays: "Bénin", sexe: "Homme", loisirs: ["Football", "Jeux vidéo", "Musique"], phone: "22990000002", avatar: null, description: "Fan de foot et de jeux vidéo, toujours partant pour une bonne discussion." },
    { id: 3, pseudo: "Amina_R", age: 26, ville: "Abomey-Calavi", pays: "Bénin", sexe: "Femme", loisirs: ["Lecture", "Cinéma", "Voyages"], phone: "22990000003", avatar: null, description: "Grande lectrice, amoureuse des voyages et des bons films." },
    { id: 4, pseudo: "Yann_D", age: 31, ville: "Parakou", pays: "Bénin", sexe: "Homme", loisirs: ["Musculation", "Cuisine", "Voyages"], phone: "22990000004", avatar: null, description: "Sportif et gourmand, toujours en train de préparer le prochain voyage." },
    { id: 5, pseudo: "Fatou_S", age: 24, ville: "Cotonou", pays: "Bénin", sexe: "Femme", loisirs: ["Danse", "Musique", "Mode"], phone: "22990000005", avatar: null, description: "Passionnée de danse et de musique, toujours de bonne humeur." },
    { id: 6, pseudo: "Marc_O", age: 38, ville: "Lomé", pays: "Togo", sexe: "Homme", loisirs: ["Entrepreneuriat", "Lecture", "Golf"], phone: "22890000006", avatar: null, description: "Entrepreneur curieux de tout, amateur de bons livres." },
    { id: 7, pseudo: "Nadia_B", age: 27, ville: "Lomé", pays: "Togo", sexe: "Femme", loisirs: ["Yoga", "Cuisine", "Photographie"], phone: "22890000007", avatar: null, description: "Adepte du yoga et de la cuisine saine." },
    { id: 8, pseudo: "Idriss_K", age: 30, ville: "Abidjan", pays: "Côte d'Ivoire", sexe: "Homme", loisirs: ["Football", "Cinéma", "Tech"], phone: "22500000008", avatar: null, description: "Passionné de tech et de cinéma, féru de football le week-end." },
    { id: 9, pseudo: "Sarah_M", age: 25, ville: "Abidjan", pays: "Côte d'Ivoire", sexe: "Femme", loisirs: ["Art", "Écriture", "Voyages"], phone: "22500000009", avatar: null, description: "Artiste dans l'âme, toujours un carnet de voyage sous le bras." },
    { id: 10, pseudo: "Bruno_A", age: 33, ville: "Cotonou", pays: "Bénin", sexe: "Homme", loisirs: ["Natation", "Finance", "Voyages"], phone: "22990000010", avatar: null, description: "Entre la piscine et les chiffres, toujours partant pour une nouvelle rencontre." },
    { id: 11, pseudo: "Grace_E", age: 28, ville: "Porto-Novo", pays: "Bénin", sexe: "Femme", loisirs: ["Théâtre", "Musique", "Lecture"], phone: "22990000011", avatar: null, description: "Passionnée de théâtre et de belles histoires." },
    { id: 12, pseudo: "Steve_P", age: 36, ville: "Cotonou", pays: "Bénin", sexe: "Homme", loisirs: ["Football", "Marketing", "Voyages"], phone: "22990000012", avatar: null, description: "Marketeur le jour, supporter inconditionnel le week-end." },
];

// Loisirs disponibles pour les filtres et badges (couleurs associées)
const LOISIR_COLORS = {
    "Football": "primary", "Lecture": "info", "Cuisine": "warning", "Voyages": "success",
    "Jeux vidéo": "dark", "Cinéma": "danger", "Musique": "purple", "Photographie": "secondary",
    "Randonnée": "success", "Danse": "danger", "Mode": "warning", "Entrepreneuriat": "primary",
    "Golf": "success", "Yoga": "info", "Tech": "dark", "Art": "purple", "Écriture": "info",
    "Natation": "primary", "Finance": "dark", "Théâtre": "danger", "Marketing": "warning",
    "Musculation": "danger",
};