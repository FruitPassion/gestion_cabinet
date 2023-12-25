<?php

class RendezVous
{
    private Medecin $medecin;
    private Patient $patient;
    private string $date;
    private string $heure;
    private int $duree;


    public function __construct(Medecin $medecin, Patient $patient, string $date, string $heure, int $duree = 30){
        $this->medecin = $medecin;
        $this->patient = $patient;
        $this->date = $date;
        $this->heure = $heure;
        $this->duree = $duree;
    }

    public function getMedecin() : Medecin {
        return $this->medecin;
    }

    public function getPatient() : Patient{
        return $this->patient;
    }

    public function getDate() : string {
        return $this->date;
    }

    public function getHeure() : string{
        return $this->heure;
    }

    public function getDuree() : int{
        return $this->duree;
    }

}