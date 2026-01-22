<?php
namespace Controllers;
use League\Plates\Engine;
use Models\PersonnageDAO;
use Models\Personnage;
use Models\OriginDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Services\PersonnageService;
<<<<<<< HEAD
use Services\Logger;
use Helpers\Flash;
use Helpers\Message as HMessage;

/**
 * MainController
 * Ce contrôleur gère la logique principale de l'application, soit le rendu des vues,
 * gérer les sessions utilisateurs, et traiter les demandes liées aux personnages, origines,
 * éléments et classes d'unités.
 */
=======
use Models\Message;
use Services\Logger;


>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

class MainController
{
    private Engine $templates;
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');  
    }
    
    public function home(?string $message = null): void
    {
        $service = new PersonnageService();
        $listPersonnage = $service->getAll();

<<<<<<< HEAD
        $ownedIds = [];
        if (\Services\AuthService::isLogged()) {
            $userId = (string)($_SESSION['user']['id'] ?? '');
            if ($userId !== '') {
                $ownedIds = (new \Models\UserPersonnageDAO())->getPersoIds($userId);
            }
        }

        echo $this->templates->render('home', [
            'gameName' => 'Mario Wiki - Home',
            'listPersonnage' => $listPersonnage,
            'message' => $message,
            'ownedIds' => $ownedIds,
        ]);
    }

    /* Affiche la collection de personnages possédés par l'utilisateur connecté 
    * @param string|null $message Message optionnelle à afficher sur la page
    * @return void
    */

    public function myCollection(?string $message = null): void
    {
        $userId = (string)($_SESSION['user']['id'] ?? '');
        if ($userId === '') {
            header('Location: index.php?action=login&error=' . urlencode('Connexion requise.'));
            exit;
        }

        $userPersoDao = new \Models\UserPersonnageDAO();
        $ownedIds = $userPersoDao->getPersoIds($userId);

        $persos = [];
        $persoDao = new \Models\PersonnageDAO();
        foreach ($ownedIds as $pid) {
            $p = $persoDao->getById((int)$pid);
            if ($p !== null) {
                $persos[] = $p;
            }
        }

        echo $this->templates->render('my-collection', [
            'gameName' => 'Ma collection',
            'listPersonnage' => $persos,
            'message' => $message,
            'ownedIds' => $ownedIds,
        ]);
    }

    /* Affiche une page protégée avec des statistiques utilisateur
    * @return void
    */

    public function protectedPage(): void
    {
        $user = $_SESSION['user'] ?? null;
        $userId = (string)($user['id'] ?? '');

        $stats = [
            'totalPersos' => 0,
            'ownedPersos' => 0,
            'completion'  => 0,
            'origins'     => 0,
            'elements'    => 0,
            'unitClasses' => 0,
            'sessionLeft' => 0,
        ];

        try {
            $persoDao = new \Models\PersonnageDAO();
            $originDao = new \Models\OriginDAO();
            $elementDao = new \Models\ElementDAO();
            $unitClassDao = new \Models\UnitClassDAO();
            $userPersoDao = new \Models\UserPersonnageDAO();

            $stats['totalPersos'] = $persoDao->countAll();
            $stats['origins']     = $originDao->countAll();
            $stats['elements']    = $elementDao->countAll();
            $stats['unitClasses'] = $unitClassDao->countAll();

            if ($userId !== '') {
                $stats['ownedPersos'] = $userPersoDao->countForUser($userId);
            }

            if ($stats['totalPersos'] > 0) {
                $stats['completion'] = (int)round(($stats['ownedPersos'] / $stats['totalPersos']) * 100);
            }

            $timeout = (int)($_SESSION['timeout'] ?? 0);
            $stats['sessionLeft'] = max(0, (int)ceil(($timeout - time()) / 60));

        } catch (\Throwable $e) {
            
        }

        echo $this->templates->render('protected', [
            'user'  => $user,
            'stats' => $stats,
        ]);
    }

    /* Affiche une page d'erreur personnalisée
    * @param int $code Code d'erreur HTTP (par défaut 500)
    * @param string $details Détails supplémentaires sur l'erreur
    * @return void
    */

    public function error(int $code = 500, string $details = ''): void
    {
        echo $this->templates->render('error', [
            'code' => $code,
            'message' => $details !== '' ? $details : 'Une erreur est survenue.',
            'title' => 'Erreur'
        ]);
    }

    /* Redirige vers la page d'accueil avec un message optionnel
    * @param string|null $message Message à afficher sur la page d'accueil
    * @return void
    */

