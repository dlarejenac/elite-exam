@extends('layouts.app')

@section('title')
    Vanilla PHP Exam
@endsection

@section('php-question-1')
    <div class="max-w-2xl mx-auto mt-6">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Shortest Word Challenge – Vanilla PHP
            </h5>
            <?php
            function shortest_word_info($string) {
                $words = explode(' ', $string);
                $shortestWord = $words[0];

                foreach ($words as $word) {
                    if (strlen($word) < strlen($shortestWord)) {
                        $shortestWord = $word;
                    }
                }

                return [
                    'length' => strlen($shortestWord),
                    'word' => $shortestWord
                ];
            }

            // Test cases
            $testCases = [
                "TRUE FRIENDS ARE ME AND YOU",
                "I AM THE LEGENDARY VILLAIN"
            ];

            echo "<p class='text-gray-700 dark:text-gray-300 font-semibold mb-2'>TEST CASES:</p>";

            foreach ($testCases as $index => $case) {
                $result = shortest_word_info($case);
                echo "<div class='mb-4'>";
                echo "<p class='text-gray-800 dark:text-gray-200'><span class='font-medium'>TEST CASE:</span> ". $case ."</p>";
                echo "<p class='text-green-600 dark:text-green-400 font-bold'><span class='font-medium'>OUTPUT:</span> ". $result['length'] ." – BECAUSE THE SHORTEST WORD IS '" . $result['word'] . "'</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
@endsection

@section('php-question-2')
    <div class="max-w-2xl mx-auto mt-6">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Count the Islands – Vanilla PHP
            </h5>
            <?php
            function count_islands(&$grid) {
                $rows = count($grid);
                $cols = count($grid[0]);
                $count = 0;

                // Depth-First Search to mark visited 1's
                function dfs(&$grid, $i, $j, $rows, $cols) {
                    if ($i < 0 || $j < 0 || $i >= $rows || $j >= $cols || $grid[$i][$j] != 1) {
                        return;
                    }

                    $grid[$i][$j] = -1; // Mark as visited

                    // Explore all 4 directions
                    dfs($grid, $i + 1, $j, $rows, $cols);
                    dfs($grid, $i - 1, $j, $rows, $cols);
                    dfs($grid, $i, $j + 1, $rows, $cols);
                    dfs($grid, $i, $j - 1, $rows, $cols);
                }

                for ($i = 0; $i < $rows; $i++) {
                    for ($j = 0; $j < $cols; $j++) {
                        if ($grid[$i][$j] == 1) {
                            $count++;
                            dfs($grid, $i, $j, $rows, $cols);
                        }
                    }
                }

                return $count;
            }

            function stringify_grid($grid) {
                $output = "";
                foreach ($grid as $row) {
                    foreach ($row as $cell) {
                        $output .= ($cell == 0) ? '~' : 'X';
                    }
                    $output .= "<br>";
                }
                return $output;
            }

            // Test cases
            $matrix = [
                [1,1,1,1],
                [0,1,1,0],
                [0,1,0,1],
                [1,1,0,0]
            ];

            // Clone matrix to keep the original for printing
            $copy = $matrix;

            $islands = count_islands($copy);
            $stringified = stringify_grid($matrix);

            echo "<p class='text-gray-700 dark:text-gray-300 font-semibold mb-2'>TEST MATRIX:</p>";
            echo "<div class='bg-gray-100 dark:bg-gray-900 p-4 rounded text-mono text-lg text-black dark:text-white leading-tight'>";
            echo $stringified;
            echo "</div>";
            echo "<p class='text-green-600 dark:text-green-400 font-bold mt-4'>Number of islands found: " . $islands ."</p>";
            ?>
        </div>
    </div>
@endsection

@section('php-question-3')
<div class="max-w-2xl mx-auto mt-6">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            Word Search – Vanilla PHP
        </h5>
        <?php
        // Test cases
        $words = ["I", "TWO", "FORTY", "THREE", "JEN", "TWO", "tWo", "Two"];
        $target = "TWO";

        // Display test words with indices
        echo "<p class='text-gray-700 dark:text-gray-300 font-semibold mb-2'>WORDS ARRAY:</p>";
        echo "<div class='bg-gray-100 dark:bg-gray-900 p-4 rounded font-mono text-sm text-black dark:text-white leading-tight'>";
        foreach ($words as $index => $word) {
            echo "$index: $word<br>";
        }
        echo "</div>";

        // Find all indices where the target matches exactly
        $indices = [];
        foreach ($words as $index => $word) {
            if ($word === $target) {
                $indices[] = $index;
            }
        }

        echo "<p class='mt-4 text-gray-700 dark:text-gray-300 font-semibold mb-2'>TARGET: <span class='font-mono text-black dark:text-white'>" . $target . "</span></p>";

        echo "<p class='text-green-600 dark:text-green-400 font-bold'>OUTPUT: ";
        echo "INDEX " . implode(" and INDEX ", $indices);
        echo " // [" . implode(", ", $indices) . "]";
        echo "</p>";
        ?>
    </div>
</div>
@endsection