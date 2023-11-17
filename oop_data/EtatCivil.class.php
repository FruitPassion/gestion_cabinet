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

    public function getCivilite() : bool  {
      return $this->civilite;
    }
    
    public function getNom() : string {
      return $this->nom;

    }

    public function getPrenom() : string{
      return $this->prenom;
    }
}
