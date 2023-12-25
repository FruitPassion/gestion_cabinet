<?php


class Planning {
    private array $rendezVous = [];

    private array $medecins = [];
    private array $patients = [];

    public function __construct( array $medecins, array $patients, array $rendezVous)
    {
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require $rootDir."/model/EtatCivil.class.php";
        require $rootDir."/model/Medecin.class.php";
        require $rootDir."/model/RendezVous.class.php";
        require $rootDir."/model/Patient.class.php";

        $this->construireMedecins($medecins);
        $this->construirePatients($patients);
        $this->construireRendezVous($rendezVous);

    }


    private function construireMedecins(array $medecins): void
    {
        foreach ($medecins as $medecin) {
            $etatCivil = new EtatCivil(
                $medecin["civilite"],
                $medecin["nom"],
                $medecin["prenom"]
            );
            $this->medecins[] = new Medecin($medecin["id_medecin"], $etatCivil);
        }
    }

    private function construirePatients(array $patients): void
    {
        foreach ($patients as $patient) {
            $etatCivil = new EtatCivil(
                $patient["civilite"],
                $patient["nom"],
                $patient["prenom"]
            );
            $this->patients[] = new Patient($patient["id_patient"], $etatCivil, $patient["adresse"],
                $patient["code_postal"], $patient["ville"], $patient["date_naissance"], $patient["lieu_naissance"],
                $patient["nss"]);
        }
    }

    private function construireRendezVous(array $rendezV): void
    {
        foreach ($this->medecins as $medecin) {
            foreach ($rendezV as $rdv) {
                if ($rdv["id_medecin"] == $medecin->getId()) {
                    $tempRDV = new RendezVous($medecin, $this->patients[$rdv["id_patient"]-1], $rdv["date"], $rdv["heure"], $rdv["duree"]);
                    $this->rendezVous[] = $tempRDV;
                    $this->medecins[$medecin->getId()-1]->setRendezVous($tempRDV);
                }
            }
        }
    }

    public function getMedecins(): array
    {
        return $this->medecins;
    }

    public function getPatients(): array
    {
        return $this->patients;
    }

    public function getRendezVous(): array
    {
        return $this->rendezVous;
    }

    public function calculerStats(): array
    {
        $statistiques = [
            "moins25" => [
                "homme" => 0,
                "femme" => 0
            ],
            "entre25et50" => [
                "homme" => 0,
                "femme" => 0
            ],
            "plus50" => [
                "homme" => 0,
                "femme" => 0
            ]
        ];

        foreach ($this->patients as $patient) {
            if ($patient->getAge() < 25) {
                if ($patient->getEtatCivil()->getCivilite() == "Monsieur") {
                    $statistiques["moins25"]["homme"]++;
                } else {
                    $statistiques["moins25"]["femme"]++;
                }
            } else if ($patient->getAge() >= 25 && $patient->getAge() <= 50) {
                if ($patient->getEtatCivil()->getCivilite() == "Monsieur") {
                    $statistiques["entre25et50"]["homme"]++;
                } else {
                    $statistiques["entre25et50"]["femme"]++;
                }
            } else {
                if ($patient->getEtatCivil()->getCivilite() == "Monsieur") {
                    $statistiques["plus50"]["homme"]++;
                } else {
                    $statistiques["plus50"]["femme"]++;
                }
            }
        }

        return $statistiques;
    }
}