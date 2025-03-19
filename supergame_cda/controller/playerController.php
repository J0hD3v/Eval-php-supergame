<?php
//LE CONTROLLER pour la class PlayerController

class PlayerController extends AbstractController {

    //region ATTRIBUTS
    private ?ViewPlayer $player;

    //region CONSTRUCT
    public function __construct(?ViewPlayer $player, ?ViewHeader $header, ?ViewFooter $footer, ?ModelPlayer $model = null) {
        parent::__construct($header, $footer, $model);
        $this->player = $player;
    }
    
    //region GETTERS/SETTERS
    /**
     * Get the value of player
     *
     * @return ?ViewPlayer
     */
    public function getPlayer(): ?ViewPlayer {
        return $this->player;
    }

    /**
     * Set the value of player
     *
     * @param ?ViewPlayer $player
     *
     * @return self
     */
    public function setPlayer(?ViewPlayer $player): self {
        $this->player = $player;
        return $this;
    }

    //region METHODES
    public function addPlayer(): string {
        // Vérifier que l'on reçoit le formulaire d'inscription
        if (isset($_POST['signUp'])) {
            // Vérifier que les champs obligatoires sont remplis
            if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['pseudo']) || empty($_POST['score'])) {
                return 'Veuillez remplir tous les champs';
            }
            // Vérifier le format des données
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['score'], FILTER_VALIDATE_INT)) {
                return "Format des données incorrect";
            }
            // Nettoyer les données
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $score = sanitize($_POST['score']);
            // Hasher le mot de passe
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Vérifier si l'email est disponible
            $data = $this->getModel()->setEmail($email)->getByEmail();
            if ($data) {
                return "L'email est déjà utilisé";
            }
            // Enregistre l'utilisateur en BDD
            $this->getModel()->setPseudo($pseudo)->setPassword($password)->setScore($score)->add();
            return "{$pseudo} a été enregistré en BDD !";
        } else {
            return "";
        }
    }
    public function getAllPlayers(): string {
        $data = $this->getModel()->getAll();
        if (gettype($data) == 'string') {
            $listPlayers = [] ;
            $displayErrorMessage = true;
        } else {
            $listPlayers = $data ;
            $displayErrorMessage = false;
        }
        ob_start();
        foreach ($listPlayers as $key => $value) {
            ?>

            <article>
                <h4><?php echo $value["pseudo"] ?></h4>
                <p><?php echo $value["email"] ?></p>
                <p>Score : <?php echo $value["score"] ?></p>
            </article>

            <?php
            if ($key <= count($listPlayers)) {
                ?>
                <hr>
                <?php
            }
        }
        if ($displayErrorMessage) echo $data;
        return ob_get_clean();
    }
    public function render(): void {
        // Traitement des données
        $message = $this->addPlayer();
        $players = $this->getAllPlayers();
        // Affichage
        echo $this->getHeader()->displayView();
        echo $this->getPlayer()->setSignUpMessage($message)->setPlayersList($players)->displayView();
        echo $this->getFooter()->displayView();
    }
}