=======
        echo $this->templates->render('home', [
            'gameName' => 'Mario Wiki - Home',
            'listPersonnage' => $listPersonnage,
            'message' => $message
        ]);
    }

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function index(?string $message = null): void
    {
        $this->home($message);
    }

<<<<<<< HEAD
    /* Lit le contenu d'un fichier de log
    * @param string $file Nom du fichier de log à lire
    * @return string Contenu du fichier de log
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public static function readFile(string $file): string
    {
        return self::read($file);
    }

<<<<<<< HEAD
    /* Ajoute un nouveau personnage à la base de données
    * @param array $params Données du formulaire d'ajout de personnage
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function addPerso(array $params): void
    {
        // 1. Sécurité minimale
        if (
            empty($params['name']) ||
            empty($params['origin']) ||
            empty($params['metier']) ||
            empty($params['elements'])
        ) {
<<<<<<< HEAD
            Flash::setFromString('Champs manquants.', HMessage::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=add-perso');
            exit;
=======
            $message = new Message(
            'Erreur',
            'Champs manquants',
            'error'
        );

        echo $this->templates->render('message', [
            'message' => $message
        ]);
        return; 
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
        }

        // 2. Création du personnage
        $perso = new \Models\Personnage();
        $perso->setName($params['name']);
        $perso->setOriginId((int)$params['origin']);
        $perso->setUnitClassId((int)$params['metier']);
        $perso->setRarity((int)($params['rarity'] ?? 0));
        $perso->setImage($params['image'] ?? null);

        $dao = new \Models\PersonnageDAO();

        // 3. Insertion personnage → récupération ID
        $personnageId = $dao->create($perso);

        // 4. Liaison personnage ↔ éléments (MANY TO MANY)
        foreach ($params['elements'] as $elementId) {
            $dao->addElement($personnageId, (int)$elementId);
        }

        // 5. Retour visuel
<<<<<<< HEAD
        Flash::setFromString('Personnage ajouté avec succès.', HMessage::COLOR_SUCCESS, 'Succès');
        header('Location: index.php?action=home');
        exit;
    }

    /* Supprime un personnage de la base de données
    * @param string|null $id ID du personnage à supprimer
    * @return void
    */
=======
        $message = new Message(
            'Succès',
            'Personnage ajouté avec succès',
            'success'
        );
        echo $this->templates->render('message', [
            'message' => $message
        ]);
    }



>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function deletePerso(?string $id): void
    {
        if ($id === null) {
            $this->index();
            return;
        }

        try {
            $dao = new PersonnageDAO();
            $dao->delete($id);

            Logger::write('DELETE', 'personnage', true, 'id=' . $id);

            $this->index('Personnage supprimé avec succès');

        } catch (\Throwable $e) {
            Logger::write('DELETE', 'personnage', false, $e->getMessage());
            $this->index('Erreur suppression: ' . $e->getMessage());
        }
    }

<<<<<<< HEAD
    /* Affiche le formulaire d'ajout/édition de personnage
    * @param \Models\Personnage|null $perso Personnage à éditer (null pour ajout)
    * @param int|null $selectedElementId ID de l'élément à pré-sélectionner
    * @return void
    */
=======

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function displayAddPerso(?\Models\Personnage $perso = null, ?int $selectedElementId = null): void
    {
        $originDao = new \Models\OriginDAO();
        $elementDao = new \Models\ElementDAO();
        $unitClassDao = new \Models\UnitClassDAO();

        echo $this->templates->render('add-perso', [
            'origins'           => $originDao->getAll(),
            'elements'          => $elementDao->getAll(),
            'unitclasses'       => $unitClassDao->getAll(),
<<<<<<< HEAD
            'perso'             => $perso,               
            'selectedElementId' => $selectedElementId,   
        ]);
    }

    /* Affiche le formulaire d'édition de personnage
    * @param int $id ID du personnage à éditer
    * @return void
    */

