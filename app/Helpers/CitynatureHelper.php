<?php namespace App\Helpers;


class CitynatureHelper {

    public static function getCatalogArrayFromCsvFile($csv_file)
    {
        $csv = file_get_contents( $csv_file);

        $csv_rows = explode("\n", $csv);

        $csv_rows = array_slice($csv_rows, 1, -1);

        $catalog = [];

        $previous_item_1 = '';
        $previous_item_2 = '';
        $previous_item_3 = '';
        $previous_item_4 = '';

        foreach ($csv_rows as $csv_row) {
            $cols = explode(";", $csv_row);

            $first_col = $cols[0];

            preg_match("/^([\s]+)/", $first_col, $matches);

            if (count($matches) < 2) {

                $catalog[$previous_item_1]['items'][$previous_item_2]['items'][$previous_item_3]['items'][$previous_item_4]['items'][] = [
                    'title' => trim($cols[1]),
                    'volume' => trim($cols[2]),
                    'price_1' => trim($cols[3]),
                    'price_2' => trim($cols[4]),
                    'price_3' => trim($cols[5]),
                    'price_4' => trim($cols[6]),
                    'price_5' => trim($cols[7]),
                    'price_6' => trim($cols[8]),
                    'price_7' => trim($cols[9]),
                ];

                continue;
            }

            $first_col = trim($first_col);

            $spaces_count = strlen($matches[1]);

            $catalog_item_key = md5(strtoupper($first_col));

            switch ($spaces_count) {
                case 1:
                    if (!array_key_exists($catalog_item_key, $catalog)) {
                        $catalog[$catalog_item_key] = [
                            'title' => $first_col,
                            'items' => []
                        ];
                    }
                    $previous_item_1 = $catalog_item_key;
                    break;
                case 2:
                    if (!array_key_exists($catalog_item_key, $catalog[$previous_item_1]['items'])) {
                        $catalog[$previous_item_1]['items'][$catalog_item_key] = [
                            'title' => $first_col,
                            'items' => []
                        ];
                    }
                    $previous_item_2 = $catalog_item_key;
                    break;
                case 4:
                    if (!array_key_exists($catalog_item_key, $catalog[$previous_item_1]['items'][$previous_item_2]['items'])) {
                        $catalog[$previous_item_1]['items'][$previous_item_2]['items'][$catalog_item_key] = [
                            'title' => $first_col,
                            'items' => []
                        ];
                    }
                    $previous_item_3 = $catalog_item_key;
                    break;
                case 6:
                    if (!array_key_exists($catalog_item_key, $catalog[$previous_item_1]['items'][$previous_item_2]['items'][$previous_item_3]['items'])) {
                        $catalog[$previous_item_1]['items'][$previous_item_2]['items'][$previous_item_3]['items'][$catalog_item_key] = [
                            'title' => $first_col,
                            'items' => []
                        ];
                    }
                    $previous_item_4 = $catalog_item_key;
                    break;
            }
        }

        return $catalog;
    }

}