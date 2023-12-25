<?php

class Medecin
{
    private int $id;
    private EtatCivil $etatCivil;

    public function __construct(int $id, EtatCivil $etatCivil){
        $this->id = $id;
        $this->etatCivil = $etatCivil;
    }

    public function getEtatCivil() : EtatCivil {
      return $this->etatCivil;
    }

    public function getId() : int {
      return $this->id;
    }

    public function __destruct() {
        return ('suppression: '. $this->etatCivil->getNom() . " " . $this->etatCivil->getPrenom(). PHP_EOL);
    }
}
