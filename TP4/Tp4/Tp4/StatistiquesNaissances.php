<?php class StatistiquesNaissances
{
    /** @var Naissance[] */
    private array $donnees;

    // --------------------
    // Constructeur
    // --------------------
    public function __construct(array $donnees)
    {
        // Vérifier que le tableau contient uniquement des objets Naissance
        foreach ($donnees as $n) {
            if (!$n instanceof Naissance) {
                throw new InvalidArgumentException("Le tableau doit contenir uniquement des objets Naissance");
            }
        }

        $this->donnees = $donnees;
    }

    // --------------------
    // Nombre total de naissances
    // --------------------
    public function total(): int
    {
        $somme = 0;
        foreach ($this->donnees as $n) {
            $somme += $n->getNombre();
        }
        return $somme;
    }

    // --------------------
    // Total par sexe
    // --------------------
    public function totalSexe(string $sexe): int
    {
        $somme = 0;
        foreach ($this->donnees as $n) {
            if ($n->getSexe() === $sexe) {
                $somme += $n->getNombre();
            }
        }
        return $somme;
    }

    // --------------------
    // Total par sexe et année
    // --------------------
    public function totalSexeAnnee(string $sexe, int $annee): int
    {
        $somme = 0;
        foreach ($this->donnees as $n) {
            if ($n->getSexe() === $sexe && $n->getAnnee() === $annee) {
                $somme += $n->getNombre();
            }
        }
        return $somme;
    }

    // --------------------
    // Proportion d’un sexe en %
    // --------------------
    public function proportionSexe(string $sexe): float
    {
        $total = $this->total();
        if ($total === 0) {
            return 0.0;
        }

        return ($this->totalSexe($sexe) / $total) * 100;
    }

    // --------------------
    // Filtrer par année
    // --------------------
    public function filtrerAnnee(int $annee): array
    {
        return array_values(array_filter(
            $this->donnees,
            fn($n) => $n->getAnnee() === $annee
        ));
        /*
         * $resultat = [];
           foreach ($this->donnees as $n) {
           if ($n->getAnnee() === $annee) {
               $resultat[] = $n;
        }
    }
    return $resultat;
         * */
    }

    // --------------------
    // Top prénoms
    // --------------------
    public function topPrenoms(int $annee, string $sexe, int $n = 10): array
    {
        $compteur = [];

        foreach ($this->donnees as $naissance) {
            if ($naissance->getAnnee() === $annee && $naissance->getSexe() === $sexe) {
                $prenom = $naissance->getPrenom();
                $compteur[$prenom] = ($compteur[$prenom] ?? 0) + $naissance->getNombre();
                /*
                if (!isset($compteur[$prenom])) {
                    $compteur[$prenom] = 0;
                }
                $compteur[$prenom] += $naissance->getNombre();

                 */
            }
        }

        // Trier par ordre décroissant
        arsort($compteur);

        // Retourner les n premiers
        return array_slice($compteur, 0, $n, true);
    }
}
?>