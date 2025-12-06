<?php
function currentPage($url, $page)
{
    if ((!empty($page)) && (!empty($url))) {
        if ($url == $page) {
            echo 'current';
        }
    }
    return false;
}

function convertDateFormat($date, $type, $format)
{
    $valueDate = "";
    if ($type == 'database') {
        $valueDate = date($format, strtotime(str_replace('/', '-', $date)));
    } else {
        $valueDate = date($format, strtotime($date));
    }
    return $valueDate;
}

function getTotalDays($start_date, $end_date, $type = null)
{
    $date_end = (!empty($end_date)) ? $end_date : date('Y/m/d');
    //if ($start_date = $date_jr) {
    $d1 = new DateTime($start_date);
    $d2 = new DateTime($date_end);
    $diff = $d1->diff($d2, true);
    //
    $duree_annee = $diff->y;
    $duree_mois = $diff->m;
    $duree_jours = $diff->d;
    $total_annees = ($duree_annee * 12);
    $total_mois = ($duree_annee * 12) + $duree_mois;
    $total_jours = ($total_mois * 30) + $duree_jours;
    $result = 0;
    switch ($type) {
        case 'year':
            $result = $total_annees;
            break;
        case 'day':
            $result = $total_jours;
            break;
        default:
            $result = $total_mois;
            break;
    }
    return $result;
}
function setPrimaryKey()
{
    $aleatoire = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz";
    $code_value = substr(str_shuffle(str_repeat($aleatoire, mt_rand(50, 75))), 0, 50);
    return date('ymd') . $code_value . time();
}
function setReferenceCode()
{
    $aleatoire_value = "0123456789";
    $new_code_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 10))), 0, 4);
    $valideCode = date('y') . $new_code_generate;
    return $valideCode;
}
function setPassword()
{
    $aleatoire = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz";
    $code_value = substr(str_shuffle(str_repeat($aleatoire, mt_rand(10, 20))), 0, 4);
    return date('ymd') . $code_value;
}
function setInvoiceNumber($type = null)
{
    $aleatoire_value = "0123456789";
    $new_code_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 10))), 0, 4);
    if ($type == "order") {
        return date("Y") . "-CMD-" . $new_code_generate . date("m");
    } elseif ($type == "invoice") {
        return date("Y") . "-INV-" . $new_code_generate . date("m");
    } elseif ($type == "payment") {
        return date("Y") . "-PO-" . $new_code_generate . date("m");
    } else {
        return date("Y") . $new_code_generate . date("m");
    }
}

function setSlugTitle($str)
{
    $url = $str;
    $url = preg_replace('#Ç#', 'C', $url);
    $url = preg_replace('#ç#', 'c', $url);
    $url = preg_replace('#è|é|ê|ë#', 'e', $url);
    $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
    $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
    $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
    $url = preg_replace('#ì|í|î|ï#', 'i', $url);
    $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
    $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
    $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
    $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
    $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
    $url = preg_replace('#ý|ÿ#', 'y', $url);
    $url = preg_replace('#Ý#', 'Y', $url);

    return url_title(strtolower($url));
}

