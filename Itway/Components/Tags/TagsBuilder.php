<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 26.12.2015
 * Time: 12:06
 */

namespace Itway\components\Tags;


class TagsBuilder
{
    protected $instance;

    /**
     * TagsBuilder constructor.
     * @param $instance
     */
    public function __construct($instance = null)
    {
        $this->instance = $instance;
    }

    /**
     * by default select isn't multiple
     *
     * @param null $placeholder
     * @param array $selected
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagsTechSelect($placeholder = null, array $selected = [], $class = null, $attrName = null)
    {
        $attrName = $this->resolveAttrName($attrName) ? $attrName : "tags_list";
        $class = isset($class) ? $class : "tags";
        return $this->tagsTechSingleSelect($placeholder, $selected, $attrName, $class);
    }

    /**
     * single technologies select
     *
     * @param null $placeholder
     * @param array $selected
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagsTechSingleSelect($placeholder = null, array $selected = [],  $class = null, $attrName = null)
    {
        $result = config('tags_tech');
        $attrName = $this->resolveAttrName($attrName) ? $attrName : "tags_list";
        $class = isset($class) ? $class : "tags";
        return view('includes.tags-select', compact('result', 'placeholder', 'selected', 'attrName', 'class'));
    }

    /**
     * multiple technologies select
     *
     * @param null $placeholder
     * @param array $selected
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagsTechMultipleSelect($placeholder = null, array $selected = [], $class = null, $attrName = null)
    {
        $result = config('tags_tech');
        $multiple = true;
        $attrName = $this->resolveAttrName($attrName) ? $attrName : "tags_list[]";
        $class = isset($class) ? $class : "tags";
        return view('includes.tags-select', compact('result', 'placeholder', 'selected', 'multiple', 'attrName', 'class'));
    }

    /**
     * single trends select
     * @param null $placeholder
     * @param array $selected
     * @param null $attrName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagsTrendsSingleSelect($placeholder = null, array $selected = [],  $class = null, $attrName = null)
    {
        $result = config('tags_trends');
        $trend = true;
        $attrName = $this->resolveAttrName($attrName) ? $attrName : "trend";
        $class = isset($class) ? $class : "tagsTrend";
        return view('includes.tags-select', compact('result', 'placeholder', 'selected', 'trend', 'attrName', 'class'));
    }

    /**
     * multiple trends select
     *
     * @param null $placeholder
     * @param array $selected
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagsTrendsMultipleSelect($placeholder = null, array $selected = [],  $class = null, $attrName = null)
    {
        $result = config('tags_trends');
        $multiple = true;
        $trend = true;
        $attrName = $this->resolveAttrName($attrName) ? $attrName : "trend[]";
        $class = isset($class) ? $class : "tagsTrend";
        return view('includes.tags-select', compact('result', 'placeholder', 'selected', 'multiple', 'trend', 'attrName','class'));
    }

    protected function resolveAttrName($attrName = null) {

        if(isset($attrName)) {
            return $attrName;
        }
        else return false;
    }

}