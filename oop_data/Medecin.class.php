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
}