=======
            'perso'             => $perso,               // null = ajout, sinon = édition
            'selectedElementId' => $selectedElementId,   // pour pré-sélectionner l’élément
        ]);
    }

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function displayEditPerso(int $id): void
    {
        $dao = new PersonnageDAO();
        $perso = $dao->getById((string)$id);

        if ($perso === null) {
            $this->index("Personnage introuvable");
            return;
        }

<<<<<<< HEAD
        $elementId = $dao->getElementIdsByPersonnage($id);
=======
        // récup l'élément lié (pour pré-sélection)
        $elementId = $dao->getElementIdByPersoId($id);
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

        $originDao = new OriginDAO();
        $elementDao = new ElementDAO();
        $unitClassDao = new UnitClassDAO();

        echo $this->templates->render('add-perso', [
            'origins'           => $originDao->getAll(),
            'elements'          => $elementDao->getAll(),
            'unitclasses'       => $unitClassDao->getAll(),
            'perso'             => $perso,
            'selectedElementId' => $elementId
        ]);
    }

<<<<<<< HEAD
    /* Affiche la page de détails d'un personnage
    * @param int $id ID du personnage à afficher
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function displayShowPerso(int $id): void
    {
        $persoDao     = new \Models\PersonnageDAO();
        $originDao    = new \Models\OriginDAO();
        $unitClassDao = new \Models\UnitClassDAO();
        $elementDao   = new \Models\ElementDAO();

        // 1. Récupération du personnage
        $personnage = $persoDao->getById($id);

        if (!$personnage) {
            header('Location: index.php?action=home&message=Personnage introuvable');
            exit;
        }

        // 2. Origine (objet complet ou null)
        $origin = null;
        if ($personnage->getOriginId() !== null) {
            $origin = $originDao->getById($personnage->getOriginId());
        }

        // 3. Classe (objet complet ou null)
        $unitClass = null;
        if ($personnage->getUnitClassId() !== null) {
            $unitClass = $unitClassDao->getById($personnage->getUnitClassId());
        }

        // 4. Éléments (TOUJOURS un tableau)
        $elements = $elementDao->getByPersonnageId($id);
        $personnage->setElements($elements ?? []);

        // 5. Rendu
<<<<<<< HEAD
        $isOwned = false;
        if (\Services\AuthService::isLogged()) {
            $userId = (string)($_SESSION['user']['id'] ?? '');
            if ($userId !== '') {
                $isOwned = (new \Models\UserPersonnageDAO())->hasPerso($userId, (int)$personnage->getId());
            }
        }

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
        echo $this->templates->render('show-perso', [
            'personnage' => $personnage,
            'origin'     => $origin,
            'unitClass'  => $unitClass,
<<<<<<< HEAD
            'isOwned'    => $isOwned,
        ]);
    }

    /* Affiche le formulaire d'ajout d'un élément
    * @return void
    */
=======
        ]);
    }


>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function addPersoElement(): void
    {
        echo $this->templates->render('add-perso-element', [
            'title' => 'Ajouter un élément'
        ]);
    }

