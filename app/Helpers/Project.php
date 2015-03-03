<?php namespace App\Helpers;


class Project {

    public static function getCategoriesByProjectId($project_id)
    {
        $user = \Auth::user();

        if (!$user) {
            return [];
        }

        /**
         * @var $project_model \App\Models\Project
         */
        $project_model = \App\Models\Project::where('id', '=', $project_id)->where('user_id', '=', $user->id)->first();

        if (!$project_model) {
            return [];
        }

        return $project_model->categories()->get();
    }


    public static function getPricingGridsByProjectId($project_id)
    {
        $user = \Auth::user();

        if (!$user) {
            return [];
        }

        /**
         * @var $project_model \App\Models\Project
         */
        $project_model = \App\Models\Project::where('id', '=', $project_id)->where('user_id', '=', $user->id)->first();

        if (!$project_model) {
            return [];
        }

        return $project_model->pricing_grids()->get();
    }

    public static function getAttributesGroups()
    {
        $user = \Auth::user();

        if (!$user) {
            return [];
        }

        $attributes_groups = \App\Models\AttributesGroup::where('user_id', '=', $user->id)->get();

        if (!$attributes_groups) {
            return [];
        }

        return $attributes_groups;
    }

}