<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'requiredEmail' && empty($value)) {
//                    $this->addError("Neįvesti duomenys <b>{$item}</b> laukelyje");
                    $this->addError("Neįvesti duomenys <b>El. paštas</b> laukelyje");
                } elseif($rule === 'requiredPassword' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Slaptažodžio</b> laukelyje");
                }elseif($rule === 'requiredName' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Vardo</b> laukelyje");
                }elseif($rule === 'requiredSurname' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Pavardės</b> laukelyje");
                }elseif($rule === 'requiredDepartment' && empty($value)){
                    $this->addError("Nepasirinkti duomenys <b>Skyriaus</b> laukelyje");
                }elseif($rule === 'requiredPost' && empty($value)){
                    $this->addError("Nepasirinkti duomenys <b>Pareigybės</b> laukelyje");
                }elseif($rule === 'requiredRole' && empty($value)){
                    $this->addError("Nepasirinkti duomenys <b>Darbuotojo rolės</b> laukelyje");
                }elseif($rule === 'required_password_current' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Senojo slaptažodžio</b> laukelyje");
                }elseif($rule === 'required_password_new' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Naujojo slaptažodžio</b> laukelyje");
                }elseif($rule === 'required_password_new_again' && empty($value)){
                    $this->addError("Neįvesti duomenys kartojant <b>Naująjį slaptažodį</b>");
                }elseif($rule === 'required_title' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Užduoties pavadinimo</b> laukelyje");
                }elseif($rule === 'required_task' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>Užduoties aprašymo</b> laukelyje");
                }elseif(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>{$item}</b> turi būti mažiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'minName':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>Vardas</b> turi būti mažiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'minSurname':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>Pavardė</b> turi būti mažiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'minPassword':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>Slaptažodis</b> turi būti mažiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'minPasswordNew':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>Naujas slaptažodis</b> turi būti mažiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'minPasswordNewAgain':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>Pakartotas naujas slaptažodis</b> turi būti mažiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>{$item}</b> turi būti daugiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'maxName':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>Vardas</b> turi būti daugiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'maxSurname':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>Pavardė</b> turi būti daugiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'maxPassword':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>Slaptažodis</b> turi būti daugiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'maxPasswordNew':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>Naujas slaptažodis</b> turi būti daugiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'maxPasswordNewAgain':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>Pakartotas naujas slaptažodis</b> turi būti daugiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'maxEmail':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>El. paštas</b> turi būti daugiausiai <b>{$rule_value}</b> simbolių ilgio");
                            }
                        break;

                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("<b>{$rule_value}</b> turi sutapti su <b>{$item}</b>");
                            }
                        break;

                        case 'matchesPasswordNewAgain':
                            if($value != $source[$rule_value]){
                                $this->addError("Abu <b>slaptažodžiai</b> turi sutapti");
                            }
                            break;

                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()){
                                $this->addError("<b>{$item}</b> - toks el. paštas jau yra įvestas sistemoje");
                            }
                        break;

                        case 'uniqueEmail':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()){
                                $this->addError("Toks <b>el. paštas</b> jau yra įvestas duomenų bazėje");
                            }
                        break;

                        case 'oneNumber':
                            if($rule === 'oneNumber' && !preg_match("/\d/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent vienas skaičius");
                            }
                        break;

                        case 'oneNumberPassword':
                            if($rule === 'oneNumberPassword' && !preg_match("/\d/", $value)){
                                $this->addError("<b>Slaptažodyje</b> privalo būti bent vienas skaičius");
                            }
                        break;

                        case 'oneNumberNew':
                            if($rule === 'oneNumberNew' && !preg_match("/\d/", $value)){
                                $this->addError("<b>Naujajame slaptažodyje</b> privalo būti bent vienas skaičius");
                            }
                        break;

                        case 'oneNumberNewAgain':
                            if($rule === 'oneNumberNewAgain' && !preg_match("/\d/", $value)){
                                $this->addError("Kartojant <b>naująjį slaptažodį</b> privalo būti bent vienas skaičius");
                            }
                        break;

                        case 'oneBigLetter':
                            if($rule === 'oneBigLetter' && !preg_match("/[A-Z]/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent viena didžioji raidė");
                            }
                        break;

                        case 'oneBigLetterPassword':
                            if($rule === 'oneBigLetterPassword' && !preg_match("/[A-Z]/", $value)){
                                $this->addError("<b>Slaptažodyje</b> privalo būti bent viena didžioji raidė");
                            }
                        break;

                        case 'oneBigLetterNew':
                            if($rule === 'oneBigLetterNew' && !preg_match("/[A-Z]/", $value)){
                                $this->addError("<b>Naujajame slaptažodyje</b> privalo būti bent viena didžioji raidė");
                            }
                        break;

                        case 'oneBigLetterNewAgain':
                            if($rule === 'oneBigLetterNewAgain' && !preg_match("/[A-Z]/", $value)){
                                $this->addError("Kartojant <b>naująjį slaptažodį</b> privalo būti bent viena didžioji raidė");
                            }
                        break;

                        case 'oneSmallLetter':
                            if($rule === 'oneSmallLetter' && !preg_match("/[a-z]/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent viena mažoji raidė");
                            }
                        break;

                        case 'oneSmallLetterPassword':
                            if($rule === 'oneSmallLetterPassword' && !preg_match("/[a-z]/", $value)){
                                $this->addError("<b>Slaptažodyje</b> privalo būti bent viena mažoji raidė");
                            }
                            break;

                        case 'oneSmallLetterNew':
                            if($rule === 'oneSmallLetterNew' && !preg_match("/[a-z]/", $value)){
                                $this->addError("<b>Naujajame slaptažodyje</b> privalo būti bent viena mažoji raidė");
                            }
                        break;

                        case 'oneSmallLetterNewAgain':
                            if($rule === 'oneSmallLetterNewAgain' && !preg_match("/[A-Z]/", $value)){
                                $this->addError("Kartojant <b>naująjį slaptažodį</b> privalo būti bent viena didžioji raidė");
                            }
                        break;

                        case 'oneSpecialSymbol':
                            if($rule === 'oneSpecialSymbol' && !preg_match("/\W/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent vienas specialusis simbolis");
                            }
                        break;

                        case 'oneSpecialSymbolPassword':
                            if($rule === 'oneSpecialSymbolPassword' && !preg_match("/\W/", $value)){
                                $this->addError("<b>Slaptažodyje</b> privalo būti bent vienas specialusis simbolis");
                            }
                        break;

                        case 'oneSpecialSymbolNew':
                            if($rule === 'oneSpecialSymbolNew' && !preg_match("/[a-z]/", $value)){
                                $this->addError("<b>Naujajame slaptažodyje</b> privalo būti bent vienas specialusis simbolis");
                            }
                        break;

                        case 'oneSpecialSymbolNewAgain':
                            if($rule === 'oneSpecialSymbolNewAgain' && !preg_match("/[a-z]/", $value)){
                                $this->addError("Kartojant <b>naująjį slaptažodį</b> privalo būti bent vienas specialusis simbolis");
                            }
                        break;

                        case 'noSpaces':
                        if($rule === 'noSpaces' && preg_match("/\s/", $value)){
                            $this->addError("Slaptažodyje negali būti įterptų  tuščių tarpų");
                        }
                        break;

                        case 'noSpacesPassword':
                            if($rule === 'noSpacesPassword' && preg_match("/\s/", $value)){
                                $this->addError("<b>Slaptažodyje</b> negali būti įterptų  tuščių tarpų");
                            }
                        break;

                        case 'noSpacesNew':
                            if($rule === 'noSpacesNew' && preg_match("/\s/", $value)){
                                $this->addError("<b>Naujajame slaptažodyje</b> negali būti įterptų  tuščių tarpų");
                            }
                        break;

                        case 'noSpacesNewAgain':
                            if($rule === 'noSpacesNewAgain' && preg_match("/\s/", $value)){
                                $this->addError("Kartojant <b>naująjį slaptažodį</b> negali būti įterptų  tuščių tarpų");
                            }
                        break;

                        case 'matchesEmailRule':
                            if($rule === 'matchesEmailRule' && !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $value)){
                                $this->addError("Įvestas <b>el. paštas</b> neatitinka elektroninio pašto reikalavimų");
                            }
                        break;
                    }
                }          
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
}