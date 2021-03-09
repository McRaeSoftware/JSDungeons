<?php
function CreateCharacter($userid)
{
  if ($_COOKIE['cookiebar'] == "CookieAllowed") // User Has Accepted Cookie policy
  {
    if (isset($_POST["createCharacterSubmit"]))
    {
      Require 'connection.php';

      $name = (filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
      $alignment = (filter_input(INPUT_POST, 'alignment', FILTER_SANITIZE_STRING));
      $race = (filter_input(INPUT_POST, 'race', FILTER_SANITIZE_STRING));
      $class = (filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING));
      $exp = (filter_input(INPUT_POST, 'exp', FILTER_SANITIZE_STRING));
      $ac = (filter_input(INPUT_POST, 'ac', FILTER_SANITIZE_STRING));
      $hp = (filter_input(INPUT_POST, 'hp', FILTER_SANITIZE_STRING));
      $STR = (filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_STRING));
      $DEX = (filter_input(INPUT_POST, 'dexterity', FILTER_SANITIZE_STRING));
      $CON = (filter_input(INPUT_POST, 'constitution', FILTER_SANITIZE_STRING));
      $INT = (filter_input(INPUT_POST, 'intelligence', FILTER_SANITIZE_STRING));
      $WIS = (filter_input(INPUT_POST, 'wisdom', FILTER_SANITIZE_STRING));
      $CHA = (filter_input(INPUT_POST, 'charisma', FILTER_SANITIZE_STRING));

      $armour = (filter_input(INPUT_POST, 'armour', FILTER_SANITIZE_STRING));
      $weapon = (filter_input(INPUT_POST, 'weapon', FILTER_SANITIZE_STRING));
      $equipmentNote = (filter_input(INPUT_POST, 'equipmentNote', FILTER_SANITIZE_STRING));

      $pp = (filter_input(INPUT_POST, 'pp', FILTER_SANITIZE_STRING));
      $gp = (filter_input(INPUT_POST, 'gp', FILTER_SANITIZE_STRING));
      $sp = (filter_input(INPUT_POST, 'sp', FILTER_SANITIZE_STRING));
      $cp = (filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_STRING));
      $bagNote = (filter_input(INPUT_POST, 'bagNote', FILTER_SANITIZE_STRING));

      $known = (filter_input(INPUT_POST, 'known', FILTER_SANITIZE_STRING));
      $spellsNote = (filter_input(INPUT_POST, 'spellsNote', FILTER_SANITIZE_STRING));

      $savingThrows = "";
      $proficiencies = "";
      $languages = "";

      $notesNote = (filter_input(INPUT_POST, 'notesNote', FILTER_SANITIZE_STRING));

      // for each index in the savingThrows array create a single String
      for($i = 0; $i < sizeof($_POST['savingThrow']); $i++)
      {
        $savingThrows = $savingThrows." ".$_POST['savingThrow'][$i].",";
      }
      $savingThrows = rtrim($savingThrows, ','); // Remove the last comma added in the above foreach

      // for each index in the proficiency array create a single String
      for($i = 0; $i < sizeof($_POST['proficiency']); $i++)
      {
        $proficiencies = $proficiencies." ".$_POST['proficiency'][$i].",";
      }
      $proficiencies = rtrim($proficiencies, ','); // Remove the last comma added in the above foreach

      // for each index in the language array creata a single string
      for($i = 0; $i < sizeof($_POST['language']); $i++)
      {
        $languages = $languages." ".$_POST['language'][$i].",";
      }
      $languages = rtrim($languages, ','); // Remove the last comma added in the above foreach

      $lvl = ExpToLevel($exp);

      $Error = false;
      $NameError;
      $expError;
      $acError;
      $hpError;

      if(!preg_match("/^[a-zA-Z0-9\s]*$/", $name))//Name Must contain only letters & spaces
      {
        $Error = true;
        $NameError = ":Name Must Contain only letters and spaces";
      }
      if(!preg_match("/^[0-9]*$/", $exp))//Name Must contain only numbers
      {
        $Error = true;
        $expError = ":EXP must only be a number e.g. 24000";
      }
      if(!preg_match("/^[0-9]*$/", $ac))//Name Must contain only letters & spaces
      {
        $Error = true;
        $acError = ":AC must only be a number e.g. 25";
      }
      if(!preg_match("/^[0-9]*$/", $hp))//Name Must contain only letters & spaces
      {
        $Error = true;
        $hpError = ":HP must only be a number e.g. 42";
      }

    }

    if($Error == true) // An Error Has Occured
    {
      $errorString = $nameError.$expError.$acError.$hpError;
      header('Location: ../View/createCharacter.php?error='.$errorString);
    }
    else // Continue with the character creation
    {
      $code = GenerateUniqueCode($userid);

      $query = $connection->prepare
      ("

      INSERT INTO Player_Character (User_ID, Code, Name, Alignment, Exp, Level, RaceName, ClassName, AC, Max_HP, HP, Strength, Dexterity, Constitution, Intelligence, Wisdom, Charisma, Saving_Throws, Proficiencies, Language)
      VALUES(:user_id, :code, :name, :alignment, :exp, :lvl, :race, :class, :ac, :maxhp, :hp, :str, :dex, :con, :int, :wis, :cha, :savingThrows, :proficiencies, :languages)

      ");

      // Runs and executes the query
      $success = $query->execute
      ([
        'user_id' => $userid,
        'code' => $code,
        'name' => $name,
        'alignment' => $alignment,
        'exp' => $exp,
        'lvl' => $lvl,
        'race' => $race,
        'class' => $class,
        'ac' => $ac,
        'maxhp' => $hp,
        'hp' => $hp,
        'str' => $STR,
        'dex' => $DEX,
        'con' => $CON,
        'int' => $INT,
        'wis' => $WIS,
        'cha' => $CHA,
        'savingThrows' => $savingThrows,
        'proficiencies' => $proficiencies,
        'languages' => $languages
      ]);

      // If rows returned is more than 0 Let us know if it inserted or not.
      if($success && $query->rowCount() > 0)
      {
        EquipItems($code, $armour, $weapon);
        LearnSpells($code, $known);
        TakeNotes($code, $equipmentNote, $bagNote, $spellsNote, $notesNote);
        GiveMoney($code, $pp, $gp, $sp, $cp);
        //header('location: ../View/index.php');
      }
      else
      {
        echo "oops, something went wrong";
        //print_r($query->errorInfo());
      }
    }
  }
  else // User has NOT accepted cookie policy
  {
    // redirect user to the register page with an error
    $errorString = ":You Must Accept the Cookie policy and login to create a character.";
    header('Location: ../View/userLogin.php?error='.$errorString);
  }
}
?>
