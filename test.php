<?php
if ($argc < 2) {
    echo "Usage: php list.php /path/to/folder\n";
    exit(1);
}

$folder = $argv[1];

if (!is_dir($folder)) {
    echo "Error: Folder does not exist: $folder\n";
    exit(1);
}

function printFolder($folder, $indent = "")
{
    $items = scandir($folder);

    foreach ($items as $item) {
        if ($item === "." || $item === "..") {
            continue;
        }

        $path = $folder . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            echo $indent . "[DIR]  " . $item . "\n";
            printFolder($path, $indent . "    ");
        } else {
            echo $indent . "[FILE] " . $item . "\n";
        }
    }
}

echo "Folder: " . realpath($folder) . "\n";
echo "----------------------------------------\n";

printFolder($folder);
