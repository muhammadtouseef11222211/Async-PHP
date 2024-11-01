<?php

class KeyValueStore {
    private $currentSpace = null;
    private $baseDir = __DIR__ . '/spaces/';
    private $ttlData = [];

    public function __construct() {
        if (!is_dir($this->baseDir)) {
            mkdir($this->baseDir, 0755, true);
        }
    }

    // Create a new space
    public function createSpace($name) {
        $file = $this->getSpaceFile($name);
        if (!file_exists($file)) {
            touch($file);
            echo "Space $name created.\n";
        } else {
            echo "Space $name already exists.\n";
        }
    }

    // Delete a space
    public function deleteSpace($name) {
        $file = $this->getSpaceFile($name);
        if (file_exists($file)) {
            unlink($file);
            echo "Space $name deleted.\n";
            if ($this->currentSpace === $file) {
                $this->currentSpace = null;
            }
        } else {
            echo "Space $name does not exist.\n";
        }
    }

    // Use a specific space
    public function useSpace($name) {
        $file = $this->getSpaceFile($name);
        if (file_exists($file)) {
            $this->currentSpace = $file;
            echo "Using space $name.\n";
        } else {
            echo "Space $name does not exist.\n";
        }
    }

    // Set a key-value pair with optional TTL
    public function setKeyValue($key, $value, $ttl = null) {
        if (!$this->checkSpace()) return;

        $data = $this->readSpace();
        $data[$key] = $value;
        $this->writeSpace($data);

        if ($ttl) {
            $this->ttlData[$key] = time() + $ttl;
        }

        echo "Set key $key with value $value.\n";
    }

    // Get a key's value
    public function getKeyValue($key) {
        if (!$this->checkSpace()) return;

        $this->checkExpiredKeys();
        $data = $this->readSpace();

        if (isset($data[$key])) {
            echo "Value of key $key: " . $data[$key] . "\n";
        } else {
            echo "Key $key does not exist.\n";
        }
    }

    // Multi-Set: Set multiple key-value pairs
    public function multiSet($keyValues) {
        if (!$this->checkSpace()) return;

        foreach ($keyValues as $key => $value) {
            $this->setKeyValue($key, $value);
        }

        echo "Multi-set operation completed.\n";
    }

    // Multi-Get: Get multiple key values
    public function multiGet($keys) {
        if (!$this->checkSpace()) return;

        $this->checkExpiredKeys();
        $data = $this->readSpace();
        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $data[$key] ?? null;
        }

        echo "Multi-get results: \n";
        print_r($result);
    }

    // Check if a key exists
    public function keyExists($key) {
        if (!$this->checkSpace()) return;

        $data = $this->readSpace();
        if (isset($data[$key])) {
            echo "Key $key exists.\n";
        } else {
            echo "Key $key does not exist.\n";
        }
    }

    // Get all keys
    public function getAllKeys() {
        if (!$this->checkSpace()) return;

        $data = $this->readSpace();
        echo "All keys in the current space:\n";
        foreach (array_keys($data) as $key) {
            echo "- $key\n";
        }
    }

    // Show all spaces
    public function showAllSpaces() {
        $spaces = array_diff(scandir($this->baseDir), ['.', '..']);
        echo "All spaces:\n";
        foreach ($spaces as $space) {
            echo "- " . pathinfo($space, PATHINFO_FILENAME) . "\n";
        }
    }

    // Delete a key
    public function deleteKeyValue($key) {
        if (!$this->checkSpace()) return;

        $data = $this->readSpace();
        if (isset($data[$key])) {
            unset($data[$key]);
            $this->writeSpace($data);
            echo "Key $key deleted.\n";
        } else {
            echo "Key $key does not exist.\n";
        }
    }

    // Set TTL for a key
    public function setTTL($key, $ttl) {
        if (!$this->checkSpace()) return;

        $this->ttlData[$key] = time() + $ttl;
        echo "Set TTL for key $key to $ttl seconds.\n";
    }

    // Backup the current space
    public function backupSpace($backupFile) {
        if (!$this->checkSpace()) return;

        copy($this->currentSpace, $this->baseDir . $backupFile);
        echo "Backup created as $backupFile.\n";
    }

    // Restore a space from a backup
    public function restoreSpace($backupFile) {
        $backupPath = $this->baseDir . $backupFile;
        if (file_exists($backupPath)) {
            copy($backupPath, $this->currentSpace);
            echo "Restored space from $backupFile.\n";
        } else {
            echo "Backup file $backupFile does not exist.\n";
        }
    }

    // Get memory statistics
    public function memoryStats() {
        if (!$this->checkSpace()) return;

        $data = $this->readSpace();
        $size = filesize($this->currentSpace);
        $count = count($data);

        echo "Memory Statistics:\n";
        echo "- Number of keys: $count\n";
        echo "- File size: $size bytes\n";
    }

    // Check for expired keys
    private function checkExpiredKeys() {
        $currentTime = time();
        foreach ($this->ttlData as $key => $expiry) {
            if ($currentTime > $expiry) {
                $this->deleteKeyValue($key);
                unset($this->ttlData[$key]);
                echo "Key $key has expired and was deleted.\n";
            }
        }
    }

    // Get the file path for a space
    private function getSpaceFile($name) {
        return $this->baseDir . $name . '.csv';
    }

    // Read data from the current space
    private function readSpace() {
        $data = [];
        if (($handle = fopen($this->currentSpace, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $data[$row[0]] = $row[1];
            }
            fclose($handle);
        }
        return $data;
    }

    // Write data to the current space
    private function writeSpace($data) {
        $handle = fopen($this->currentSpace, 'w');
        foreach ($data as $key => $value) {
            fputcsv($handle, [$key, $value]);
        }
        fclose($handle);
    }

    // Check if a space is in use
    private function checkSpace() {
        if (!$this->currentSpace) {
            echo "No space is currently in use. Use 'use space <name>' to select a space.\n";
            return false;
        }
        return true;
    }
}

