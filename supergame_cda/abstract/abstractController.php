<?php
//LA CLASSE ABSTRAITE AbstractController.php

abstract class AbstractController {
    private ?ViewHeader $header;
    private ?ViewFooter $footer;
    private ?InterfaceModel $model;

    // CONSTRUCTEUR
    public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?InterfaceModel $model) {
        $this->header = $header;
        $this->footer = $footer;
        $this->model = $model;
    }

    // GETTERS & SETTERS
    public function getHeader(): ?ViewHeader {
        return $this->header;
    }
    public function setHeader(?ViewHeader $header): self {
        $this->header = $header;
        return $this;
    }
    public function getFooter(): ?ViewFooter {
        return $this->footer;
    }
    public function setFooter(?ViewFooter $footer): self {
        $this->footer = $footer;
        return $this;
    }
    public function getModel(): ?InterfaceModel {
        return $this->model;
    }
    public function setModel(?InterfaceModel $model): self {
        $this->model = $model;
        return $this;
    }

    // METHODES

    abstract public function render(): void;
}