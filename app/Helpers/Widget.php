<?php namespace App\Helpers;

class Widget {

    /**
     * Выводит содержимое виджета
     * @param $widget_name
     * @return string
     */
    public static function render($widget_name)
    {
        $widget_model = \App\Models\Widget::where('name', '=', $widget_name)->first();

        if (!$widget_model) {
            return "Виджет {$widget_name} не найден";
        }

        $widget_handler_name = $widget_model->handler;

        if (!class_exists($widget_handler_name)) {
            return "Обработчик виджета {$widget_name} не найден";
        }

        if (!method_exists($widget_handler_name, 'render')) {
            return "Обработчик виджета {$widget_name} не имеет метод render";
        }

        $widget_handler_obj = new $widget_handler_name;

        return $widget_handler_obj->render();
    }

    /**
     * Выводит содержимое региона
     * @param $region_name
     * @return string
     */
    public static function region($region_name)
    {
        $widgets_models_arr = \App\Models\Widget::where('region', '=', $region_name)->where('status', '=', 1)->orderBy('position')->get();

        if (empty($widgets_models_arr)) {
            return '';
        }

        $output = '';

        foreach ($widgets_models_arr as $widget_model) {
            $widget_handler_name = $widget_model->handler;

            if (!class_exists($widget_handler_name)) {
                continue;
            }

            if (!method_exists($widget_handler_name, 'render')) {
                continue;
            }

            $widget_handler_obj = new $widget_handler_name;

            $output .= $widget_handler_obj->render();
        }

        return $output;
    }

} 