function checkExpiryTime($datetime)
{
    $current_time = time();
    $time_diff = ($current_time - strtotime($datetime)) / 60;
    return $time_diff;
}
function getInvoiceStatus($value_invoice = null)
{
    $invocies_values = array(

        'paid' => "Payée",
        'unpaid' => "Non-payée",
        'partial' => "Acompte Payé",
        'cancel' => "Annulée",
        'pending' => "En attente",
        'actif' => "Activé",
        'inactif' => "Désactivé",
        'completed' => "Completé",
    );
    if (!empty($value_invoice)) {
        $value_text = "";
        foreach ($invocies_values as $value => $display_text) {
            if ($value_invoice == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $invocies_values;
    }
}

function getPostsTypesValues($single = null)
{
    $unity_values = array(
        'ads' => "Annonce",
        'post' => "Actualité",
        'sale' => "Campagne vente",
        'promo' => "Promotion vente",
    );
    if (!empty($single)) {
        $value_text = "";
        foreach ($unity_values as $value => $display_text) {
            if ($single == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $unity_values;
    }
}

function getTypingCategories($single = null)
{
    $types_values = array(
        'blog' => 'Catégorie publication',
        'products' => 'Catégorie Produits',
        'events' => 'Catégorie Evénements',
        'training' => 'Catégorie Formations'
    );
    if (!empty($single)) {
        $value_text = "";
        foreach ($types_values as $value => $display_text) {
            if ($single == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values;
    }
}
function getEventsTypesValues($single = null)
{
    $types_values = array(
        'online' => 'En ligne',
        'presentiel' => 'Présentiel',
    );
    if (!empty($single)) {
        $value_text = "";
        foreach ($types_values as $value => $display_text) {
            if ($single == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values;
    }
}
function getStatusValues($single = null)
{
    $status_values = array(
        'actif' => 'Activé',
        'inactif' => 'Désactivé',
        'published' => 'Publié',
        'draft' => 'Brouillon',
        'archived' => 'Archivé',
        'pending' => 'En attente',
        'completed' => 'Complétée',
        'validated' => 'Validée',
        'cancel' => 'Annulée',
        'delivery' => 'Livrée',
        'send' => 'Envoyé',
    );
    if (!empty($single)) {
        $value_text = "";
        foreach ($status_values as $value => $display_text) {
            if ($single == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $status_values;
    }
}
function setStatusColors($status)
{
    $status_values_colors = array(
        'actif' => 'primary',
        'draft' => 'warning',
        'published' => 'success',
        'inactif' => 'danger',
        'archived' => 'dark',
        'pending' => 'warning',
        'completed' => 'success',
        'cancel' => 'danger',
        'validated' => 'success',
        'delivery' => 'info',
        'unpaid' => 'warning',
        'paid' => 'success',
        'deposit' => 'primary',
        'send' => 'success',
    );
    if (!empty($status)) {
        $value_text = "";
        foreach ($status_values_colors as $value => $display_text) {
            if ($status == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    }
}
function setFAQTypes($nametype = null)
{
    $types_values_faqs = array(
        'general' => 'Général',
        'security' => 'Sécurité',
        'service' => 'Services',
        'register' => 'Abonnement',
        'promotion' => 'Fonctionnement',
        'article' => 'Articles',
        'product' => 'Produits ',
        'offre' => 'Offres services',
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values_faqs;
    }
}
function setProductTypes($nametype = null)
{
    $types_values_faqs = array(
        'cleaning' => "Produits nettoyage",
        'grocery' => "Produits épicerie",
        'trousers' => "Pantalons",
        'shirts' => "Chemises",
        'shoes' => "Chaussures",
        'pullovers' => "Pullovers",
        'belts' => "Ceintures",
        'singles' => "Singlets",
        'jackets' => "Vestes",
        'polo-shirts' => "Polos",
        'bags' => "Sacs",
        'portfolios' => "Portefeuilles",
        'blouses' => "Blouses",
        'dresses' => "Robes",
        't-shirts' => "T-shirts",
        'swimwear' => 'Maillots de bains',
        'watchs' => "Montres",
        'ties' => "Cravates",
        'panties' => "Culottes",
        'mens-hats' => "Chapeaux",
        'earrings' => "Boucles d'oreilles",
        'gadgets' => "Gadgets",
        'bracelets' => "Bracelets",
        'technologies' => "Appareils",
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values_faqs;
    }
}
function setWebsitePages($name = null)
{
    $pages_values = array(
        'home' => 'Accueil',
        'events' => 'Evénements',
        'contacts' => 'Contacts',
        'contact-us' => 'Nous contacter',
        'services' => 'Services',
        'register' => 'Abonnement',
        'newsletter' => 'Newsletter',
        'promotions' => 'Promotions',
        'blog' => 'Publication',
        'products' => 'Produits ',
        'offer' => 'Offres',
        'about' => 'A propos',
        'about-us' => 'A propos de nous',
        'partnership' => 'Partenariat',
        'partners' => 'Partenaires',
        'testimonies' => 'Témoignages',
        'shops' => 'Boutique',
        'basket' => 'Panier Achats',
        'checkout' => 'Commandes clients',
        'payments' => 'Paiements commandes',
        'conditions' => 'Conditions de vente',
        'cookies' => 'Politique des cookies',
        'privacy-policy' => 'Confidentialité',
        'sitemap' => 'Plan du site',
        'languages' => 'Langues du site',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($pages_values as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $pages_values;
    }
}

function setSchoolTypes($name = null)
{
    $pages_values = array(
        'community-school' => 'Ecole Communautaire',
        'approved-school' => 'Ecole Conventionnée',
        'private-school-agreed' => 'Ecole Privée Agréée',
        'private-school' => 'Ecole Privée',
        'public-school' => 'Ecole Publique',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($pages_values as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $pages_values;
    }
}
function setSchoolCategory($name = null)
{
    $pages_values = array(
        'enterprise' => 'Entreprise',
        'company' => 'Société',
        'coordination' => 'Coordination',
        'group-school' => 'Groupe Scolaire',
        'complex-school' => 'Complexe Scolaire',
        'training-center' => 'Centre de formation',
        'kindergarten' => 'Maternelle',
        'primary' => 'Primaire',
        'secondary' => 'Sécondaire',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($pages_values as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $pages_values;
    }
}
function setDegresLevels($name = null, $type = null)
{
    $pages_values = array(
        '1' => ($type == 'f') ? '1ère' : '1er',
        '2' => '2ème',
        '3' => '3ème',
        '4' => '4ème',
        '5' => '5ème',
        '6' => '6ème',
        '7' => '7ème',
        '8' => '8ème',
        '9' => '9ème',
        '10' => '10ème',
        '11' => '11ème',
        '12' => '12ème',
        '13' => '13ème',
        '14' => '14ème',
        '15' => '15ème',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($pages_values as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $pages_values;
    }
}
function setSubclasses($name = null)
{
    $alphas = range('A', 'Z');

    if (!empty($name)) {
        $value_text = "";
        foreach ($alphas as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $alphas;
    }
}
function setSectionsTypes($name = null)
{
    $pages_values = array(
        'technical' => 'Technique',
        'general' => 'Générale',
        'management' => 'Gestion',
        'professional' => 'Professionnelle',
        'techgen' => 'Technique et Générale',
        'all' => 'Autres',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($pages_values as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $pages_values;
    }
}
function setAccessModules($name = null)
{
    $modules = array(
        'all' => 'Tous les modules',
        'overview' => "Vue d'ensemble",
        'fees' => 'Gestion frais',
        'admins' => 'Administration',
        'students' => 'Dossiers scolaires',
        'finances' => 'Gestion financière',
        'settings' => 'Paramètrages systèmes',
        'messaging' => 'Communication',
        'search' => 'Recherche des infos',
        'reporting' => 'Edition Rapports',
        'tools' => 'Outils de gestion',
        'teaching' => 'Publications résultats',
        //'gesem' => 'Ressources humaines',
        'payroll' => 'Gestion de la paie',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($modules as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $modules;
    }
}
function setModulesFeatures($feature = null, $module = null)
{
    $features = [];
    // if($module == '')
    $features = array(
        //vue d'ensemble
        'all' => 'Tout',
        'dashboard' => ($module == 'overview') ? 'Tableau de bord' : '',
        'infosheet' => ($module == 'overview') ? 'Présentation école' : '',
        'database' => ($module == 'overview') ? 'Base de données' : '',
        //dossiers scolaires
        'inscription' => ($module == 'students') ? 'Inscriptions' : '',
        'basculement' => ($module == 'students') ? 'Basculement Annuel' : '',
        'parents' => ($module == 'students') ? 'Fiches parents' : '',
        'registers' => ($module == 'students') ? 'Registres' : '',
        'parcours' => ($module == 'students') ? 'Parcours scolaires' : '',
        //gestion frais
        'configfees' => ($module == 'fees') ? 'Nomenclature frais' : '',
        'classesfees' => ($module == 'fees') ? 'Configuration details frais' : '',
        'exemptions' => ($module == 'fees') ? 'Configuration exhonerations' : '',
        'scholarships' => ($module == 'fees') ? 'Configuration Bourses étudiants' : '',
        'exchanges' => ($module == 'fees') ? 'Configuration taux de change' : '',
        'payments' => ($module == 'fees') ? 'Perception frais' : '',
        'bills' => ($module == 'fees') ? 'Reçus de paiements' : '',

        //Gestion financiere
        'cashbox' => ($module == 'finances') ? 'Situation caisse' : '',
        'expenses' => ($module == 'finances') ? 'Décaissement' : '',
        'operations' => ($module == 'finances') ? 'Opérations caisses' : '',
        'banking' => ($module == 'finances') ? 'Comptes bancaires' : '',
        'transactions' => ($module == 'finances') ? 'Transactions bancaires' : '',

        //Settings
        'years' => ($module == 'settings') ? 'Années scolaires' : '',
        'sections' => ($module == 'settings') ? 'Sections organisées' : '',
        'options' => ($module == 'settings') ? 'Options organisées' : '',
        'levels' => ($module == 'settings') ? 'Degrés classes' : '',
        'classes' => ($module == 'settings') ? 'Classes organisées' : '',

        //Administration
        'roles' => ($module == 'admins') ? 'Gestion Roles' : '',
        'users' => ($module == 'admins') ? 'Gestion utilisateurs' : '',
        'access' => ($module == 'admins') ? 'Gestion des accès' : '',
        'branchs' => ($module == 'admins') ? 'Affectation utilisateurs' : '',
        'logs' => ($module == 'admins') ? 'Journalisation systèmes' : '',
        'activity' => ($module == 'admins') ? 'Activités systèmes' : '',

        //Administration
        'sms' => ($module == 'messaging') ? 'Envoi des sms' : '',
        'emails' => ($module == 'messaging') ? 'Envoi des emails' : '',
        'broadcast' => ($module == 'messaging') ? 'Messages broadcast' : '',
        'activation' => ($module == 'messaging') ? 'Activation messagerie' : '',
        'messages' => ($module == 'messaging') ? 'Alertes systemes' : '',
        'agents' => ($module == 'messaging') ? 'Envoi des messages aux agents' : '',

        //REPORTING
        'repparents' => ($module == 'reporting') ? 'Contacts parents' : '',
        'repannuary' => ($module == 'reporting') ? 'Annuaires parents' : '',
        'replisting' => ($module == 'reporting') ? 'Listes des étudiants' : '',
        'repstudents' => ($module == 'reporting') ? 'Registres des étudiants' : '',
        'reppayments' => ($module == 'reporting') ? 'Versements frais' : '',
        'repcashbox' => ($module == 'reporting') ? 'Journal caisses' : '',
        'reprecovery' => ($module == 'reporting') ? 'Recouvrement frais' : '',
        'repfees' => ($module == 'reporting') ? 'Perception globale frais' : '',
        'repusersfees' => ($module == 'reporting') ? 'Perception frais par agent' : '',
        'repbanking' => ($module == 'reporting') ? 'Transactions bancaires' : '',
        'repyearly' => ($module == 'reporting') ? "Statistiques des effectifs étudiants" : '',

        //TOOLS
        'exports' => ($module == 'tools') ? 'Exportation de données' : '',
        'expparents' => ($module == 'tools') ? 'Exportation des parents' : '',
        'expstudents' => ($module == 'tools') ? 'Exportation des étudiants' : '',
        'help' => ($module == 'tools') ? 'Assistance technique' : '',
        'events' => ($module == 'tools') ? 'Calendrier événementiel' : '',
        'notifications' => ($module == 'tools') ? 'Notifications' : '',

        //TEACHING
        'timing' => ($module == 'teaching') ? 'Configuration périodes' : '',
        'encoding' => ($module == 'teaching') ? 'Encodages résultats' : '',
        'schoolary' => ($module == 'teaching') ? 'Résultats scolaires' : '',
        'pubs' => ($module == 'teaching') ? 'Publications en ligne' : '',
        'results' => ($module == 'teaching') ? 'Consultation Résultats' : '',
        
        //payroll
        'employees' => ($module == 'payroll') ? 'Dossiers Employés' : '',
        'salaries' => ($module == 'payroll') ? 'Gestion salaires' : '',
        'payslip' => ($module == 'payroll') ? 'Bulletins de paie' : '',
        'categories' => ($module == 'payroll') ? 'Catégories Employés' : '',
        'contracts' => ($module == 'payroll') ? 'Contrats Employés' : '',
        'deductions' => ($module == 'payroll') ? 'Retenues sur salaire' : '',
        'attendances' => ($module == 'payroll') ? 'Pointages présences' : '',
        'requests' => ($module == 'payroll') ? 'Avances Salaires' : '',
        'leaves' => ($module == 'payroll') ? 'Congés Employés' : '',
        'badges' => ($module == 'payroll') ? 'Badges Agents' : '',
    );
    if (!empty($feature)) {
        $value_text = "";
        foreach ($features as $value => $display_text) {
            if ($feature == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $features;
    }
}

function checkUserAccessFolder($module = null)
{
    //session()->set('profile', 'sysadmin');

    if ((session()->get('profile') == 'root') && session()->get('all') == TRUE) {
        $modules = setAccessModules();
        foreach ($modules as $modulekey => $value) {
            session()->set($modulekey, TRUE);
            session()->set($modulekey . '_reading', 'on');
            session()->set($modulekey . '_updated', 'on');
            session()->set($modulekey . '_created', 'on');
            session()->set($modulekey . '_deleted', 'on');
        }
        return true;
    } elseif ((session()->get('profile') != 'sysadmin') && $module == 'on') {
        return true;
    } else {
        session()->setFlashdata('failed', "Vous n'avez pas d'autorisation de lecture sur ce dossier. Pour plus de détails, contacter votre administrateur ou gestionnaire.");
        return false;
    }
}
function checkModuleAccess($feature = null, $module_access = null)
{
    if (session()->get('admin') == TRUE or session()->get('all')) {
        $module_session = (session()->get('admin') == TRUE or session()->get('all') == TRUE) ? 'active' : 'd-none';
        return $module_session;
    } else {
        if (!empty($module_access)) {

            $module_session = (session()->get($module_access) == TRUE) ? 'active' : 'd-none';
            return $module_session;
        } else {
            if (!empty($feature)) {

                $feature_session = (session()->get($feature) == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? 'active' : 'd-none';

                return $feature_session;
            }
        }
    }
}
function disabledAccessModule($reportkey = null, $feature = null)
{
    if (!empty($reportkey)) {
        switch ($reportkey) {
            case 'fees_students':
            case 'fees_classes':
                $accessname = 'repfees';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';

            case 'student_payment':
            case 'exemptions':
                $accessname = 'reppayments';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all')) ? '' : 'disabled';

            case 'fees_recovery':
                $accessname = 'reprecovery';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';

            case 'cashbox_finances':
            case 'finances_fees':
                $accessname = 'repcashbox';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';

            case 'student_identity':
            case 'student_serni':
                $accessname = 'repstudents';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';

            case 'phone_annuary':
                $accessname = 'repannuary';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';

            case 'yearly_students':
            case 'school_annuary':
                $accessname = 'repyearly';
                $feature_access = session()->has($accessname) ? session()->get($accessname) : '';
                return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';

            default:
                return (session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : '';
        }
    } else {
        if (!empty($feature)) {

            $feature_access = session()->has($feature) ? session()->get($feature) : '';

            return ($feature_access == TRUE or session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled';
        }
    }
}
function setFeesTypes($name = null)
{
    $modules = array(
        'installment' => 'Tranche',
        'annual' => 'Annuel',
        'semi-annual' => 'Semestriel',
        'quarterly' => 'Trimestriel',
        'monthly' => 'Mensuel',
        'weekly' => 'Hebdomadaire',
        'daily' => 'Journalier',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($modules as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $modules;
    }
}
function setCurrency($name = null)
{
    $modules = array(
        'usd' => 'Dollars Américains(USD)',
        'cdf' => 'Francs Congolais(CDF)',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($modules as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $modules;
    }
}
function setMonthsYear($name = null)
{
    $modules = array(
        '1' => 'Janvier',
        '2' => 'Février',
        '3' => 'Mars',
        '4' => 'Avril',
        '5' => 'Mai',
        '6' => 'Juin',
        '7' => 'Juillet',
        '8' => 'Aout',
        '9' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre',
    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($modules as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $modules;
    }
}
function setFrenchDays($name = null, $style = null)
{
    $modules = '';
    if ($style == 'number') {
        $modules = array(
            '1' => 'Lundi',
            '2' => 'Mardi',
            '3' => 'Mercredi',
            '4' => 'Jeudi',
            '5' => 'Vendredi',
            '6' => 'Samedi',
            '7' => 'Dimanche',
        );
    } else {
        $modules = array(
            'monday' => 'Lundi',
            'tuesday' => 'Mardi',
            'wednesday' => 'Mercredi',
            'thusday' => 'Jeudi',
            'friday' => 'Vendredi',
            'saturday' => 'Samedi',
            'sunday' => 'Dimanche',
        );
    }
    if (!empty($name)) {
        $value_text = "";
        foreach ($modules as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $modules;
    }
}
function setExpenseType($type = null)
{
    $types = array(
        'exchange' => 'Echange de monnaie',
        'returning' => 'Remboursement frais',
        'expense' => 'Charges de gestion',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}
function setExpenseCategory($namecategory = null)
{
    $types = array(
        'usdin' => 'Change USD vs CDF',
        'usdout' => 'Change CDF vs USD',
        'operaton' => 'Remboursement',
    );
    if (!empty($namecategory)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($namecategory == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}

function confessionReligieuse($nametype = null)
{
    $types_values_faqs = array(
        'catholique' => 'Catholique',
        'methodiste' => 'Méthodiste',
        'penthecotiste' => 'Penthecotiste',
        'kimbanguiste' => 'Kimbanguiste',
        'temoins' => 'Temoins de Jéhovah',
        'apostolique' => 'Néo-Apostolique',
        'reveil' => 'Eglise de reveil',
        'divers' => 'Autre confession',
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values_faqs;
    }
}
function setDocumentType($nametype = null)
{
    $types_values_faqs = array(
        'document' => 'Document physique déposé',
        'divers' => 'Bien matériel déposé',
        'confusque' => 'Bien confusqué',
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values_faqs;
    }
}
function setCourseType($nametype = null)
{
    $types_values_faqs = array(
        'scientifique' => 'Scientifique',
        'litteraire' => 'Littéraire',
        'commercial' => 'Commercial',
        'technique' => 'Technique',
        'professionnel' => 'Professionnel',
        'general' => 'Général',
        'art' => 'Arts et culture',
        'sport' => 'Sportif et éducation physique',
        'other' => 'Autres types de cours',
        'all' => 'Tous les types de cours',
        'none' => 'Aucun type de cours défini',
        'beginner' => 'Débutant',
        'intermediate' => 'Intermédiaire',
        'advanced' => 'Avancé',
        'expert' => 'Expert',
        'professional' => 'Professionnel',
        'master' => 'Maîtrise',
        'phd' => 'Doctorat',
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values_faqs;
    }
}

function setReporting($nametype = null, $title = null)
{
    $types_values_faqs = array(
        'fees_students' => (!empty($title)) ? $title : 'Communiqué de la situation de paiement frais par étudiant',
        //'fees_classes' => (!empty($title)) ? $title : 'Communiqué de la situation de paiement frais par classe',
        'student_identity' => (!empty($title)) ? $title : "Communiqué de confirmation des données d'inscription",
        'fees_recovery' => (!empty($title)) ? $title : 'Recouvrement frais de la situation globale de paiement',
        'cashbox_finances' => (!empty($title)) ? $title : 'Synthèse de la situation globale des caisses',

        'finances_fees' => (!empty($title)) ? $title : "Plan Budgétaire(Controle Frais)",

        'student_payment' => (!empty($title)) ? $title : 'Suivi de la situation globale de paiement frais',
        'exemptions' => (!empty($title)) ? $title : 'Exhonérations Frais',

        'student_serni' => (!empty($title)) ? $title : "Fiche serni d'identification des étudiants",
        'yearly_students' => (!empty($title)) ? $title : "Statistiques sur effectif des étudiants",
        'phone_annuary' => (!empty($title)) ? $title : "Annuaire téléphonique des parents",
        'school_annuary' => (!empty($title)) ? $title : "Annuaire scolaire des étudiants",
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {

        return $types_values_faqs;
    }
}
function reportingReferenceNumber($type = null)
{
    $aleatoire_value = "0123456789";
    $new_code_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 10))), 0, 4);

    return 'No:' . ' ' . $new_code_generate . '/' . date("m") . '/0' . date("y");
}

function incidentsTypes($nametype = null)
{

    $types_incidents = [
        "Comportement / Discipline" => [
            "Insolence",
            "Provocation",
            "Refus d'obéir",
            "Violence verbale",
            "Manque de respect",
            "Violence physique",
            "Insultes et injures",
            "Langage inapproprié",
            "Bavardage excessif",
            "Harcèlement (moral, physique, cyber)",
            "Intimidation (physique, verbale, psychologique)",
            "Jet d'objet dangereux (pierres, bouteilles, etc.)",
            "Manque de respect envers les adultes ou les pairs",
            "Dégradation de matériel",
        ],
        "Ponctualité / Présence" => [
            "Retard",
            "Sortie non autorisée",
            "Absence non justifiée",
        ],
        "Travail / Engagement" => [
            "Matériel oublié",
            "Devoirs non faits",
            "Travail non rendu",
            "Inattention en classe",
            "Triche et Fraude (copie, plagiat, etc.)",
        ],
        "Technologie / Objets interdits" => [
            "Utilisation non autorisée du téléphone portable",
            "Réseaux sociaux pendant les cours",
            "Jeux vidéos en ligne pendant les cours",
            "Objets interdits en classe (couteau, briquet, etc.)",
        ],
        "Sécurité / Hygiène" => [
            "Fumer",
            "Vapoter",
            "Non-respect des consignes de sécurité",
            "Mise en danger d'autrui ou de soi-même",
            "Dégradations (toilettes, mobilier, murs...)",
        ],
        "Vie collective / Autres" => [
            "Vol",
            "Tapage",
            "Mensonge",
            "Intrusion",
            "étudiant non autorisé",
            "Cris dans les couloirs",
            "Usurpation d'identité",
            "Attitude déplacée (gestes, propos à connotation sexuelle, etc.)",
        ],
    ];

    if (!empty($nametype)) {
        $value_incident = "";
        foreach ($types_incidents as $categorie => $types) {

            foreach ($types as $incident) {

                if ($nametype == $incident) {

                    $value_incident = $categorie;
                } else {
                    $value_incident = "none";
                }
            }
        }
        return $value_incident;
    } else {
        return $types_incidents;
    }
}
function setStudentsBehaviors($nametype = null)
{
    $types_students_behaviors = [
        "Respect des règles" => [
            "Suit les consignes en classe",
            "Respecte le matériel scolaire",
            "Est ponctuel(le) et assidu(e)",
            "Respecte les autres étudiants et les adultes"
        ],
        "Attitude en classe" => [
            "Participe activement aux cours",
            "Reste concentré(e) sur son travail",
            "Termine ses tâches dans les délais",
            "Fait preuve d’autonomie"
        ],
        "Comportement social" => [
            "Aide les camarades en difficulté",
            "Utilise un langage respectueux",
            "Fait preuve de coopération en groupe",
            "S’excuse en cas d’erreur ou de conflit"
        ],
        "Attitude face aux apprentissages" => [
            "Fait preuve de curiosité intellectuelle",
            "Pose des questions pertinentes",
            "Fait des efforts constants",
            "Ne se décourage pas en cas d’échec"
        ],
        "Engagement et initiative" => [
            "Prend des responsabilités (ex : délégué, médiateur, aide aux devoirs)",
            "Propose des idées constructives",
            "Participe aux projets de classe ou d’école",
            "Encourage ses camarades"
        ]
    ];

    $types_students_behaviors = incidentsTypes();
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_students_behaviors as $categorie => $types) {
            foreach ($types as $type) {
                if ($nametype == $type) {
                    $value_text = $categorie;
                } else {
                    $value_text = "none";
                }
            }
        }
        return $value_text;
    } else {
        return $types_students_behaviors;
    }
}

function setSanctionsTypes($nametype = null)
{

    $types_sanctions = [
        "Sanctions pédagogiques" => [
            "Observation orale",
            "Remarque écrite dans le carnet",
            "Travail supplémentaire à visée éducative",
            "Excuse écrite ou orale",
        ],
        "Sanctions disciplinaires internes" => [
            "Avertissement écrit",
            "Avertissement verbal",
            "Blâme écrit",
            "Exclusion temporaire d’un cours",
            "Exclusion temporaire de l’établissement (1 à 8 jours)"
        ],
        "Sanctions du conseil de discipline" => [
            "Mise à pied avec convocation au conseil",
            "Exclusion définitive de l’établissement"
        ],
        "Sanctions alternatives ou éducatives" => [
            "Lettre d’excuse",
            "Travail de réparation",
            "Engagement écrit de l’étudiant",
            "Médiation avec un adulte ou un étudiant",
            "Stage d'observation ou citoyen"
        ]
    ];

    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_sanctions as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            } else {
                $value_text = "none";
            }
        }
        return $value_text;
    } else {
        return $types_sanctions;
    }
}
function logActivityType($nameTypeLog = null)
{
    $types = array(
        'login' => 'Connexion',
        'create' => 'Création',
        'update' => 'Modification',
        'activity' => 'Activité',
        'system' => 'Automatique',
        'user' => 'Manuel',
        'session' => 'Authentification',
        'messaging' => 'Communication',
        'cancel' => 'Annulation',
        'admin' => 'Administration',
        'password' => 'Mot de passe',
        'change' => 'Changement',
        'account' => 'Gestion Compte',
        'profile' => 'Gestion Profile',
        'invoicing' => 'Facturation',
        'contacts' => 'Carnet Adresses',
        'store' => 'Gestion stocks',
        'supply' => 'Gestion ventes',
        'company' => 'Fiche entreprise',
        'financial' => 'Finances',
        'orders' => 'Commandes',
        'shops' => 'Magasins',
        'products' => 'Gestion produits',
        'reporting' => 'Edition Rapports',
        'access' => 'Acces aux Rapports',
        'cashbox' => 'Opération Caisse',
        'banks' => 'Opération Bancaire',
    );
    if (!empty($nameTypeLog)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($nameTypeLog == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}
function getSaleShopSession()
{
    $shop_id = '';

    if (session('profile') == 'agent') {

        $shop_id = session('shopid');
    } else {

        $shop_id = session('sale_shop_id');
    }
    return $shop_id;
}

function countries($nametype = null)
{
    $types_values_faqs = array(
        'afghan' => 'Afghane',
        'albanian' => 'Albanaise',
        'algerian' => 'Algérienne',
        'american' => 'Américaine',
        'andorran' => 'Andorrane',
        'angolan' => 'Angolaise',
        'argentine' => 'Argentine',
        'armenian' => 'Arménienne',
        'australian' => 'Australienne',
        'austrian' => 'Autrichienne',
        'azerbaijani' => 'Azerbaïdjanaise',
        'bahamian' => 'Bahamienne',
        'bahraini' => 'Bahreïnienne',
        'bangladeshi' => 'Bangladaise',
        'barbadian' => 'Barbadienne',
        'belarusian' => 'Biélorusse',
        'belgian' => 'Belge',
        'belizean' => 'Bélizienne',
        'beninese' => 'Béninoise',
        'bhutanese' => 'Bhoutanaise',
        'bolivian' => 'Bolivienne',
        'bosnian' => 'Bosnienne',
        'botswanan' => 'Botswanaise',
        'brazilian' => 'Brésilienne',
        'british' => 'Britannique',
        'bruneian' => 'Brunéienne',
        'bulgarian' => 'Bulgare',
        'burkinabe' => 'Burkinabé',
        'burmese' => 'Birmane',
        'burundian' => 'Burundaise',
        'cambodian' => 'Cambodgienne',
        'cameroonian' => 'Camerounaise',
        'canadian' => 'Canadienne',
        'cape_verdean' => 'Cap-verdienne',
        'central_african' => 'Centrafricaine',
        'chadian' => 'Tchadienne',
        'chilean' => 'Chilienne',
        'chinese' => 'Chinoise',
        'colombian' => 'Colombienne',
        'comorian' => 'Comorienne',
        'congolese' => 'Congolaise',
        'costa_rican' => 'Costaricienne',
        'croatian' => 'Croate',
        'cuban' => 'Cubaine',
        'cypriot' => 'Chypriote',
        'czech' => 'Tchèque',
        'danish' => 'Danoise',
        'djiboutian' => 'Djiboutienne',
        'dominican' => 'Dominicaine',
        'dutch' => 'Néerlandaise',
        'east_timorese' => 'Est-timoraise',
        'ecuadorian' => 'Équatorienne',
        'egyptian' => 'Égyptienne',
        'emirati' => 'Émirienne',
        'equatorial_guinean' => 'Équato-guinéenne',
        'eritrean' => 'Érythréenne',
        'estonian' => 'Estonienne',
        'ethiopian' => 'Éthiopienne',
        'fijian' => 'Fidjienne',
        'filipino' => 'Philippine',
        'finnish' => 'Finlandaise',
        'french' => 'Française',
        'gabonese' => 'Gabonaise',
        'gambian' => 'Gambienne',
        'georgian' => 'Géorgienne',
        'german' => 'Allemande',
        'ghanaian' => 'Ghanéenne',
        'greek' => 'Grecque',
        'grenadian' => 'Grenadienne',
        'guatemalan' => 'Guatémaltèque',
        'guinean' => 'Guinéenne',
        'guinea_bissauan' => 'Bissau-guinéenne',
        'guyanese' => 'Guyanienne',
        'haitian' => 'Haïtienne',
        'honduran' => 'Hondurienne',
        'hungarian' => 'Hongroise',
        'icelandic' => 'Islandaise',
        'indian' => 'Indienne',
        'indonesian' => 'Indonésienne',
        'iranian' => 'Iranienne',
        'iraqi' => 'Irakienne',
        'irish' => 'Irlandaise',
        'israeli' => 'Israélienne',
        'italian' => 'Italienne',
        'ivorian' => 'Ivoirienne',
        'jamaican' => 'Jamaïcaine',
        'japanese' => 'Japonaise',
        'jordanian' => 'Jordanienne',
        'kazakh' => 'Kazakhstanaise',
        'kenyan' => 'Kényane',
        'kiribati' => 'Kiribatienne',
        'korean' => 'Coréenne',
        'kosovar' => 'Kosovare',
        'kuwaiti' => 'Koweïtienne',
        'kyrgyz' => 'Kirghize',
        'laotian' => 'Laotienne',
        'latvian' => 'Lettone',
        'lebanese' => 'Libanaise',
        'liberian' => 'Libérienne',
        'libyan' => 'Libyenne',
        'liechtensteiner' => 'Liechtensteinoise',
        'lithuanian' => 'Lituanienne',
        'luxembourger' => 'Luxembourgeoise',
        'macedonian' => 'Macédonienne',
        'malagasy' => 'Malgache',
        'malawian' => 'Malawienne',
        'malaysian' => 'Malaisienne',
        'maldivian' => 'Maldivienne',
        'malian' => 'Malienne',
        'maltese' => 'Maltaise',
        'marshallese' => 'Marshallaise',
        'mauritanian' => 'Mauritanienne',
        'mauritian' => 'Mauricienne',
        'mexican' => 'Mexicaine',
        'micronesian' => 'Micronésienne',
        'moldovan' => 'Moldave',
        'monacan' => 'Monégasque',
        'mongolian' => 'Mongole',
        'montenegrin' => 'Monténégrine',
        'moroccan' => 'Marocaine',
        'mozambican' => 'Mozambicaine',
        'namibian' => 'Namibienne',
        'nauruan' => 'Nauruane',
        'nepalese' => 'Népalaise',
        'new_zealander' => 'Néo-zélandaise',
        'nicaraguan' => 'Nicaraguayenne',
        'nigerien' => 'Nigérienne',
        'nigerian' => 'Nigériane',
        'north_korean' => 'Nord-coréenne',
        'norwegian' => 'Norvégienne',
        'omani' => 'Omanaise',
        'pakistani' => 'Pakistanaise',
        'palauan' => 'Palauane',
        'palestinian' => 'Palestinienne',
        'panamanian' => 'Panaméenne',
        'papua_new_guinean' => 'Papouasienne',
        'paraguayan' => 'Paraguayenne',
        'peruvian' => 'Péruvienne',
        'polish' => 'Polonaise',
        'portuguese' => 'Portugaise',
        'qatari' => 'Qatarienne',
        'romanian' => 'Roumaine',
        'russian' => 'Russe',
        'rwandan' => 'Rwandaise',
        'saint_lucian' => 'Saint-lucienne',
        'salvadoran' => 'Salvadorienne',
        'samoan' => 'Samoane',
        'sao_tomean' => 'Santoméenne',
        'saudi' => 'Saoudienne',
        'scottish' => 'Écossaise',
        'senegalese' => 'Sénégalaise',
        'serbian' => 'Serbe',
        'seychellois' => 'Seychelloise',
        'sierra_leonean' => 'Sierra-léonaise',
        'singaporean' => 'Singapourienne',
        'slovak' => 'Slovaque',
        'slovenian' => 'Slovène',
        'solomon_islander' => 'Salomonienne',
        'somali' => 'Somalienne',
        'south_african' => 'Sud-africaine',
        'south_korean' => 'Sud-coréenne',
        'spanish' => 'Espagnole',
        'sri_lankan' => 'Sri-lankaise',
        'sudanese' => 'Soudanaise',
        'surinamese' => 'Surinamaise',
        'swazi' => 'Swazie',
        'swedish' => 'Suédoise',
        'swiss' => 'Suisse',
        'syrian' => 'Syrienne',
        'taiwanese' => 'Taïwanaise',
        'tajik' => 'Tadjike',
        'tanzanian' => 'Tanzanienne',
        'thai' => 'Thaïlandaise',
        'togolese' => 'Togolaise',
        'tongan' => 'Tongienne',
        'trinidadian' => 'Trinidadienne',
        'tunisian' => 'Tunisienne',
        'turkish' => 'Turque',
        'tuvaluan' => 'Tuvaluane',
        'ugandan' => 'Ougandaise',
        'ukrainian' => 'Ukrainienne',
        'uruguayan' => 'Uruguayenne',
        'uzbek' => 'Ouzbèke',
        'vanuatuan' => 'Vanuataise',
        'venezuelan' => 'Vénézuélienne',
        'vietnamese' => 'Vietnamienne',
        'welsh' => 'Galloise',
        'yemeni' => 'Yéménite',
        'zambian' => 'Zambienne',
        'zimbabwean' => 'Zimbabwéenne',
    );
    if (!empty($nametype)) {
        $value_text = "";
        foreach ($types_values_faqs as $value => $display_text) {
            if ($nametype == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types_values_faqs;
    }
}
function getLanguages($name = null)
{
    $pages_values = array(
        'EN' => 'Anglais',
        'FR' => 'Français',
        'SW' => 'Swahili',
        'LI' => 'Lingala',
        'KI' => 'Kikongo',
        'TS' => 'Tshiluba',
        'ES' => 'Espagnol',
        'DE' => 'Allemand',
        'IT' => 'Italien',
        'PT' => 'Portugais',
        'RU' => 'Russe',
        'ZH' => 'Chinois',
        'JA' => 'Japonais',
        'AR' => 'Arabe',
        'KO' => 'Coréen',
        'NL' => 'Néerlandais',
        'SV' => 'Suédois',
        'DA' => 'Danois',
        'NO' => 'Norvégien',
        'FI' => 'Finnois',
        'PL' => 'Polonais',
        'TR' => 'Turc',
        'TH' => 'Thaïlandais',
        'VI' => 'Vietnamien',
        'HI' => 'Hindi',
        'BN' => 'Bengali',
        'UR' => 'Ourdou',
        'TL' => 'Tagalog',
        'EL' => 'Grec',
        'HE' => 'Hébreu',
        'CS' => 'Tchèque',
        'HU' => 'Hongrois',
        'RO' => 'Roumain',
        'SK' => 'Slovaque',
        'BG' => 'Bulgare',
        'HR' => 'Croate',
        'SL' => 'Slovène',
        'LT' => 'Lituanien',

    );
    if (!empty($name)) {
        $value_text = "";
        foreach ($pages_values as $value => $display_text) {
            if ($name == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $pages_values;
    }
}
function getGenders($type = null)
{
    $types = array(
        'homme' => 'Homme',
        'femme' => 'Femme',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}

function getWorkerTypes($type = null)
{
    $types = array(
        'employees' => 'Employé',
        'expatriates' => 'Expatrié',
        'consultant' => 'Consultant',
        'daily' => 'Journalier',
        'trainees' => 'Stagiaire',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}

function getSalaryTypes($type = null)
{
    //Salaire brut / net / imposable / plafondé
    $types = array(
        'brut' => 'Salaire brut',
        'net' => 'Salaire net',
        'imposable' => 'Salaire imposable',
        'ceilinged' => 'Salaire plafonné',
        'indemnite' => 'Indemnité',
        'prime' => 'Prime',
        'bonus' => 'Bonus',
        'deduction' => 'Déduction',
        'contribution' => 'Contribution',
        'remuneration' => 'Rémunération',
        'compensation' => 'Compensation',
        'allowance' => 'Allocation familiale',
        'commission' => 'Commission',
        'gratuity' => 'Gratification',
        'reimbursement' => 'Remboursement',
        'overtime' => 'Heures supplémentaires',
        'holiday' => 'Congés payés',
        'severance' => 'Indemnité de licenciement',
        'pension' => 'Pension de retraite',
        'health' => 'Assurance santé',
        'transport' => 'Indemnité de transport',
        'meal' => 'Indemnité de repas',
        'housing' => 'Indemnité de logement',
        'education' => 'Indemnité d\'éducation',
        'miscellaneous' => 'Divers',
        'other' => 'Autre',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}
// Statuts de la situation matrimoniale - Etat civil
function getMaritalStatus($status = null)
{
    $status_values = array(
        'single' => 'Célibataire',  //célibataire
        'married' => 'Marié(e)', //marié
        'divorced' => 'Divorcé(e)', //divorcé
        'veuf' => 'Veuf', //veuf
        'veuve' => 'Veuve', //Veuve
    );
    if (!empty($status)) {
        $value_text = "";
        foreach ($status_values as $value => $display_text) {
            if ($status == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $status_values;
    }
}
function monthlySalaryTypes($type = null)
{
    //Salaire mensuel / hebdomadaire / journalier
    $types = array(
        'monthly' => 'Salaire mensuel',
        'weekly' => 'Salaire hebdomadaire',
        'daily' => 'Salaire journalier',
        'hourly' => 'Salaire horaire',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}
function monthYearly($type = null)
{

    $types = array(
        '1' => 'Janvier',
        '2' => 'Février',
        '3' => 'Mars',
        '4' => 'Avril',
        '5' => 'Mai',
        '6' => 'Juin',
        '7' => 'Juillet',
        '8' => 'Août',
        '9' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}
function calculRetenues($salaireBrut, $type = null)
{
    // Taux de cotisations salariales
    $tauxINSS = 0.05;  // 5% salarié
    $tauxONEM = 0.002;  // 0.2% salarié
    $tauxINPP = 0.02;  // 2%
    // Taux employeur (si tu veux afficher plus tard)
    $tauxINSS_employeur = 0.013; // 13%


    // Cotisations sociales
    $retenueINSS = $salaireBrut * $tauxINSS;
    $retenueONEM = $salaireBrut * $tauxONEM;

    // Revenu imposable avant IPR
    $revenuImposable = $salaireBrut - $retenueINSS;



    // Total des retenues salarié
    $totalRetenues = $retenueINSS + $retenueONEM;

    // Salaire net à payer
    $salaireNet = $salaireBrut - $totalRetenues;
    if ($type == 'inss_salarie') {
        return round($retenueINSS, 2);
    } elseif ($type == 'onem') {
        return round($retenueONEM, 2);
    } elseif ($type == 'salaire_net') {
        return round($revenuImposable, 2);
    } elseif ($type == 'salaire_brut') {
        return round($salaireNet, 2);
    } elseif ($type == 'total_retenues') {
        return round($totalRetenues, 2);
    } elseif ($type == 'revenu_imposable') {
        return round($revenuImposable, 2);
    } elseif ($type == 'inpp') {

        // Retourne un tableau avec toutes les valeurs
        return round($salaireBrut * $tauxINPP, 2);
    } else {
        // Employeur (optionnel si tu veux afficher)
        return round($salaireBrut * $tauxINSS_employeur, 2);
    }
}

function calculateTax($base_taxable = 0, $company_currency = 'usd', $exchange_currency = 0)
{
    // Exemple de données d'entrée (à ajuster selon votre cas)
    /*$categories = [
        'TrB' => 2000, // Montant total
        'QPO' => 500,  // Montant exonéré ou autre
    ];*/

    // Calcul du montant taxable
    //$base_taxable = $categories['TrB'] - $categories['QPO'];

    if ($base_taxable == 0) {
        $base_taxable = 60; // Valeur par défaut si aucune donnée n'est fournie
    } else {
        // Tranches de valeurs // Valeur en USD pour la tranche de 3%
        $tranche_03 = ($company_currency == 'usd') ? 60 : floatval(60 * $exchange_currency);
        // Valeur en USD pour la tranche de 15%
        $tranche_15 = ($company_currency == 'usd') ? 666.67 : floatval(666.67 * $exchange_currency);
        $tranche_30 = ($company_currency == 'usd') ? 1333.33 : floatval(1333.33 * $exchange_currency);
        $tranche_40 = $tranche_30 + 1;

        // Initialisation des variables d'écart
        $ecart_03 = 0;
        $ecart_15 = 0;
        $ecart_30 = 0;
        $ecart_40 = 0;

        // Calcul des écarts en fonction de la tranche
        if ($base_taxable >= $tranche_15 && $base_taxable < $tranche_30) {
            $ecart_03 = $tranche_03;
            $ecart_15 = $tranche_15 - ($tranche_03 + 1);
            $ecart_30 = $base_taxable - ($ecart_03 + $ecart_15);
            $ecart_40 = 0;
        } elseif ($base_taxable > $tranche_30 && $base_taxable < $tranche_40) {
            $ecart_03 = $tranche_03;
            $ecart_15 = ($base_taxable - $ecart_03 > $tranche_03 && $base_taxable - $ecart_03 <= $tranche_15) ? $base_taxable - $ecart_03 : ($tranche_15 - $tranche_03 + 1);
            $ecart_30 = ($base_taxable - $ecart_03 - $ecart_15 > $tranche_15 && $base_taxable - $ecart_03 - $ecart_15 <= $tranche_30) ? $base_taxable - ($ecart_03 + $ecart_15) : 0;
            $ecart_40 = ($base_taxable - $ecart_03 - $ecart_15 - $ecart_30 > $tranche_30) ? $base_taxable - ($ecart_03 + $ecart_15 + $ecart_30) : 0;
        } elseif ($base_taxable > $tranche_30) {
            $ecart_03 = $tranche_03;
            $ecart_15 = ($base_taxable - $ecart_03 > $tranche_03 && $base_taxable - $ecart_03 <= $tranche_15) ? $base_taxable - $ecart_03 : ($tranche_15 - $tranche_03 + 1);
            $ecart_30 = ($base_taxable - $ecart_03 - $ecart_15 > $tranche_15 && $base_taxable - $ecart_03 - $ecart_15 <= $tranche_30) ? $base_taxable - ($ecart_03 + $ecart_15) : 0;
            $ecart_40 = ($base_taxable - $ecart_03 - $ecart_15 - $ecart_30 > $tranche_30) ? $base_taxable - ($ecart_03 + $ecart_15 + $ecart_30) : 0;
        } else {
            $ecart_03 = $tranche_03;
            $ecart_15 = $base_taxable - $ecart_03;
            $ecart_30 = 0;
            $ecart_40 = 0;
        }

        // Calcul des impôts pour chaque tranche
        $ipr_03 = ($ecart_03 * 3) / 100;
        $ipr_15 = ($ecart_15 * 15) / 100;
        $ipr_30 = ($ecart_30 * 30) / 100;
        $ipr_40 = ($ecart_40 * 40) / 100;

        // Calcul du résultat final
        $result = $ipr_03 + $ipr_15 + $ipr_30 + $ipr_40;

        // Retourner ou afficher le résultat
        return number_format($result, 2, '.', '');
    }
}
function getTaxTypes($type = null)
{
    // Types de taxes
    $types = array(
        'ip' => 'Impôt sur le revenu',
        'vat' => 'Taxe sur la valeur ajoutée',
        'customs' => 'Droits de douane',
        'excise' => 'Droits d\'accise',
        'property' => 'Taxe foncière',
        'income' => 'Impôt sur le revenu des personnes physiques',
        'corporate' => 'Impôt sur les sociétés',
        'capital_gains' => 'Impôt sur les plus-values',
        'inheritance' => 'Droits de succession',
        'gift' => 'Droits de donation',
    );
    if (!empty($type)) {
        $value_text = "";
        foreach ($types as $value => $display_text) {
            if ($type == $value) {
                $value_text = $display_text;
            }
        }
        return $value_text;
    } else {
        return $types;
    }
}

function countAttendanceStatus($data, $status, $hours = 0)
{
    $count = 0;
    $counthours = 0;
    foreach ($data as $record) {
        if (($hours == 1) && ($record['attendance_status'] == $status)) {
            $counthours += $record['attendance_hours'];
        } else {
            if ($record['attendance_status'] == $status) {

                $count++;
            }
        }
    }
    $count_result = ($hours == 1) ? $counthours : $count;
    return $count_result;
}
function setStudentSchoolIdentification($student_data=null)
{
    /*$school = session()->get('schoolname');
    $aleatoire_value = "0123456789";
    $new_code_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 10))), 0, 3);

    return substr($school, 0, 1) . "ID" . date("y") . $new_code_generate;
    */
    $last_student_code = (isset($student_data) && !empty($student_data)) ? $student_data['student_code'] : '';
    $last_student_number = preg_replace('/\D/', '', $last_student_code);
    $school_init_identify = session()->has('schoolinit') ? session()->get('schoolinit') : '';
    $student_code_start =  substr(session()->get('yearstarted'), 2);
    $student_code_end =  substr(session()->get('yearclosing'), 2);
    $student_code =  $student_code_start . $student_code_end . '01';
    $new_student_code = (!empty($last_student_number)) ? $last_student_number + 1 : $student_code;
    $valid_student_code = $school_init_identify . $new_student_code;

    return $valid_student_code;
}