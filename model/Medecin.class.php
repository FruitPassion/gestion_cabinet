<?php

class Medecin
{
    private EtatCivil $etatCivil;

    public function __construct(EtatCivil $etatCivil){
        $this->etatCivil = $etatCivil;
    }

    public function getEtatCivil() : EtatCivil {
      return $this->etatCivil;
    }

    public function __destruct() {
        return ('suppression: '. $this->etatCivil->getNom() . " " . $this->etatCivil->getPrenom(). PHP_EOL);
    }
}
