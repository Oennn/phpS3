<?php 
class Naissance{
    private string $sexe;
    private int $annee;
    private string $prenom;
    private int $nombre;


    public function __construct(string $sexe,int $annee,string $prenom,int $nombre){
        $this->sexe=$sexe;
        $this->annee=$annee;
        $this->prenom=$prenom;
        $this->nombre=$nombre;
    }
    public function getSexe():string{
        return $this->sexe;
    }
    public function getAnnee():int{
        return $this->annee;
    }
    public function getprenom():string{
        return $this->prenom;
    }
    public function getnombre():int{
        return $this->nombre;
    }
    public function __toString():string{
        return "sexe de naissance: $sexe, annee de naissance: $annee, prenom: $prenom, nombre d'enfants: $nombre ."; 
    }
    public static function fromArray(array $row):self{
        return new self(
            $row['sexe'],
            (int) $row['annee'],
            $row['prenom'],
            (int) $row['nombre']
        );
    }






















    }

?>
