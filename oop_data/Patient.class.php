<?php

class Patient
{
    private EtatCivil $etatCivil;
    private string $adresse;
    private int $codePostal;
    private string $ville;
    private string $dateNaissance;
    private string $lieuNaissance;
    private int $nss;
    private Medecin $medecinReferrant;

    public function __construct(EtatCivil $etatCivil, string $adresse, int $codePostal, string $ville,
                                string $dateNaissance, string $lieuNaissance, int $nss) {
        $this->etatCivil = $etatCivil;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->dateNaissance = $dateNaissance;
        $this->lieuNaissance = $lieuNaissance;
        $this->nss = $nss;
    }

    public function definirReferant(Medecin $medecinReferrant) : void {
        $this->medecinReferrant = $medecinReferrant;
    }

}