// CLI Interaction
$store = new KeyValueStore();
echo "Welcome to the Enhanced PHP Key-Value Store!\n";
echo "Type 'help' for commands.\n";

while (true) {
    echo "phpdb> ";
    $input = trim(fgets(STDIN));
    
    // Check for empty input
    if ($input === '') {
        continue;  // Skip to the next iteration for empty input
    }

    $parts = explode(' ', $input);
    $command = strtolower($parts[0]);

    switch ($command) {
        case 'create':
            if ($parts[1] === 'space' && isset($parts[2])) {
                $store->createSpace($parts[2]);
            }
            break;
        case 'delete':
            if ($parts[1] === 'space' && isset($parts[2])) {
                $store->deleteSpace($parts[2]);
            } elseif (isset($parts[1])) {
                $store->deleteKeyValue($parts[1]);
            }
            break;
        case 'use':
            if ($parts[1] === 'space' && isset($parts[2])) {
                $store->useSpace($parts[2]);
            }
            break;
        case 'set':
            if (isset($parts[1]) && isset($parts[2])) {
                $ttl = isset($parts[3]) ? (int)$parts[3] : null;
                $store->setKeyValue($parts[1], $parts[2], $ttl);
            }
            break;
        case 'get':
            if (isset($parts[1])) {
                $store->getKeyValue($parts[1]);
            }
            break;
        case 'ttl':
            if (isset($parts[1]) && isset($parts[2])) {
                $store->setTTL($parts[1], (int)$parts[2]);
            }
            break;
        case 'exists':
            if (isset($parts[1])) {
                $store->keyExists($parts[1]);
            }
            break;
        case 'allkeys':
            $store->getAllKeys();
            break;
        case 'allspaces':
            $store->showAllSpaces();
            break;
        case 'multiset':
            $keyValues = array_slice($parts, 1);
            $pairs = [];
            foreach (array_chunk($keyValues, 2) as $kv) {
                $pairs[$kv[0]] = $kv[1] ?? null;
            }
            $store->multiSet($pairs);
            break;
        case 'multiget':
            $keys = array_slice($parts, 1);
            $store->multiGet($keys);
            break;
        case 'backup':
            if (isset($parts[1])) {
                $store->backupSpace($parts[1]);
            }
            break;
        case 'restore':
            if (isset($parts[1])) {
                $store->restoreSpace($parts[1]);
            }
            break;
        case 'memory':
            $store->memoryStats();
            break;
        case 'help':
            echo "Commands:\n";
            echo "- create space <name>\n";
            echo "- delete space <name>\n";
            echo "- use space <name>\n";
            echo "- set <key> <value> [ttl]\n";
            echo "- get <key>\n";
            echo "- delete <key> | delete space <name>\n";
            echo "- ttl <key> <seconds>\n";
            echo "- exists <key>\n";
            echo "- allkeys\n";
            echo "- allspaces\n";
            echo "- multiset <key1> <value1> <key2> <value2> ...\n";
            echo "- multiget <key1> <key2> ...\n";
            echo "- backup <filename>\n";
            echo "- restore <filename>\n";
            echo "- memory\n";
            echo "- help\n";
            echo "- exit\n";
            break;
        case 'exit':
            exit("Exiting the PHP Key-Value Store.\n");
        default:
            echo "Unknown command. Type 'help' for the list of commands.\n";
            break;
    }
}

