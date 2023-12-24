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


}