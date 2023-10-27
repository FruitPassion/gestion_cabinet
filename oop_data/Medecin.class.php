<?php

class Medecin
{
    private EtatCivil $etatCivil;

    public function __construct(EtatCivil $etatCivil){
        $this->etatCivil = $etatCivil;
    }
}