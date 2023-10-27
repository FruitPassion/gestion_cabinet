<?php

class EtatCivil
{
    private bool $civilite;
    private string $nom;
    private string $prenom;


    public function __construct(bool $civilite, string $nom, string $prenom){
        $this->civilite = $civilite;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
}