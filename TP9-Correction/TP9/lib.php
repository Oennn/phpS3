<?php
require_once('config.php');
// Version 1 avec FETCH_ASSOC
/*
 function connexionPDO(): ?PDO
{
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

function h($s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function validerPersonne(array $post): array
{
    $val = [
        'nom'    => trim($post['nom'] ?? ''),
        'prenom' => trim($post['prenom'] ?? ''),
        'dateN'  => trim($post['dateN'] ?? '')
    ];

    $err = [
        'nom'    => '',
        'prenom' => '',
        'dateN'  => ''
    ];

    if ($val['nom'] === '') {
        $err['nom'] = 'Nom obligatoire';
    }

    if ($val['prenom'] === '') {
        $err['prenom'] = 'Prénom obligatoire';
    }

    if ($val['dateN'] === '') {
        $err['dateN'] = 'Date obligatoire';
    } else {
        $d = DateTime::createFromFormat('Y-m-d', $val['dateN']);
        if (!$d || $d->format('Y-m-d') !== $val['dateN']) {
            $err['dateN'] = 'Date invalide (format AAAA-MM-JJ)';
        }
    }

    return [$val, $err];
}

function formPersonne(
    string $action,
    array $val,
    array $err,
    ?int $id = null,
    ?int $from = null,
    ?int $to = null
): string {
    $val = array_merge(['nom' => '', 'prenom' => '', 'dateN' => ''], $val);
    $err = array_merge(['nom' => '', 'prenom' => '', 'dateN' => ''], $err);

    foreach ($val as $k => $v) {
        $val[$k] = h($v);
    }
    foreach ($err as $k => $v) {
        $err[$k] = h($v);
    }

    $hiddenId = ($id !== null)
        ? '<input type="hidden" name="id" value="' . (int)$id . '">'
        : '';

    $hiddenFrom = ($from !== null)
        ? '<input type="hidden" name="from" value="' . (int)$from . '">'
        : '';

    $hiddenTo = ($to !== null)
        ? '<input type="hidden" name="to" value="' . (int)$to . '">'
        : '';

    return <<<HTML
<form action="index.php?action={$action}" method="post">
  {$hiddenId}
  {$hiddenFrom}
  {$hiddenTo}
  <table>
    <tr>
      <td><label for="nom">Nom</label></td>
      <td><input id="nom" type="text" name="nom" value="{$val['nom']}"></td>
      <td style="color:red;">{$err['nom']}</td>
    </tr>
    <tr>
      <td><label for="prenom">Prénom</label></td>
      <td><input id="prenom" type="text" name="prenom" value="{$val['prenom']}"></td>
      <td style="color:red;">{$err['prenom']}</td>
    </tr>
    <tr>
      <td><label for="dateN">Date de naissance</label></td>
      <td><input id="dateN" type="text" name="dateN" placeholder="aaaa-mm-jj" value="{$val['dateN']}"></td>
      <td style="color:red;">{$err['dateN']}</td>
    </tr>
    <tr>
      <td><button type="submit">Valider</button></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</form>
HTML;
}

class Personne
{
    private ?int $id;
    private string $nom;
    private string $prenom;
    private string $dateN;

    public function __construct(?int $id, string $nom, string $prenom, string $dateN)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateN = $dateN;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getDateN(): string
    {
        return $this->dateN;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function setDateN(string $dateN): void
    {
        $this->dateN = $dateN;
    }

    public function insert(PDO $pdo, string $mode = 'np'): bool
    {
        if ($mode === 'p') {
            $sql = "INSERT INTO Personne(nom, prenom, dateN)
                    VALUES(:nom, :prenom, :dateN)";
            $stmt = $pdo->prepare($sql);
            $ok = $stmt->execute([
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':dateN' => $this->dateN
            ]);
        } else {
            $nom = $pdo->quote($this->nom);
            $prenom = $pdo->quote($this->prenom);
            $dateN = $pdo->quote($this->dateN);

            $sql = "INSERT INTO Personne(nom, prenom, dateN)
                    VALUES($nom, $prenom, $dateN)";
            $ok = $pdo->exec($sql) === 1;
        }

        if ($ok) {
            $this->id = (int)$pdo->lastInsertId();
        }

        return $ok;
    }

    public function update(PDO $pdo, string $mode = 'np'): bool
    {
        if ($mode === 'p') {
            $sql = "UPDATE Personne
                    SET nom = :nom, prenom = :prenom, dateN = :dateN
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':id' => $this->id,
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':dateN' => $this->dateN
            ]);
        } else {
            $id = (int)$this->id;
            $nom = $pdo->quote($this->nom);
            $prenom = $pdo->quote($this->prenom);
            $dateN = $pdo->quote($this->dateN);

            $sql = "UPDATE Personne
                    SET nom = $nom, prenom = $prenom, dateN = $dateN
                    WHERE id = $id";
            return $pdo->exec($sql) !== false;
        }
    }

    public function delete(PDO $pdo, string $mode = 'np'): bool
    {
        if ($mode === 'p') {
            $sql = "DELETE FROM Personne WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([':id' => $this->id]);
        } else {
            $id = (int)$this->id;
            $sql = "DELETE FROM Personne WHERE id = $id";
            return $pdo->exec($sql) !== false;
        }
    }

    public static function findById(PDO $pdo, int $id, string $mode = 'np'): ?Personne
    {
        if ($mode === 'p') {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        } else {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE id = " . (int)$id;
            $stmt = $pdo->query($sql);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Personne(
            (int)$row['id'],
            $row['nom'],
            $row['prenom'],
            $row['dateN']
        );
    }

    public static function findAll(PDO $pdo, string $mode = 'np'): array
    {
        $sql = "SELECT id, nom, prenom, dateN
                FROM Personne
                ORDER BY id";

        if ($mode === 'p') {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } else {
            $stmt = $pdo->query($sql);
        }

        $res = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $res[] = new Personne(
                (int)$row['id'],
                $row['nom'],
                $row['prenom'],
                $row['dateN']
            );
        }

        return $res;
    }

    public static function countAll(PDO $pdo): int
    {
        return (int)$pdo->query("SELECT COUNT(*) FROM Personne")->fetchColumn();
    }

    public static function findInterval(PDO $pdo, int $from, int $to, string $mode = 'np'): array
    {
        if ($from < 1) $from = 1;
        if ($to < $from) $to = $from;

        $offset = $from - 1;
        $limit  = $to - $from + 1;

        if ($mode === 'p') {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    ORDER BY id
                    LIMIT :offset, :limite";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    ORDER BY id
                    LIMIT $offset, $limit";

            $stmt = $pdo->query($sql);
        }

        $res = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $res[] = new Personne(
                (int)$row['id'],
                $row['nom'],
                $row['prenom'],
                $row['dateN']
            );
        }

        return $res;
    }

    public static function findPageOfId(PDO $pdo, int $id, int $taillePage = 10): array
    {
        $id = (int)$id;
        $sql = "SELECT COUNT(*) FROM Personne WHERE id <= $id";
        $rang = (int)$pdo->query($sql)->fetchColumn();

        if ($rang <= 0) {
            return ['from' => 1, 'to' => $taillePage];
        }

        $from = (int)(floor(($rang - 1) / $taillePage) * $taillePage + 1);
        $to   = $from + $taillePage - 1;

        $total = self::countAll($pdo);
        if ($to > $total) $to = $total;

        return ['from' => $from, 'to' => $to];
    }

    public static function search(PDO $pdo, string $chaine, string $mode = 'np', int $from = 1, int $to = 10): array
    {
        $mots = explode('+', $chaine);
        $conditions = [];
        $params = [];
        $i = 0;

        foreach ($mots as $mot) {
            $mot = trim($mot);
            if ($mot === '') {
                continue;
            }

            if ($mode === 'p') {
                $param = ':mot' . $i;
                $conditions[] = "(nom LIKE $param OR prenom LIKE $param)";
                $params[$param] = '%' . $mot . '%';
                $i++;
            } else {
                $motSQL = $pdo->quote('%' . $mot . '%');
                $conditions[] = "(nom LIKE $motSQL OR prenom LIKE $motSQL)";
            }
        }

        if (empty($conditions)) {
            return self::findInterval($pdo, $from, $to, $mode);
        }

        $where = implode(' OR ', $conditions);
        $offset = $from - 1;
        $limit  = $to - $from + 1;

        if ($mode === 'p') {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE $where
                    ORDER BY id
                    LIMIT :offset, :limite";

            $stmt = $pdo->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v);
            }

            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE $where
                    ORDER BY id
                    LIMIT $offset, $limit";

            $stmt = $pdo->query($sql);
        }

        $res = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $res[] = new Personne(
                (int)$row['id'],
                $row['nom'],
                $row['prenom'],
                $row['dateN']
            );
        }

        return $res;
    }

    public static function countSearch(PDO $pdo, string $chaine, string $mode = 'np'): int
    {
        $mots = explode('+', $chaine);
        $conditions = [];
        $params = [];
        $i = 0;

        foreach ($mots as $mot) {
            $mot = trim($mot);
            if ($mot === '') {
                continue;
            }

            if ($mode === 'p') {
                $param = ':mot' . $i;
                $conditions[] = "(nom LIKE $param OR prenom LIKE $param)";
                $params[$param] = '%' . $mot . '%';
                $i++;
            } else {
                $motSQL = $pdo->quote('%' . $mot . '%');
                $conditions[] = "(nom LIKE $motSQL OR prenom LIKE $motSQL)";
            }
        }

        if (empty($conditions)) {
            return self::countAll($pdo);
        }

        $where = implode(' OR ', $conditions);
        $sql = "SELECT COUNT(*) FROM Personne WHERE $where";

        if ($mode === 'p') {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        } else {
            $stmt = $pdo->query($sql);
        }

        return (int)$stmt->fetchColumn();
    }
}

function tablePersonnes(array $personnes, string $mode = 'np', ?int $from = null, ?int $to = null): string
{
    $params = '';
    if ($from !== null && $to !== null) {
        $params = "&from=" . (int)$from . "&to=" . (int)$to;
    }

    $html = "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>";

    foreach ($personnes as $p) {
        $id = (int)$p->getId();

        $urlEdit = "index.php?action=edit&id={$id}&mode={$mode}{$params}";
        $urlDel  = "index.php?action=delete&id={$id}&mode={$mode}{$params}";

        $html .= "<tr>";
        $html .= "<td>{$id}</td>";
        $html .= "<td>" . h($p->getNom()) . "</td>";
        $html .= "<td>" . h($p->getPrenom()) . "</td>";
        $html .= "<td>" . h($p->getDateN()) . "</td>";
        $html .= "<td>
                    <a href='{$urlEdit}'>✏️</a>
                    <a href='{$urlDel}' onclick=\"return confirm('Supprimer ?')\">🗑️</a>
                  </td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}

function boutonsPagination(int $from, int $to, int $total, int $taillePage = 10, string $mode = 'np'): string
{
    if ($total <= 0) return "";

    if ($from < 1) $from = 1;
    if ($to > $total) $to = $total;
    if ($to < $from) $to = $from;

    $html = "<div style='margin-top:15px;'>";

    if ($from > 1) {
        $prev_from = max(1, $from - $taillePage);
        $prev_to   = min($prev_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=afficher&mode={$mode}&from={$prev_from}&to={$prev_to}' style='margin-right:10px;'>⬅️ Précédent</a>";
    }

    if ($to < $total) {
        $next_from = $from + $taillePage;
        $next_to   = min($next_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=afficher&mode={$mode}&from={$next_from}&to={$next_to}'>Suivant ➡️</a>";
    }

    $html .= "</div>";
    return $html;
}

function boutonsPaginationRecherche(string $q, int $from, int $to, int $total, int $taillePage = 10, string $mode = 'np'): string
{
    if ($total <= 0) return "";

    if ($from < 1) $from = 1;
    if ($to > $total) $to = $total;
    if ($to < $from) $to = $from;

    $html = "<div style='margin-top:15px;'>";

    if ($from > 1) {
        $prev_from = max(1, $from - $taillePage);
        $prev_to   = min($prev_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=rechercher&q="
            . urlencode($q)
            . "&mode={$mode}&from={$prev_from}&to={$prev_to}' style='margin-right:10px;'>⬅️ Précédent</a>";
    }

    if ($to < $total) {
        $next_from = $from + $taillePage;
        $next_to   = min($next_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=rechercher&q="
            . urlencode($q)
            . "&mode={$mode}&from={$next_from}&to={$next_to}'>Suivant ➡️</a>";
    }

    $html .= "</div>";
    return $html;
}

function formRecherche(string $mode = 'np', string $q = ''): string
{
    $q = h($q);

    return <<<HTML
<form action="index.php" method="get" style="margin-top:10px;">
  <input type="hidden" name="action" value="rechercher">
  <input type="hidden" name="mode" value="{$mode}">

  <label for="q"><b>Recherche :</b></label><br>
  <input type="text" id="q" name="q" value="{$q}" placeholder="ali+mar">

 
  <button type="submit">Rechercher</button>
</form>
HTML;
}
*/
// Version 2 avec FETCH_CLASS



