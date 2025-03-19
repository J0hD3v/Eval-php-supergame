<?php
//LA VIEW POUR LA CLASS ViewPlayer

class ViewPlayer {

    //region ATTRIBUTS
    private ?string $signUpMessage = "";
    private ?string $playersList = "";

    //region GETTERS/SETTERS
    /**
     * Get the value of signUpMessage
     *
     * @return ?string
     */
    public function getSignUpMessage(): ?string {
        return $this->signUpMessage;
    }

    /**
     * Set the value of signUpMessage
     *
     * @param ?string $signUpMessage
     *
     * @return self
     */
    public function setSignUpMessage(?string $signUpMessage): self {
        $this->signUpMessage = $signUpMessage;
        return $this;
    }

    /**
     * Get the value of playersList
     *
     * @return ?string
     */
    public function getPlayersList(): string {
        return $this->playersList;
    }

    /**
     * Set the value of playersList
     *
     * @param ?string $playersList
     *
     * @return self
     */
    public function setPlayersList(?string $playersList): self {
        $this->playersList = $playersList;
        return $this;
    }

    //region METHODES
    public function displayView(): string {
        ob_start();
        ?>

        <h1>Inscription d'un Joueur</h1>
        <form action="" method="POST">
            <label for="pseudo">Pseudo : </label>
            <input type="text" id="pseudo" name="pseudo" placeholder="Votre Pseudo">
            <label for="email">Email : </label>
            <input type="text" id="email" name="email" placeholder="Votre Email">
            <label for="password">Password : </label>
            <input type="text" id="password" name="password" placeholder="Votre Mot de Passe">
            <label for="score">Score : </label>
            <input type="number" id="score" name="score" placeholder="Votre Score">
            <input type="submit" name="signUp" value="Envoyer">
        </form>

        <?php
        echo $this->getSignUpMessage();
        ?>

        <h2>Liste des joueurs</h2>

        <?php
        echo $this->getPlayersList();

        return ob_get_clean();
    }


    
}