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

    public function getEtatCivil(): EtatCivil
    {
        return $this->etatCivil;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getCodePostal(): int
    {
        return $this->codePostal;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getDateNaissance(): string
    {
        return $this->dateNaissance;
    }

    public function getLieuNaissance(): string
    {
        return $this->lieuNaissance;
    }

    public function getNss(): int
    {
        return $this->nss;
    }

    public function getMedecinReferrant(): Medecin
    {
        return $this->medecinReferrant;
    }


    public function __destruct() {
        return ('suppression: '. $this->etatCivil->getNom() . " " . $this->etatCivil->getPrenom(). PHP_EOL);
    }
}