function connexionPDO(): ?PDO
{
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // On garde FETCH_ASSOC par defaut.
        // FETCH_CLASS sera utilise seulement dans les methodes de lecture.
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

function h($s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function validerPersonne(array $post): array
{
    $val = [
        'nom'    => trim($post['nom'] ?? ''),
        'prenom' => trim($post['prenom'] ?? ''),
        'dateN'  => trim($post['dateN'] ?? '')
    ];

    $err = [
        'nom'    => '',
        'prenom' => '',
        'dateN'  => ''
    ];

    if ($val['nom'] === '') {
        $err['nom'] = 'Nom obligatoire';
    }

    if ($val['prenom'] === '') {
        $err['prenom'] = 'Prénom obligatoire';
    }

    if ($val['dateN'] === '') {
        $err['dateN'] = 'Date obligatoire';
    } else {
        $d = DateTime::createFromFormat('Y-m-d', $val['dateN']);
        if (!$d || $d->format('Y-m-d') !== $val['dateN']) {
            $err['dateN'] = 'Date invalide (format AAAA-MM-JJ)';
        }
    }

    return [$val, $err];
}

function formPersonne(
    string $action,
    array $val,
    array $err,
    ?int $id = null,
    ?int $from = null,
    ?int $to = null
): string {
    $val = array_merge(['nom' => '', 'prenom' => '', 'dateN' => ''], $val);
    $err = array_merge(['nom' => '', 'prenom' => '', 'dateN' => ''], $err);

    foreach ($val as $k => $v) {
        $val[$k] = h($v);
    }
    foreach ($err as $k => $v) {
        $err[$k] = h($v);
    }

    $hiddenId = ($id !== null)
        ? '<input type="hidden" name="id" value="' . (int)$id . '">'
        : '';

    $hiddenFrom = ($from !== null)
        ? '<input type="hidden" name="from" value="' . (int)$from . '">'
        : '';

    $hiddenTo = ($to !== null)
        ? '<input type="hidden" name="to" value="' . (int)$to . '">'
        : '';

    return <<<HTML
<form action="index.php?action={$action}" method="post">
  {$hiddenId}
  {$hiddenFrom}
  {$hiddenTo}
  <table>
    <tr>
      <td><label for="nom">Nom</label></td>
      <td><input id="nom" type="text" name="nom" value="{$val['nom']}"></td>
      <td style="color:red;">{$err['nom']}</td>
    </tr>
    <tr>
      <td><label for="prenom">Prénom</label></td>
      <td><input id="prenom" type="text" name="prenom" value="{$val['prenom']}"></td>
      <td style="color:red;">{$err['prenom']}</td>
    </tr>
    <tr>
      <td><label for="dateN">Date de naissance</label></td>
      <td><input id="dateN" type="text" name="dateN" placeholder="aaaa-mm-jj" value="{$val['dateN']}"></td>
      <td style="color:red;">{$err['dateN']}</td>
    </tr>
    <tr>
      <td><button type="submit">Valider</button></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</form>
HTML;
}

class Personne
{
    // Pour FETCH_CLASS, le plus simple est d'utiliser des attributs publics
    public ?int $id;
    public string $nom;
    public string $prenom;
    public string $dateN;

    // Constructeur compatible avec FETCH_CLASS
    public function __construct(?int $id = null, string $nom = '', string $prenom = '', string $dateN = '')
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateN = $dateN;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getDateN(): string
    {
        return $this->dateN;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function setDateN(string $dateN): void
    {
        $this->dateN = $dateN;
    }

    public function insert(PDO $pdo, string $mode = 'np'): bool
    {
        if ($mode === 'p') {
            $sql = "INSERT INTO Personne(nom, prenom, dateN)
                    VALUES(:nom, :prenom, :dateN)";
            $stmt = $pdo->prepare($sql);
            $ok = $stmt->execute([
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':dateN' => $this->dateN
            ]);
        } else {
            $nom = $pdo->quote($this->nom);
            $prenom = $pdo->quote($this->prenom);
            $dateN = $pdo->quote($this->dateN);

            $sql = "INSERT INTO Personne(nom, prenom, dateN)
                    VALUES($nom, $prenom, $dateN)";
            $ok = $pdo->exec($sql) === 1;
        }

        if ($ok) {
            $this->id = (int)$pdo->lastInsertId();
        }

        return $ok;
    }

    public function update(PDO $pdo, string $mode = 'np'): bool
    {
        if ($mode === 'p') {
            $sql = "UPDATE Personne
                    SET nom = :nom, prenom = :prenom, dateN = :dateN
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':id' => $this->id,
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':dateN' => $this->dateN
            ]);
        } else {
            $id = (int)$this->id;
            $nom = $pdo->quote($this->nom);
            $prenom = $pdo->quote($this->prenom);
            $dateN = $pdo->quote($this->dateN);

            $sql = "UPDATE Personne
                    SET nom = $nom, prenom = $prenom, dateN = $dateN
                    WHERE id = $id";
            return $pdo->exec($sql) !== false;
        }
    }

    public function delete(PDO $pdo, string $mode = 'np'): bool
    {
        if ($mode === 'p') {
            $sql = "DELETE FROM Personne WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([':id' => $this->id]);
        } else {
            $id = (int)$this->id;
            $sql = "DELETE FROM Personne WHERE id = $id";
            return $pdo->exec($sql) !== false;
        }
    }

    public static function findById(PDO $pdo, int $id, string $mode = 'np'): ?Personne
    {
        if ($mode === 'p') {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        } else {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE id = " . (int)$id;
            $stmt = $pdo->query($sql);
        }

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Personne');
        $p = $stmt->fetch();

        return ($p === false) ? null : $p;
    }

    public static function findAll(PDO $pdo, string $mode = 'np'): array
    {
        $sql = "SELECT id, nom, prenom, dateN
                FROM Personne
                ORDER BY id";

        if ($mode === 'p') {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } else {
            $stmt = $pdo->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Personne');
    }

    public static function countAll(PDO $pdo): int
    {
        return (int)$pdo->query("SELECT COUNT(*) FROM Personne")->fetchColumn();
    }

    public static function findInterval(PDO $pdo, int $from, int $to, string $mode = 'np'): array
    {
        if ($from < 1) $from = 1;
        if ($to < $from) $to = $from;

        $offset = $from - 1;
        $limit  = $to - $from + 1;

        if ($mode === 'p') {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    ORDER BY id
                    LIMIT :offset, :limite";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    ORDER BY id
                    LIMIT $offset, $limit";

            $stmt = $pdo->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Personne');
    }

    public static function findPageOfId(PDO $pdo, int $id, int $taillePage = 10): array
    {
        $id = (int)$id;
        $sql = "SELECT COUNT(*) FROM Personne WHERE id <= $id";
        $rang = (int)$pdo->query($sql)->fetchColumn();

        if ($rang <= 0) {
            return ['from' => 1, 'to' => $taillePage];
        }

        $from = (int)(floor(($rang - 1) / $taillePage) * $taillePage + 1);
        $to   = $from + $taillePage - 1;

        $total = self::countAll($pdo);
        if ($to > $total) $to = $total;

        return ['from' => $from, 'to' => $to];
    }

    public static function search(PDO $pdo, string $chaine, string $mode = 'np', int $from = 1, int $to = 10): array
    {
        $mots = explode('+', $chaine);
        $conditions = [];
        $params = [];
        $i = 0;

        foreach ($mots as $mot) {
            $mot = trim($mot);
            if ($mot === '') {
                continue;
            }

            if ($mode === 'p') {
                $param = ':mot' . $i;
                $conditions[] = "(nom LIKE $param OR prenom LIKE $param)";
                $params[$param] = '%' . $mot . '%';
                $i++;
            } else {
                $motSQL = $pdo->quote('%' . $mot . '%');
                $conditions[] = "(nom LIKE $motSQL OR prenom LIKE $motSQL)";
            }
        }

        if (empty($conditions)) {
            return self::findInterval($pdo, $from, $to, $mode);
        }

        $where = implode(' OR ', $conditions);
        $offset = $from - 1;
        $limit  = $to - $from + 1;

        if ($mode === 'p') {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE $where
                    ORDER BY id
                    LIMIT :offset, :limite";

            $stmt = $pdo->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, PDO::PARAM_STR);
            }

            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "SELECT id, nom, prenom, dateN
                    FROM Personne
                    WHERE $where
                    ORDER BY id
                    LIMIT $offset, $limit";

            $stmt = $pdo->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Personne');
    }

    public static function countSearch(PDO $pdo, string $chaine, string $mode = 'np'): int
    {
        $mots = explode('+', $chaine);
        $conditions = [];
        $params = [];
        $i = 0;

        foreach ($mots as $mot) {
            $mot = trim($mot);
            if ($mot === '') {
                continue;
            }

            if ($mode === 'p') {
                $param = ':mot' . $i;
                $conditions[] = "(nom LIKE $param OR prenom LIKE $param)";
                $params[$param] = '%' . $mot . '%';
                $i++;
            } else {
                $motSQL = $pdo->quote('%' . $mot . '%');
                $conditions[] = "(nom LIKE $motSQL OR prenom LIKE $motSQL)";
            }
        }

        if (empty($conditions)) {
            return self::countAll($pdo);
        }

        $where = implode(' OR ', $conditions);
        $sql = "SELECT COUNT(*) FROM Personne WHERE $where";

        if ($mode === 'p') {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        } else {
            $stmt = $pdo->query($sql);
        }

        return (int)$stmt->fetchColumn();
    }
}

function tablePersonnes(array $personnes, string $mode = 'np', ?int $from = null, ?int $to = null): string
{
    $params = '';
    if ($from !== null && $to !== null) {
        $params = "&from=" . (int)$from . "&to=" . (int)$to;
    }

    $html = "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>";

    foreach ($personnes as $p) {
        $id = (int)$p->getId();

        $urlEdit = "index.php?action=edit&id={$id}&mode={$mode}{$params}";
        $urlDel  = "index.php?action=delete&id={$id}&mode={$mode}{$params}";

        $html .= "<tr>";
        $html .= "<td>{$id}</td>";
        $html .= "<td>" . h($p->getNom()) . "</td>";
        $html .= "<td>" . h($p->getPrenom()) . "</td>";
        $html .= "<td>" . h($p->getDateN()) . "</td>";
        $html .= "<td>
                    <a href='{$urlEdit}'>✏️</a>
                    <a href='{$urlDel}' onclick=\"return confirm('Supprimer ?')\">🗑️</a>
                  </td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}

function boutonsPagination(int $from, int $to, int $total, int $taillePage = 10, string $mode = 'np'): string
{
    if ($total <= 0) return "";

    if ($from < 1) $from = 1;
    if ($to > $total) $to = $total;
    if ($to < $from) $to = $from;

    $html = "<div style='margin-top:15px;'>";

    if ($from > 1) {
        $prev_from = max(1, $from - $taillePage);
        $prev_to   = min($prev_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=afficher&mode={$mode}&from={$prev_from}&to={$prev_to}' style='margin-right:10px;'>⬅️ Précédent</a>";
    }

    if ($to < $total) {
        $next_from = $from + $taillePage;
        $next_to   = min($next_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=afficher&mode={$mode}&from={$next_from}&to={$next_to}'>Suivant ➡️</a>";
    }

    $html .= "</div>";
    return $html;
}

function boutonsPaginationRecherche(string $q, int $from, int $to, int $total, int $taillePage = 10, string $mode = 'np'): string
{
    if ($total <= 0) return "";

    if ($from < 1) $from = 1;
    if ($to > $total) $to = $total;
    if ($to < $from) $to = $from;

    $html = "<div style='margin-top:15px;'>";

    if ($from > 1) {
        $prev_from = max(1, $from - $taillePage);
        $prev_to   = min($prev_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=rechercher&q="
            . urlencode($q)
            . "&mode={$mode}&from={$prev_from}&to={$prev_to}' style='margin-right:10px;'>⬅️ Précédent</a>";
    }

    if ($to < $total) {
        $next_from = $from + $taillePage;
        $next_to   = min($next_from + $taillePage - 1, $total);

        $html .= "<a href='index.php?action=rechercher&q="
            . urlencode($q)
            . "&mode={$mode}&from={$next_from}&to={$next_to}'>Suivant ➡️</a>";
    }

    $html .= "</div>";
    return $html;
}

function formRecherche(string $mode = 'np', string $q = ''): string
{
    $q = h($q);

    return <<<HTML
<form action="index.php" method="get" style="margin-top:10px;">
  <input type="hidden" name="action" value="rechercher">
  <input type="hidden" name="mode" value="{$mode}">

  <label for="q"><b>Recherche :</b></label><br>
  <input type="text" id="q" name="q" value="{$q}" placeholder="ali+mar">

 
  <button type="submit">Rechercher</button>
</form>
HTML;
}