<<<<<<< HEAD
    /* Affiche les logs de l'application
    * @param array $params Paramètres de la requête (fichier sélectionné)
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function logs(array $params = []): void
    {
        $files = Logger::listFiles();

        // Choix du fichier
        $selected = $params['file'] ?? null;

        // Par défaut: le plus récent
        if ($selected === null && !empty($files)) {
            $selected = $files[0]['file'];
        }

        $content = '';
        if ($selected !== null) {
            $content = Logger::read($selected);
        }

        echo $this->templates->render('logs', [
            'files'    => $files,
            'selected' => $selected,
            'content'  => $content
        ]);
    }
<<<<<<< HEAD
    
    /* Gère la connexion utilisateur
    * @return void
    */

    public function login(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                Flash::setFromString('Champs obligatoires.', HMessage::COLOR_ERROR, 'Erreur');
                header('Location: index.php?action=login');
                exit;
            }

            if (\Services\AuthService::login($username, $password)) {
                Flash::setFromString('Connexion réussie.', HMessage::COLOR_SUCCESS, 'Succès');
                header('Location: index.php?action=home');
                exit;
            }

            Flash::setFromString('Identifiants invalides.', HMessage::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=login');
            exit;
        }

        echo $this->templates->render('login', [
            'error' => $error
        ]);
    }

    /* Gère la déconnexion utilisateur
    * @return void
    */

    public function logout(): void
    {
        \Services\AuthService::logout();
        Flash::setFromString('Déconnexion réussie.', HMessage::COLOR_SUCCESS, 'OK');
        header('Location: index.php?action=home');
        exit;
    }

    /* Rend une vue avec des données
    * @param string $view Nom de la vue à rendre
    * @param array $data Données à passer à la vue
    * @return void
    */

    private function render(string $view, array $data = []): void
    {
        echo $this->templates->render($view, $data);
    }

    /* Affiche le formulaire d'inscription
    * @return void
    */

    public function registerForm(): void
    {
        // si déjà connecté
        if (!empty($_SESSION['userUID'])) {
            \Helpers\Flash::setFromString('Déjà connecté.', \Helpers\Message::COLOR_INFO, 'Info');
            header('Location: index.php?action=home');
            exit;
        }

        $this->render('register', [
            'title' => 'Créer un compte',
            'message' => \Helpers\Flash::get()
        ]);
    }

    /* Gère l'inscription utilisateur
    * @param array $post Données du formulaire d'inscription
    * @return void
    */

    public function register(array $post): void
    {
        if (!empty($_SESSION['userUID'])) {
            \Helpers\Flash::setFromString('Déjà connecté.', \Helpers\Message::COLOR_INFO, 'Info');
            header('Location: index.php?action=home');
            exit;
        }

        $username = trim($post['username'] ?? '');
        $password = (string)($post['password'] ?? '');
        $confirm  = (string)($post['confirm'] ?? '');

        if ($username === '' || $password === '' || $confirm === '') {
            \Helpers\Flash::setFromString('Champs manquants.', \Helpers\Message::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=register');
            exit;
        }

        if (strlen($username) < 3) {
            \Helpers\Flash::setFromString('Username trop court (min 3).', \Helpers\Message::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=register');
            exit;
        }

        if ($password !== $confirm) {
            \Helpers\Flash::setFromString('Les mots de passe ne correspondent pas.', \Helpers\Message::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=register');
            exit;
        }

        if (strlen($password) < 6) {
            \Helpers\Flash::setFromString('Mot de passe trop court (min 6).', \Helpers\Message::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=register');
            exit;
        }

        $dao = new \Models\UserDAO();

        if ($dao->existsByUsername($username)) {
            \Helpers\Flash::setFromString('Ce username est déjà pris.', \Helpers\Message::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=register');
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $dao->create($username, $hash);

        \Helpers\Flash::setFromString('Compte créé. Tu peux te connecter.', \Helpers\Message::COLOR_SUCCESS, 'OK');
        header('Location: index.php?action=login');
        exit;
    }

    /* Gère l'ajout d'une nouvelle origine
    * @param array $params Données du formulaire d'ajout d'origine
    * @return void
    */
=======

    public function login(): void
    {
        echo $this->templates->render('login');
    }

    public function displayAddOrigin(?\Models\Origin $origin = null, ?Message $message = null): void
    {
        $dao = new \Models\OriginDAO();

        echo $this->templates->render('add-origin', [
            'origin'  => $origin,          // null = ajout, sinon édition
            'origins' => $dao->getAll(),   // LISTE pour "Existing origins"
            'message' => $message
        ]);
    }


>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function addOrigin(array $params): void
    {
        $name = trim($params['name'] ?? '');
        $url  = trim($params['url_img'] ?? '');

        try {
            if ($name === '' || $url === '') {
                Logger::write('CREATE', 'origin', false, 'validation failed');
<<<<<<< HEAD
                Flash::setFromString('Tous les champs sont obligatoires.', HMessage::COLOR_ERROR, 'Erreur');
                header('Location: index.php?action=add-origin');
=======
                header('Location: index.php?action=add-origin&msg=invalid');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
                exit;
            }

            $origin = new \Models\Origin();
            $origin->setName($name);
            $origin->setUrlImg($url);

            (new \Models\OriginDAO())->create($origin);

            Logger::write('CREATE', 'origin', true, "name={$name}");

<<<<<<< HEAD
            Flash::setFromString('Origine ajoutée.', HMessage::COLOR_SUCCESS, 'Succès');
            header('Location: index.php?action=add-origin');
=======
            header('Location: index.php?action=add-origin&msg=created');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            exit;

        } catch (\Throwable $e) {
            Logger::write('CREATE', 'origin', false, $e->getMessage());
<<<<<<< HEAD
            Flash::setFromString('Erreur lors de la création.', HMessage::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=add-origin');
=======
            header('Location: index.php?action=add-origin&msg=error');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            exit;
        }
    }

<<<<<<< HEAD
    /* Gère l'ajout d'un nouvel élément
    * @param array $params Données du formulaire d'ajout d'élément
    * @return void
    */
=======

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function displayAddElement(?\Models\Element $element = null, ?Message $message = null): void
    {
        $dao = new \Models\ElementDAO();

        echo $this->templates->render('add-element', [
            'element'  => $element,
            'elements' => $dao->getAll(),
            'message'  => $message
        ]);
    }

<<<<<<< HEAD
    /* Gère l'ajout d'un nouvel élément
    * @param array $params Données du formulaire d'ajout d'élément
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function addElement(array $params): void
    {
        $name = trim($params['name'] ?? '');
        $url  = trim($params['url_img'] ?? '');

        try {
            if ($name === '' || $url === '') {
                Logger::write('CREATE', 'element', false, 'validation failed');
<<<<<<< HEAD
                Flash::setFromString('Tous les champs sont obligatoires.', HMessage::COLOR_ERROR, 'Erreur');
                header('Location: index.php?action=add-element');
=======
                header('Location: index.php?action=add-element&msg=invalid');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
                exit;
            }

            $element = new \Models\Element();
            $element->setName($name);
            $element->setUrlImg($url);

            (new \Models\ElementDAO())->create($element);

            Logger::write('CREATE', 'element', true, "name={$name}");

<<<<<<< HEAD
            Flash::setFromString('Élément ajouté.', HMessage::COLOR_SUCCESS, 'Succès');
            header('Location: index.php?action=add-element');
=======
            header('Location: index.php?action=add-element&msg=created');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            exit;

        } catch (\Throwable $e) {
            Logger::write('CREATE', 'element', false, $e->getMessage());
<<<<<<< HEAD
            Flash::setFromString('Erreur lors de la création.', HMessage::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=add-element');
=======
            header('Location: index.php?action=add-element&msg=error');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            exit;
        }
    }

<<<<<<< HEAD
    /* Gère l'ajout d'une nouvelle classe d'unité
    * @param array $params Données du formulaire d'ajout de classe d'unité
    * @return void
    */
=======

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function displayAddUnitClass(?\Models\UnitClass $unitClass = null, ?Message $message = null): void
    {
        $dao = new \Models\UnitClassDAO();

        echo $this->templates->render('add-unitclass', [
            'unitclass'   => $unitClass,
            'unitclasses' => $dao->getAll(),
            'message'     => $message
        ]);
    }

<<<<<<< HEAD
    /* Gère l'ajout d'une nouvelle origine
    * @param array $params Données du formulaire d'ajout d'origine
    * @return void
    */

    public function displayAddOrigin(?\Models\Origin $origin = null, ?Message $message = null): void
    {
        $dao = new \Models\OriginDAO();

        echo $this->templates->render('add-origin', [
            'origin'   => $origin,
            'origins' => $dao->getAll(),
            'message'     => $message
        ]);
    }
    
    /* Gère l'ajout d'une nouvelle classe d'unité
    * @param array $params Données du formulaire d'ajout de classe d'unité
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function addUnitClass(array $params): void
    {
        $name = trim($params['name'] ?? '');
        $url  = trim($params['url_img'] ?? '');

        try {
            if ($name === '' || $url === '') {
                Logger::write('CREATE', 'unitclass', false, 'validation failed');
<<<<<<< HEAD
                Flash::setFromString('Tous les champs sont obligatoires.', HMessage::COLOR_ERROR, 'Erreur');
                header('Location: index.php?action=add-unitclass');
=======
                header('Location: index.php?action=add-unitclass&msg=invalid');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
                exit;
            }

            $unitClass = new \Models\UnitClass();
            $unitClass->setName($name);
            $unitClass->setUrlImg($url);

            (new \Models\UnitClassDAO())->create($unitClass);

            Logger::write('CREATE', 'unitclass', true, "name={$name}");

<<<<<<< HEAD
            Flash::setFromString('Classe ajoutée.', HMessage::COLOR_SUCCESS, 'Succès');
            header('Location: index.php?action=add-unitclass');
=======
            header('Location: index.php?action=add-unitclass&msg=created');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            exit;

        } catch (\Throwable $e) {
            Logger::write('CREATE', 'unitclass', false, $e->getMessage());
<<<<<<< HEAD
            Flash::setFromString('Erreur lors de la création.', HMessage::COLOR_ERROR, 'Erreur');
            header('Location: index.php?action=add-unitclass');
=======
            header('Location: index.php?action=add-unitclass&msg=error');
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            exit;
        }
    }

<<<<<<< HEAD
    /* Gère la sauvegarde (création ou mise à jour) d'un personnage
    * @param array $data Données du formulaire de personnage
    * @return void
    */
=======


>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function savePerso(array $data): void
    {
        $dao = new PersonnageDAO();

        $id        = isset($data['id']) && $data['id'] !== '' ? (int)$data['id'] : null;
        $name      = trim($data['name'] ?? '');
        $origin    = (int)($data['origin'] ?? 0);
        $unitclass = (int)($data['unitclass'] ?? 0);
        $rarity    = (int)($data['rarity'] ?? 0);
        $urlImg    = trim($data['url_img'] ?? '');

        // MULTI éléments
        $elements  = $data['elements'] ?? [];
        if (!is_array($elements)) $elements = [$elements];

<<<<<<< HEAD
        // Validations simples
        if ($name === '' || $origin <= 0 || $unitclass <= 0 || $rarity < 1 || $rarity > 6) {
=======
        // validations simples
        if ($name === '' || $origin <= 0 || $unitclass <= 0 || $rarity < 1 || $rarity > 6) {
            // log FAIL aussi (vu que c’est une action “CREATE/UPDATE” avortée)
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            Logger::write($id === null ? 'CREATE' : 'UPDATE', 'personnage', false, 'validation failed');
            $this->index("Champs invalides");
            return;
        }

        if ($urlImg === '') {
<<<<<<< HEAD
            $urlImg = null; // Permet de stocker NULL en base si pas d'image
=======
            $urlImg = null; // image optionnelle
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
        }

        $perso = new Personnage();
        $perso->setName($name);
        $perso->setOriginId($origin);
        $perso->setUnitClassId($unitclass);
        $perso->setRarity($rarity);
        $perso->setImage($urlImg);

        try {
<<<<<<< HEAD
=======
            // === INSERT ===
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            if ($id === null) {
                $newId = $dao->create($perso);
                $dao->setElements($newId, $elements);

                Logger::write('CREATE', 'personnage', true, "id={$newId} | name={$name}");
                $this->index("Personnage ajouté");
                return;
            }

<<<<<<< HEAD
=======
            // === UPDATE ===
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            $perso->setId($id);
            $dao->update($perso);
            $dao->setElements($id, $elements);

            Logger::write('UPDATE', 'personnage', true, "id={$id} | name={$name}");
            $this->index("Personnage modifié");
        } catch (\Throwable $e) {
            Logger::write($id === null ? 'CREATE' : 'UPDATE', 'personnage', false, $e->getMessage());
            $this->index("Erreur: " . $e->getMessage());
        }
    }

<<<<<<< HEAD
    /* Gestion de l'édition d'une origine
    * @param int $id ID de l'origine à éditer
    * @return void
    */

=======

    // ORIGIN DELET ET EDIT ----------------------------------
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function displayEditOrigin(int $id): void
    {
        $dao = new \Models\OriginDAO();
        $origin = $dao->getById($id);

        if (!$origin) {
            $this->index("Origin introuvable");
            return;
        }

        echo $this->templates->render('add-origin', [
            'origin' => $origin
        ]);
    }

<<<<<<< HEAD
    /* Gère la sauvegarde (création ou mise à jour) d'une origine
    * @param array $params Données du formulaire d'origine
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function saveOrigin(array $params): void
    {
        $dao = new \Models\OriginDAO();

        $origin = new \Models\Origin();
        if (!empty($params['id'])) {
            $origin->setId((int)$params['id']);
        }
        $origin->setName($params['name'] ?? '');
        $origin->setUrlImg($params['url_img'] ?? '');

        if ($origin->getId() !== null) {
            $dao->update($origin);
            $this->index("Origin modifiée");
        } else {
            $dao->create($origin);
            $this->index("Origin ajoutée");
        }
    }

<<<<<<< HEAD
    /* Gère la suppression d'une origine
    * @param int $id ID de l'origine à supprimer
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function deleteOrigin(int $id): void
    {
        $dao = new \Models\OriginDAO();

        if ($dao->isUsed($id)) {
            $this->index("Impossible: cette origin est utilisée par au moins un personnage");
            return;
        }

        $dao->delete($id);
        $this->index("Origin supprimée");
    }

<<<<<<< HEAD
    /* Gère l'édition d'une classe d'unité
    * @param int $id ID de la classe d'unité à éditer
    * @return void
    */

=======
    // CLASS DELET ET EDIT ----------------------------------
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function displayEditUnitClass(int $id): void
    {
        $dao = new \Models\UnitClassDAO();
        $unitClass = $dao->getById($id);

        if (!$unitClass) {
            $this->index("Classe introuvable");
            return;
        }

        echo $this->templates->render('add-unitclass', [
            'unitClass' => $unitClass
        ]);
    }
<<<<<<< HEAD
     
    /* Gère la sauvegarde (création ou mise à jour) d'une classe d'unité
    * @param array $params Données du formulaire de classe d'unité
    * @return void
    */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

    public function saveUnitClass(array $params): void
    {
        $dao = new \Models\UnitClassDAO();

        $u = new \Models\UnitClass();
        if (!empty($params['id'])) {
            $u->setId((int)$params['id']);
        }
        $u->setName($params['name'] ?? '');
        $u->setUrlImg($params['url_img'] ?? '');

        if ($u->getId() !== null) {
            $dao->update($u);
            $this->index("Classe modifiée");
        } else {
            $dao->create($u);
            $this->index("Classe ajoutée");
        }
    }

<<<<<<< HEAD
    /* Gère la suppression d'une classe d'unité
    * @param int $id ID de la classe d'unité à supprimer
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function deleteUnitClass(int $id): void
    {
        $dao = new \Models\UnitClassDAO();

        if ($dao->isUsed($id)) {
            $this->index("Impossible: cette classe est utilisée par au moins un personnage");
            return;
        }

        $dao->delete($id);
        $this->index("Classe supprimée");
    }
<<<<<<< HEAD

    /* Gère l'édition d'un élément
    * @param int $id ID de l'élément à éditer
    * @return void
    */

=======
    // ELEMENT DELET ET EDIT ----------------------------------
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function displayEditElement(int $id): void
    {
        $dao = new \Models\ElementDAO();
        $element = $dao->getById($id);

        if (!$element) {
            $this->index("Élément introuvable");
            return;
        }

        echo $this->templates->render('add-element', [
            'element' => $element
        ]);
    }

<<<<<<< HEAD
    /* Gère la sauvegarde (création ou mise à jour) d'un élément
    * @param array $params Données du formulaire d'élément
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function saveElement(array $params): void
    {
        $dao = new \Models\ElementDAO();

        $e = new \Models\Element();
        if (!empty($params['id'])) {
            $e->setId((int)$params['id']);
        }
        $e->setName($params['name'] ?? '');
        $e->setUrlImg($params['url_img'] ?? '');

        if ($e->getId() !== null) {
            $dao->update($e);
            $this->index("Élément modifié");
        } else {
            $dao->create($e);
            $this->index("Élément ajouté");
        }
    }

<<<<<<< HEAD
    /* Gère la suppression d'un élément
    * @param int $id ID de l'élément à supprimer
    * @return void
    */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function deleteElement(int $id): void
    {
        $dao = new \Models\ElementDAO();
        $dao->delete($id);
        $this->index("Élément supprimé");
    }

<<<<<<< HEAD
    /* Ajoute ou retire un personnage de la collection de l'utilisateur
    * @param int $persoId ID du personnage à ajouter/retirer
    * @return void
    */

    public function toggleCollection(int $persoId): void
    {
        $userId = (string)($_SESSION['user']['id'] ?? '');
        $back = $_SERVER['HTTP_REFERER'] ?? 'index.php?action=home';

        if ($userId === '' || $persoId <= 0) {
            Flash::setFromString('Paramètres invalides.', HMessage::COLOR_ERROR, 'Erreur');
            header('Location: ' . $back);
            exit;
        }

        $dao = new \Models\UserPersonnageDAO();
        $added = $dao->toggle($userId, $persoId);

        Logger::write('TOGGLE', 'collection', true, 'user=' . $userId . ' perso=' . $persoId);

        Flash::setFromString(
            $added ? 'Personnage ajouté à ta collection.' : 'Personnage retiré de ta collection.',
            HMessage::COLOR_SUCCESS,
            'OK'
        );

        header('Location: ' . $back);
        exit;
    }
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
}