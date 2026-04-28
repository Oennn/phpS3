#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Génération du PDF corrigé - CT TW3 2024
Examen complet avec QCM, réponses courtes et exercice
"""

from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import inch, cm
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle, PageBreak, KeepTogether
from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER, TA_LEFT, TA_JUSTIFY
from datetime import datetime
import os

try:
    print("🔄 Génération du PDF d'examen complet...")

    pdf_file = r'C:\xampp\htdocs\phpS3\CT_TW3_2024_EXAMEN_CORRIGE.pdf'
    doc = SimpleDocTemplate(pdf_file, pagesize=A4,
                           rightMargin=0.8*cm, leftMargin=0.8*cm,
                           topMargin=1.2*cm, bottomMargin=0.8*cm)

    story = []
    styles = getSampleStyleSheet()

    # ========== STYLES PERSONNALISÉS ==========
    title_style = ParagraphStyle(
        'Title',
        parent=styles['Heading1'],
        fontSize=20,
        textColor=colors.HexColor('#2c3e50'),
        spaceAfter=6,
        alignment=TA_CENTER,
        fontName='Helvetica-Bold'
    )

    subtitle_style = ParagraphStyle(
        'Subtitle',
        parent=styles['Normal'],
        fontSize=11,
        textColor=colors.HexColor('#7f8c8d'),
        spaceAfter=10,
        alignment=TA_CENTER,
        fontName='Helvetica'
    )

    section_title = ParagraphStyle(
        'SectionTitle',
        parent=styles['Heading2'],
        fontSize=13,
        textColor=colors.white,
        backColor=colors.HexColor('#3498db'),
        spaceAfter=10,
        spaceBefore=8,
        fontName='Helvetica-Bold',
        leftIndent=5,
        paddingTop=4,
        paddingBottom=4
    )

    normal_style = ParagraphStyle(
        'Normal',
        parent=styles['Normal'],
        fontSize=9,
        alignment=TA_JUSTIFY,
        spaceAfter=8,
        leading=12
    )

    answer_style = ParagraphStyle(
        'Answer',
        parent=styles['Normal'],
        fontSize=9,
        textColor=colors.HexColor('#27ae60'),
        fontName='Helvetica-Bold',
        spaceAfter=6,
        leftIndent=15
    )

    # En-tête
    story.append(Paragraph("🎓 CT TW3 2024 - EXAMEN COMPLET", title_style))
    story.append(Paragraph("Corrigé Officiel avec Explications", subtitle_style))
    story.append(Paragraph("Technologie Web 3 - SINFL4A1", subtitle_style))
    story.append(Spacer(1, 0.4*cm))

    # ========== PARTIE I : QCM ==========
    story.append(Paragraph("📝 PARTIE I : Questions à Choix Multiple (QCM)", section_title))

    qcm_data = [
        {
            "num": 1,
            "question": "Que signifient les initiales de PHP ?",
            "options": ["Personal Hypertext Processor", "PHP Hypertext Preprocessor", "Private Hypertext Processor", "Preprocessed Hypertext Processor"],
            "answer": "B",
            "explanation": "PHP = PHP Hypertext Preprocessor. C'est un acronyme récursif !"
        },
        {
            "num": 2,
            "question": "Comment exécuter un script PHP en ligne de commande ?",
            "options": ["php script.php", "php -execute script.php", "php run script.php", "./script.php"],
            "answer": "A",
            "explanation": "La syntaxe correcte est : <code>php script.php</code> ou <code>php -f script.php</code>"
        },
        {
            "num": 3,
            "question": "Comment commence-t-on et termine-t-on un bloc de code PHP ?",
            "options": ["&lt;?php ... ?&gt;", "&lt;? ... ?&gt;", "&lt;script&gt; ... &lt;/script&gt;", "&lt;php&gt; ... &lt;/php&gt;"],
            "answer": "A",
            "explanation": "<code>&lt;?php</code> est la syntaxe standard. <code>&lt;?</code> est déprécié (short tags)."
        },
        {
            "num": 4,
            "question": "Comment afficher directement une sortie dans le navigateur ?",
            "options": ["echo \"Hello, World !\";", "print \"Hello, World !\";", "output(\"Hello, World !\");", "printf(\"Hello, World !\");"],
            "answer": "A",
            "explanation": "<code>echo</code> et <code>print</code> fonctionnent tous deux. <code>echo</code> est préféré (plus rapide)."
        },
        {
            "num": 5,
            "question": "Que signifie une classe finale et une méthode finale ?",
            "options": ["Une classe ou méthode qui ne peut pas être étendue ou modifiée", "Une classe qui peut être instanciée mais pas modifiée", "Une méthode qui peut être appelée plusieurs fois", "Une méthode qui est héritée automatiquement"],
            "answer": "A",
            "explanation": "<code>final class X {}</code> ou <code>final function f() {}</code> empêche l'héritage/surcharge."
        },
        {
            "num": 6,
            "question": "Comment PHP et HTML peuvent-ils interagir ?",
            "options": ["PHP peut générer du code HTML dynamique", "PHP peut lire du HTML directement", "HTML ne peut pas interagir avec PHP", "PHP et HTML ne peuvent pas fonctionner ensemble"],
            "answer": "A",
            "explanation": "PHP s'exécute côté serveur et génère du HTML qui est envoyé au navigateur."
        },
        {
            "num": 7,
            "question": "$a = 5; $b = \"5\"; var_dump($a == $b); retourne ?",
            "options": ["bool(false)", "bool(true)", "5", "Erreur"],
            "answer": "B",
            "explanation": "<code>==</code> compare les valeurs en faisant une coercion de type. 5 == \"5\" retourne true."
        },
        {
            "num": 8,
            "question": "$a = 5; $b = \"5\"; var_dump($a === $b); retourne ?",
            "options": ["bool(false)", "bool(true)", "\"5\"", "Erreur de type"],
            "answer": "A",
            "explanation": "<code>===</code> compare type ET valeur. int(5) !== string(\"5\"), donc false."
        },
        {
            "num": 9,
            "question": "Quel mot-clé est utilisé pour définir une fonction en PHP ?",
            "options": ["define", "func", "function", "def"],
            "answer": "C",
            "explanation": "La syntaxe est <code>function nomFonction() { ... }</code>"
        },
        {
            "num": 10,
            "question": "function addition($a, $b = 2) { return $a + $b; } echo addition(3); retourne ?",
            "options": ["5", "3", "2", "Erreur"],
            "answer": "A",
            "explanation": "$b a une valeur par défaut de 2. addition(3) = 3 + 2 = 5"
        },
        {
            "num": 11,
            "question": "Que permet la fonction 'isset()' en PHP ?",
            "options": ["Tester si une variable existe", "Détruire une variable", "Créer une session", "Comparer deux valeurs"],
            "answer": "A",
            "explanation": "<code>isset($var)</code> retourne true si la variable existe et n'est pas NULL."
        },
        {
            "num": 12,
            "question": "Quel est le bon moyen d'inclure un fichier PHP ?",
            "options": ["#include \"fichier.php\"", "import \"fichier.php\"", "require \"fichier.php\"", "open \"fichier.php\""],
            "answer": "C",
            "explanation": "<code>require</code> ou <code>require_once</code> inclut un fichier. <code>include</code> aussi."
        },
        {
            "num": 13,
            "question": "Quelle boucle est correcte en PHP ?",
            "options": ["while $i < 10:", "foreach ($arr as $val) {}", "for i in 0..10 {}", "loop (10) {}"],
            "answer": "B",
            "explanation": "<code>foreach</code> est la syntaxe correcte pour parcourir un tableau."
        },
        {
            "num": 14,
            "question": "$tab = [[1,2],[0,3],[1,1]]; Compter valeurs ≤ 1",
            "options": ["2", "4", "5", "6"],
            "answer": "B",
            "explanation": "Valeurs ≤ 1 : 1 (ligne 1), 0, 1 (ligne 2), 1 (ligne 3) = 4 valeurs"
        },
        {
            "num": 15,
            "question": "Quelle instruction affiche la longueur d'une chaîne en PHP ?",
            "options": ["echo strlen(\"Bonjour\");", "echo length(\"Bonjour\");", "echo count(\"Bonjour\");", "echo size(\"Bonjour\");"],
            "answer": "A",
            "explanation": "<code>strlen()</code> retourne la longueur d'une chaîne. Résultat : 7"
        },
        {
            "num": 16,
            "question": "Comment les erreurs d'exécution sont-elles gérées avec include() ?",
            "options": ["Silencieuses, pas d'arrêt", "Arrêt immédiat du script", "Enregistrement dans un log", "Retour d'une valeur booléenne"],
            "answer": "A",
            "explanation": "<code>include()</code> retourne false en cas d'erreur, mais continue. <code>require()</code> arrête."
        },
        {
            "num": 17,
            "question": "Quelle fonction donne le nombre d'entrées affectées par une requête ?",
            "options": ["mysqli_affected_rows()", "rowCount()", "fetchCount()", "getAffectedEntries()"],
            "answer": "B",
            "explanation": "<code>$stmt->rowCount()</code> en PDO retourne le nombre de lignes affectées."
        },
        {
            "num": 18,
            "question": "Différence entre fetch(FETCH_ASSOC) et fetchAll() ?",
            "options": ["fetch() retourne 1 ligne, fetchAll() toutes", "fetch() retourne toutes, fetchAll() 1", "fetch() avec tableau, fetchAll() objet", "fetch() tableau, fetchAll() objet"],
            "answer": "A",
            "explanation": "fetch() = 1 ligne | fetchAll() = toutes les lignes. FETCH_ASSOC = résultat en tableau associatif."
        },
        {
            "num": 19,
            "question": "Comment vérifier si une variable est un nombre ?",
            "options": ["is_numeric()", "is_int()", "is_number()", "is_float()"],
            "answer": "A",
            "explanation": "<code>is_numeric()</code> retourne true pour \"5\", 5, 5.5. <code>is_int()</code> uniquement int."
        },
        {
            "num": 20,
            "question": "Comment vérifier si une variable est vide ?",
            "options": ["empty()", "isset()", "is_empty()", "is_blank()"],
            "answer": "A",
            "explanation": "<code>empty($var)</code> retourne true si vide, null, 0, \"\", false, ou undefined."
        }
    ]

    for qcm in qcm_data:
        q_text = f"<b>Q{qcm['num']}</b>. {qcm['question']}"
        story.append(Paragraph(q_text, normal_style))

        for i, opt in enumerate(qcm['options']):
            letter = chr(65 + i)  # A, B, C, D
            is_answer = letter == qcm['answer']
            color = colors.HexColor('#27ae60') if is_answer else colors.black
            symbol = "✓" if is_answer else ""
            opt_text = f"{letter}. {opt} {symbol}"
            p = Paragraph(opt_text, ParagraphStyle(
                f'Option{i}',
                parent=styles['Normal'],
                fontSize=8,
                leftIndent=15,
                textColor=color,
                fontName='Helvetica-Bold' if is_answer else 'Helvetica'
            ))
            story.append(p)

        story.append(Paragraph(f"<i>💡 {qcm['explanation']}</i>",
            ParagraphStyle('Expl', parent=styles['Normal'], fontSize=8,
            textColor=colors.HexColor('#7f8c8d'), leftIndent=15, spaceAfter=8)))

    story.append(PageBreak())

    # ========== PARTIE II : RÉPONSES COURTES ==========
    story.append(Paragraph("📝 PARTIE II : Réponses en Une Ligne", section_title))

    short_answers = [
        ("Quelle est la méthode pour définir une constante dans PHP ?",
         "<code>define('NOM_CONSTANTE', valeur);</code> ou <code>const NOM_CONSTANTE = valeur;</code>",
         "Les constantes ne peuvent pas être modifiées après leur création."),

        ("Quelle est la différence entre include et require ?",
         "<code>include()</code> continue si erreur | <code>require()</code> arrête le script",
         "require() génère une erreur fatale si le fichier n'existe pas."),

        ("Quelle fonction PHP lit le contenu d'un fichier ?",
         "<code>file_get_contents('fichier.txt')</code> ou <code>fopen()</code> + <code>fread()</code>",
         "file_get_contents() est plus simple pour des fichiers petits/moyens."),

        ("Que signifie la fonction unset() ?",
         "<code>unset($var)</code> détruit une variable et libère sa mémoire",
         "Après unset(), isset($var) retournera false."),

        ("Comment échapper des données avant enregistrement en BD ?",
         "Utiliser des <code>Prepared Statements</code> avec des placeholders <code>?</code>",
         "Cela protège contre les injections SQL."),

        ("Comment échapper automatiquement les données entrantes ?",
         "<code>htmlspecialchars()</code> pour HTML ou <code>addslashes()</code> (déprécié)",
         "Mieux : utiliser htmlspecialchars() avec ENT_QUOTES"),

        ("À quoi sert une variable statique dans une fonction ?",
         "Conserve sa valeur entre les appels de fonction",
         "<code>static $count = 0;</code> garde la valeur d'un appel à l'autre."),

        ("Comment gérer les erreurs lors d'une connexion PDO ?",
         "<code>try { ... } catch (PDOException $e) { ... }</code>",
         "Ou définir <code>PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION</code>"),

        ("Quelle est la différence entre prepare() et query() en PDO ?",
         "<code>prepare()</code> : requête compilée avec paramètres | <code>query()</code> : exécution directe",
         "prepare() est plus sûr pour les données utilisateur."),

        ("Comment exécuter une requête préparée avec paramètres nommés ?",
         "<code>$stmt->execute([':nom' => $valeur, ':age' => $age])</code>",
         "Les paramètres nommés commencent par <code>:</code>"),

        ("Comment lier une variable à un paramètre dans requête préparée ?",
         "<code>$stmt->bindParam(':id', $id, PDO::PARAM_INT)</code>",
         "Ou <code>bindValue()</code> pour lier une valeur directement."),

        ("Comment récupérer les résultats d'une requête avec fetch() ?",
         "<code>$row = $stmt->fetch(PDO::FETCH_ASSOC)</code> ou <code>fetch(PDO::FETCH_OBJ)</code>",
         "FETCH_ASSOC = tableau | FETCH_OBJ = objet"),

        ("Comment récupérer toutes les lignes d'un jeu de résultats ?",
         "<code>$rows = $stmt->fetchAll(PDO::FETCH_ASSOC)</code>",
         "Retourne un tableau de tableaux (ou d'objets selon mode)."),

        ("Comment compter le nombre de lignes retournées par SELECT ?",
         "<code>$count = $stmt->rowCount()</code>",
         "Ou compter avec <code>count($stmt->fetchAll())</code>"),

        ("Quelle méthode PDO permet d'obtenir le dernier ID inséré ?",
         "<code>$lastId = $pdo->lastInsertId()</code>",
         "Utile après un INSERT INTO avec AUTO_INCREMENT"),
    ]

    for i, (question, answer, note) in enumerate(short_answers, 1):
        q = f"<b>Q{i}.</b> {question}"
        story.append(Paragraph(q, normal_style))

        a = f"✓ <b>Réponse :</b> {answer}"
        story.append(Paragraph(a, answer_style))

        if note:
            n = f"<i>📌 {note}</i>"
            story.append(Paragraph(n, ParagraphStyle('Note', parent=styles['Normal'],
                fontSize=7.5, textColor=colors.HexColor('#f39c12'), leftIndent=15, spaceAfter=8)))

        story.append(Spacer(1, 0.15*cm))

    story.append(PageBreak())

    # ========== PARTIE II (suite) : Exercice Tableau ==========
    story.append(Paragraph("📝 PARTIE II (suite) : Afficher éléments sauf index pairs", section_title))

    tab_ex = """
    <b>Code PHP :</b><br/>
    <code>&lt;?php<br/>
    $tab = [10, 20, 30, 40, 50, 60];<br/>
    foreach ($tab as $index => $value) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;if ($index % 2 != 0) {&nbsp;&nbsp;&nbsp;&nbsp;// Index impair<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo $value . ", ";<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    }<br/>
    ?&gt;</code><br/>
    <br/>
    <b>Résultat :</b> 20, 40, 60,<br/>
    <br/>
    <b>Explication :</b> Les index pairs (0, 2, 4) sont exclus. Les index impairs (1, 3, 5) 
    correspondent aux valeurs (20, 40, 60).
    """

    story.append(Paragraph(tab_ex, normal_style))
    story.append(Spacer(1, 0.5*cm))

    # ========== PARTIE III : EXERCICE CLASSE ==========
    story.append(Paragraph("📝 PARTIE III : Implémentation Classe Examen", section_title))

    exercise_intro = """
    <b>Énoncé :</b> Implémenter une classe <code>Examen</code> avec méthodes 
    <code>ajouter()</code>, <code>note()</code>, <code>moyenne()</code>, <code>superieuresA()</code>
    """
    story.append(Paragraph(exercise_intro, normal_style))
    story.append(Spacer(1, 0.2*cm))

    code_solution = """
    <b style="color: #2c3e50;">✓ SOLUTION COMPLÈTE :</b><br/>
    <br/>
    <code style="font-size: 7.5pt; background: #f5f5f5; padding: 8px; display: block;">
    &lt;?php<br/>
    <b style="color: #569cd6;">class</b> Examen {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> $ponderations;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> $reponsesAttendues;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> $reponsesEtudiants = [];<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> $notes = [];<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> <b style="color: #569cd6;">function</b> __construct($reponses, $ponderations) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<b style="color: #ce9178;">this</b>->reponsesAttendues = $reponses;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<b style="color: #ce9178;">this</b>->ponderations = $ponderations;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> <b style="color: #569cd6;">function</b> ajouter($etudiant, $reponses) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->reponsesEtudiants[$etudiant] = $reponses;<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$note = 0;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$totalPonderations = 0;<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">for</b> ($i = 0; $i &lt; count($reponses); $i++) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">if</b> ($reponses[$i] === $<b style="color: #ce9178;">this</b>->reponsesAttendues[$i]) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$note += $<b style="color: #ce9178;">this</b>->ponderations[$i];<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$totalPonderations += $<b style="color: #ce9178;">this</b>->ponderations[$i];<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<b style="color: #ce9178;">this</b>->notes[$etudiant] = round(($note / $totalPonderations) * 10, 2);<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> <b style="color: #569cd6;">function</b> note($etudiant) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">return</b> $<b style="color: #ce9178;">this</b>->notes[$etudiant] ?? 0;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> <b style="color: #569cd6;">function</b> moyenne() {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">if</b> (count($<b style="color: #ce9178;">this</b>->notes) === 0) <b style="color: #569cd6;">return</b> 0;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">return</b> round(array_sum($<b style="color: #ce9178;">this</b>->notes) / count($<b style="color: #ce9178;">this</b>->notes), 3);<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">public</b> <b style="color: #569cd6;">function</b> superieuresA($limite) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$resultat = [];<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">foreach</b> ($<b style="color: #ce9178;">this</b>->notes <b style="color: #569cd6;">as</b> $etudiant => $note) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">if</b> ($note > $limite) {<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$resultat[$etudiant] = $note;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #569cd6;">return</b> $resultat;<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
    }<br/>
    <br/>
    <b style="color: #6a9955;">// UTILISATION :</b><br/>
    $reponses = ['A', 'C', 'B', 'D'];<br/>
    $ponderations = [2, 3, 2, 3];<br/>
    $examen = <b style="color: #569cd6;">new</b> Examen($reponses, $ponderations);<br/>
    <br/>
    $examen->ajouter("Alice", ['A', 'C', 'B', 'D']);    <b style="color: #6a9955;">// 10/10</b><br/>
    $examen->ajouter("Bob", ['A', 'B', 'B', 'D']);      <b style="color: #6a9955;">// 7/10</b><br/>
    $examen->ajouter("Charlie", ['A', 'C', 'C', 'A']);  <b style="color: #6a9955;">// 5/10</b><br/>
    <br/>
    echo "Moyenne : " . $examen->moyenne();             <b style="color: #6a9955;">// 7.33</b><br/>
    print_r($examen->superieuresA(5.0));                <b style="color: #6a9955;">// Alice => 10, Bob => 7</b><br/>
    ?&gt;
    </code>
    """

    story.append(Paragraph(code_solution, normal_style))
    story.append(Spacer(1, 0.3*cm))

    story.append(Paragraph("📊 Explications Détaillées :", ParagraphStyle(
        'Heading', parent=styles['Normal'], fontSize=10, fontName='Helvetica-Bold', spaceAfter=8)))

    explanations = """
    <b>1. Constructeur __construct():</b><br/>
    Initialise les réponses attendues et les pondérations.
    Exemple: Réponses ['A','C','B','D'] avec poids [2,3,2,3]<br/>
    <br/>
    <b>2. Méthode ajouter():</b><br/>
    • Stocke les réponses de l'étudiant<br/>
    • Calcule la note : pour chaque réponse correcte, ajoute sa pondération<br/>
    • Convertit en note sur 10 : (points gagnés / total pondérations) × 10<br/>
    • Exemple Alice : 2+3+2+3 = 10 points possibles, 10 gagnés → 10/10<br/>
    • Exemple Bob : répond B à Q2 au lieu de C → perd 3 points → 7/10<br/>
    <br/>
    <b>3. Méthode note():</b><br/>
    Retourne la note d'un étudiant (utilise ?? pour défaut 0)
    <br/>
    <b>4. Méthode moyenne():</b><br/>
    Calcule moyenne : (10+7+5)/3 = 7.333... arrondie à 3 décimales
    <br/>
    <b>5. Méthode superieuresA():</b><br/>
    Retourne tableau des notes > limite donnée
    """

    story.append(Paragraph(explanations, normal_style))

    story.append(PageBreak())

    # ========== RÉSUMÉ FINAL ==========
    story.append(Paragraph("📊 RÉSUMÉ DE L'EXAMEN", section_title))

    summary_data = [
        ["Partie", "Type", "Nombre Questions", "Points", "Contenu"],
        ["I", "QCM", "20", "?", "Concepts PHP fondamentaux"],
        ["II", "Courte réponse", "16", "?", "Requêtes, syntaxe, fonctions"],
        ["III", "Exercice", "1", "?", "Classe Examen avec POO"],
        ["", "<b>TOTAL</b>", "<b>37</b>", "<b>?</b>", ""],
    ]

    summary_table = Table(summary_data, colWidths=[1.2*cm, 1.3*cm, 2*cm, 1.2*cm, 2.5*cm])
    summary_table.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), colors.HexColor('#34495e')),
        ('TEXTCOLOR', (0, 0), (-1, 0), colors.whitesmoke),
        ('ALIGN', (0, 0), (-1, -1), 'CENTER'),
        ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),
        ('FONTSIZE', (0, 0), (-1, 0), 9),
        ('BOTTOMPADDING', (0, 0), (-1, 0), 5),
        ('BACKGROUND', (0, 1), (-1, -1), colors.HexColor('#f0f0f0')),
        ('GRID', (0, 0), (-1, -1), 1, colors.HexColor('#bdc3c7')),
        ('FONTSIZE', (0, 1), (-1, -1), 8),
        ('ALIGN', (4, 0), (4, -1), 'LEFT'),
    ]))
    story.append(summary_table)
    story.append(Spacer(1, 0.5*cm))

    # Conseils finaux
    final_tips = """
    <b>💡 Conseils pour l'Examen :</b><br/>
    ✓ QCM : Lire attentivement, attention aux pièges (== vs ===)<br/>
    ✓ Réponses courtes : Soyez précis et concis<br/>
    ✓ Exercice : Tester le code pas à pas, utiliser var_dump pour déboguer<br/>
    ✓ Sécurité : Prepared Statements, htmlspecialchars, try-catch<br/>
    ✓ POO : Constructeur __construct, $this->, visibility (public/private)
    """

    story.append(Paragraph(final_tips, normal_style))
    story.append(Spacer(1, 0.5*cm))

    # Footer
    footer = f"📄 CT TW3 2024 - Examen Complet Corrigé | Généré {datetime.now().strftime('%d/%m/%Y %H:%M')}"
    story.append(Paragraph(footer, ParagraphStyle(
        'Footer',
        parent=styles['Normal'],
        fontSize=8,
        textColor=colors.HexColor('#7f8c8d'),
        alignment=TA_CENTER
    )))

    # Générer PDF
    doc.build(story)

    file_size = os.path.getsize(pdf_file)
    print(f"✅ PDF généré avec succès !")
    print(f"   📄 Fichier : CT_TW3_2024_EXAMEN_CORRIGE.pdf")
    print(f"   📊 Taille : {file_size / 1024:.1f} KB")
    print(f"   📍 Localisation : C:\\xampp\\htdocs\\phpS3\\")

except Exception as e:
    print(f"❌ Erreur : {e}")
    import traceback
    traceback.print_exc()

