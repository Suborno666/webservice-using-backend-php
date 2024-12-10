<?php
abstract class GameCharacter {
    protected string $name;
    protected int $health;
    protected int $level;

    abstract function attack(): void;
    abstract function defense(): void;

    function __construct(string $name, int $initialHealth) {
        $this->name = $name;
        $this->level = 1;
        $this->health = $initialHealth;
    }

    function __get($property) {
 
        if (!property_exists($this, $property)) {

            $className = get_class($this);
            throw new Exception("Property '$property' does not exist in class $className");
        }
        
        return $this->$property;
    }


    function debugInfo() {
        return [
            'class' => get_class($this),
            'name' => $this->name,
            'health' => $this->health,
            'level' => $this->level
        ];
    }
}

class Warrior extends GameCharacter {
    private string $weaponType;

    function __construct(string $warriorName, string $weaponType) {
        parent::__construct($warriorName, 100);
        $this->weaponType = $weaponType;
    }

    function attack(): void {
        echo "{$this->name} attacked with {$this->weaponType}.\n";
    }

    function defense(): void {
        echo "{$this->name} raised up a shield to defend!\n";
    }
}

try {
    $warrior = new Warrior("Raolf", "Longsword");
    
    
    try {
        $nonExistentProperty = $warrior->invalidProperty;
    } catch (Exception $e) {
        echo "Caught error: " . $e->getMessage() . "\n";
    }

    // Debugging
    print_r($warrior->debugInfo());
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}