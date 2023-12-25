<?php

class Medecin
{
    private int $id;
    private EtatCivil $etatCivil;
    private array $rendezVous  = [];

    public function __construct(int $id, EtatCivil $etatCivil)
    {
        $this->id = $id;
        $this->etatCivil = $etatCivil;
    }

    public function getEtatCivil(): EtatCivil
    {
        return $this->etatCivil;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setRendezVous(RendezVous $rdv): void
    {
        $this->rendezVous[] = $rdv;
    }

    public function getNbHeuresConsultations(): string
    {
        $heuresTravaillees = 0;
        foreach ($this->rendezVous as $rdv) {
            $heuresTravaillees += $rdv->getDuree();
        }
        return (int)($heuresTravaillees/60) . "h" . sprintf("%02d",  $heuresTravaillees%60);
    }

    public function __destruct()
    {
        return ('suppression: ' . $this->etatCivil->getNom() . " " . $this->etatCivil->getPrenom() . PHP_EOL);
    }
}
