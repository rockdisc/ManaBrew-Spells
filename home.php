<?php
include("data.php");
session_start();
$player = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manabrew Player Tools</title>
    <link href="home.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="header">
        <h1>Manabrew</h1>
    <div id="logout">  
        Hello
        <?php
        echo $_SESSION['user'];
        ?> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='logout.php'>Log Out</a>
    </div>
</div>

<div id="main">
    <div class="container" id="tools">
        <div id="links">
            <a target="_blank" href="https://docs.google.com/presentation/d/1K8AWcaNib4DxYNszVUlMlV3hQIjPs3_qV0DkrTGMjuM/edit?usp=sharing">Player Help</a>
            |
            <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSfXa9mmVtf1kX_xUgRS6un3rPbWR6Rs8RVlGEjBd7p9B4WSxA/viewform?usp=sf_link">Session Report</a>
            |
            <a target="_blank" href="https://donjon.bin.sh">Donjon</a>
            |
            <a target="_blank" href="https://orkerhulen.dk/onewebmedia/DnD%205e%20Players%20Handbook%20%28BnW%20OCR%29.pdf">Player Handbook</a>
            |
            <a target="_blank" href="https://www.owlbear.rodeo/profile">Owl Bear Rodeo</a>
            |
            <a target="_blank" href="https://www.dungeonmastersvault.com/pages/dnd/5e/character-builder#">DM Vault</a>
        </div>
        <img src="Action Economy.png" class="image" id="image15" onclick="image('image15', 200)">
        <img src="dnd Prices.png" class="image" id="image16" onclick="image('image16', 200)">
        <img src="ac.png" class="image" id="image1" onclick="image('image1', 350)">
        <img src="dc.png" class="image" id="image2" onclick="image('image2', 250)">
        <img src="transort.png" class="image" id="image3" onclick="image('image3', 350)">
        <img src="conditions.png" class="image" id="image8" onclick="image('image8', 450)">
        <img src="Impactspeed.png" class="image" id="image9" onclick="image('image9', 200)">
        <img src="Sizes-5e.png" class="image" id="image5" onclick="image('image5', 425)">
    </div>

    <div class="container" id="spells">
        <div class="container" id="manaContainer">
            <h2>Mana: <span id="mana-total"></span></h2>
            <div id="apMana">
                <input type="number" class="sInput" id="manaCap" placeholder="Capacity">
                <input type="number" class="sInput" id="manaEff" placeholder="Efficiency">
                <button type="button" class="button" id="apply" >Apply</button>
                <input type="number" class="sInput" id="manaUse" placeholder="Use">
                <button type="button" class="button" id="use" >Use</button>
                <button type="button" class="button" id="next" >Next Turn</button>
            </div>
        </div>
        <div id="spellExample">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <input type="text" name="spellName" id="nameS" placeholder="Spell Name">
                <input type="text" name="spellDesc" id="descS" placeholder="Description">
                <input type="text" name="spellDmg" id="dmgS" placeholder="Damage">
                <input type="text" name="spellRange" id="rangeS" placeholder="Range">
                <input type="text" name="spellCost" id="costS" placeholder="Cost">
                <input type="submit" name="spellSave" id="saveS" class="button" value="Save">
            </form>
        </div>
        <div class="container" id="spellContainer">
            <div id="spellList">
                <?php
                    $sql = "SELECT * FROM spells WHERE player = '$player'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div id='spell'>";
                            echo "<h3>". $row["name"]. "</h3>";
                            echo "<div class='sDesc'><p>". $row["des"]. "</p></div>";
                            echo "<p>". $row["dmg"]. "</p>";
                            echo "<p>". $row["rang"]. "</p>";
                            echo "<p>". $row["cost"]. "</p>";
                            echo "</div>";
                        }
                    }
               ?>
            </div>
        </div>
    </div>
</div>




<script src="homePage.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "spellName", FILTER_SANITIZE_SPECIAL_CHARS);
    $dec = filter_input(INPUT_POST, "spellDesc", FILTER_SANITIZE_SPECIAL_CHARS);
    $dmg = filter_input(INPUT_POST, "spellDmg", FILTER_SANITIZE_SPECIAL_CHARS);
    $range = filter_input(INPUT_POST, "spellRange", FILTER_SANITIZE_SPECIAL_CHARS);
    $cost = filter_input(INPUT_POST, "spellCost", FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($name)) {
        echo "<div class='error'>Warning: Name is required</div>";
    }
    elseif (empty($dec)) {
        echo "<div class='error'>Warning: Description is required</div>";
    }
    elseif (empty($dmg)) {
        echo "<div class='error'>Warning: Damage is required</div>";
    }
    elseif (empty($cost)) {
        echo "<div class='error'>Warning: Cost is required</div>";
    }
    elseif (empty($range)) {
        echo "<div class='error'>Warning: Range is required</div>";
    }
    else {
        $sql = "INSERT INTO spells (player, name, dmg, cost, rang, des) VALUES ('$player','$name', '$dmg', '$cost','$range', '$dec')";
        try {
            mysqli_query($conn, $sql);
            header("location: home.php");
        }
        catch (mysqli_sql_exception) {
            echo "<div class='error'>Could not add spell, ask Kasuba</div>";
        }
    }
    
}
mysqli_close($conn);

?>