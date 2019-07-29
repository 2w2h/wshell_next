<?php

namespace UnitBundle\Tool;

// TODO: dimension
class UIMapper
{
    private $input;
    private $modes;
    private $signatures = [
        'email'    => '#^.+\@.+\..+$#',
        'color'    => '#^\#[0-9a-f]{6}$#',
        'time'     => '#^[0-9]{2}\/[0-9]{2}\/\-?[0-9]{4} [0-9]{1,2}:[0-9]{2} (AM|PM)$#',
        'big_text' => '#^.*$#us',
        'number'   => '#^-?[0-9]+(\.[0-9]+)?$#',
    ];
    private $templates = [
        // args
        'email'    => '<div class="form-group %MODE%"><div class="input-group"><div class="input-group-addon">@</div><input type="text" class="form-control" placeholder="%VNAME%" name="%NAME%" value="%VALUE%"></div></div>',
        'color'    => '<div class="form-group %MODE%"><div class="input-group"><span class="input-group-addon"><span>%VNAME%</span></span><input type="color" class="form-control" value="%VALUE%" name="%NAME%"/></div></div>',
        'time'     => '<div class="form-group %MODE%"><div class="input-group date datetimepicker"><input type="text" class="form-control" placeholder="%VNAME%" name="%NAME%" value="%VALUE%"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div>',
        'big_text' => '<div class="form-group %MODE%"><textarea class="form-control" placeholder="%VNAME%" name="%NAME%" rows="8">%VALUE%</textarea></div>',
        'number'   => '<div class="form-group %MODE%"><div class="row"><div class="col-xs-4"><input type="text" class="form-control" placeholder="%VNAME%" name="%NAME%" value="%VALUE%"></div></div></div>',

        'text'     => '<div class="form-group %MODE%"><input type="text" class="form-control" placeholder="%VNAME%" name="%NAME%" value="%VALUE%"></div>',
        'boolean'  => '<div class="form-group %MODE%"><input type="hidden" value="0" name="%NAME%"/><input type="checkbox" %VALUE% name="%NAME%" data-toggle="toggle" data-onstyle="default" data-on="%VNAME% ON" data-off="%VNAME% OFF"></div>',
        'select'   => '',

        // special
        'mode'     => '<label class="btn btn-default mode_toogle %ACTIVE%"><input type="radio" name="mode" value="%NAME%" %CHECKED%/>%VALUE%</label>'
    ];
    // uses in build view
    private $structModes = [];

    function __construct($hookup)
    {
        $this->input = $hookup['input'];
        if (isset($hookup['mode'])) {
            $this->modes = $hookup['mode'];
        }

        // replace hookup info to view
        foreach ($this->input as $name => $value) {
            $curIsStruct = false;

            if (is_null($value)) {
                $this->input[$name] = $this->replace($this->templates['text'], [
                    'VNAME' => $name,
                    'NAME' => $name,
                    'VALUE' => ''
                ]);
            } else {
                if ($value === true || $value === false) {
                    $val = ($value) ? 'checked':'';
                    $this->input[$name] = $this->replace($this->templates['boolean'], [
                        'VNAME' => $name,
                        'NAME' => $name,
                        'VALUE' => $val
                    ]);
                } else {

                    if (isset($value['elem'])) {
                        $this->elemReplace($name, $value);
                    } elseif (isset($value['map'])) {
                        // START structure
                        $this->input[$name] = [];

                        $nodes = [];
                        $this->findParamsInMap($value['map'], $nodes, $name);

                        foreach ($nodes as $key => $node) {
                            $pathKey = str_replace($name.':', '', $key);

                            if (is_null($node)) {
                                $this->input[$name][$pathKey] = $this->replace($this->templates['text'], [
                                    'VNAME' => $name,
                                    'NAME' => $key,
                                    'VALUE' => ''
                                ]);
                            } else {
                                if ($node === true || $node === false) {
                                    $val = ($node) ? 'checked':'';
                                    $this->input[$name][$pathKey] = $this->replace($this->templates['boolean'], [
                                        'VNAME' => $name,
                                        'NAME' => $key,
                                        'VALUE' => $val
                                    ]);
                                } else {
                                    if (isset($node['elem'])) {
                                        $this->elemReplace($key, $node, $pathKey);
                                    } else {
                                        throw new \Exception("no simple and no map", 1);
                                    }
                                    // check dimension
                                }
                            }
                            // set mode classes
                            $classes = $this->generateClasses($name);
                            $this->input[$name][$pathKey] = $this->replace($this->input[$name][$pathKey], ['MODE' => 'arg_input' . $classes]);
                        }
                        $curIsStruct = true;
                        // END structure

                    } else {
                        throw new \Exception("no simple and no map", 1);
                    }
                    // check dimension
                }
            }

            // set mode classes
            if ($curIsStruct) {
                $this->structModes[$name] = 'arg_input' . $this->generateClasses($name);
            } else {
                $classes = $this->generateClasses($name);
                $this->input[$name] = $this->replace($this->input[$name], ['MODE' => 'arg_input' . $classes]);
            }
        }
    }

    private function generateClasses($name)
    {
        $classes = '';
        if ($this->modes) {
            foreach ($this->modes as $mode => $modeArgs) {
                foreach ($modeArgs as $arg) {
                    if ($arg == $name) {
                        $classes .= ' mode_' . $mode;
                    }
                }
            }
        }
        return $classes;
    }

    private function elemReplace($name, $value, $pathKey = false)
    {
        $vname = $name;
        if ($pathKey) {
            $arr = explode(':', $name);
            $vname = array_pop($arr);
            $paramName = str_replace(':'.$pathKey, '', $name);
        }

        $finded = false;
        foreach ($this->signatures as $signature => $regex) {
            if ($value['elem'] == $regex) {
                if ($pathKey) {
                    $this->input[$paramName][$pathKey] = $this->replace($this->templates[$signature], [
                        'VNAME' => $vname,
                        'NAME' => $name
                    ]);
                } else {
                    $this->input[$name] = $this->replace($this->templates[$signature], [
                        'VNAME' => $vname,
                        'NAME' => $name
                    ]);
                }

                $finded = true;
            }
        }
        if (!$finded) {
            if ($pathKey) {
                $this->input[$paramName][$pathKey] = $this->replace($this->templates['text'], [
                    'VNAME' => $vname,
                    'NAME' => $name
                ]);
            } else {
                $this->input[$name] = $this->replace($this->templates['text'], [
                    'VNAME' => $vname,
                    'NAME' => $name
                ]);
            }
        }

        $val = isset($value['norm']) ? $value['norm'] : '';
        if ($pathKey) {
            $this->input[$paramName][$pathKey] = $this->replace($this->input[$paramName][$pathKey], ['VALUE' => $val]);
        } else {
            $this->input[$name] = $this->replace($this->input[$name], ['VALUE' => $val]);
        }
    }

    private function findParamsInMap($map, &$acc, &$prefix)
    {
        if (is_array($map)) {
            foreach ($map as $name => $val) {
                $curPrefix = $prefix . ':' . $name;
                // find
                if (is_bool($val) || is_null($val) || isset($val['elem'])) {
                    $acc[$curPrefix] = $val;
                } else {
                    $this->findParamsInMap($val, $acc, $curPrefix);
                }
            }
        }
    }

    private function replace($template, $replacement)
    {
        foreach ($replacement as $name => $value) {
            $template = str_replace("%$name%", $value, $template);
        }
        return $template;
    }

    private function getModeView()
    {
        $view = '<div class="btn-group" data-toggle="buttons">';
        $i = 0;
        foreach ($this->modes as $name => $args) {
            $view .= $this->replace($this->templates['mode'], [
                'ACTIVE' => ($i == 0) ? 'active':'',
                'NAME' => $name,
                'CHECKED' => ($i == 0) ? 'checked':'',
                'VALUE' => $name
            ]);
            $i++;
        }
        return $view . '</div> <span></span>';
    }

    public function getView()
    {
        $view = '<form id="myForm" action="POST"><div class="form-group">';
        $view .= $this->getSettingsPanelView();
        if ($this->modes) {
            $view .= $this->getModeView();
        }
        $view .= '<button type="submit" class="btn btn-default">Run</button></div>';

        foreach ($this->input as $key => $value) {
            // struct or array
            if (is_array($value)) {
                $view .= '<div class="bs-callout '. $this->structModes[$key] .'">';
                $view .= "<h4>$key</h4>";
                foreach ($value as $inputKey => $input) {
                    $view .= $input;
                }
                $view .= '</div>';
            } else {
                $view .= $value;
            }
        }
        return $view . '</form>';
    }

    public function getSettingsPanelView()
    {
        $view = '<div class="form-group"><div class="btn-group">';

        $view .= '<button type="button" class="btn btn-default" title="Upload as file">
        <span class="glyphicon glyphicon-upload" aria-hidden="true">
        </button>';
        $view .= '<button type="button" class="btn btn-default" title="Save state">
        <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
        </button>';

        return $view . '</div></div>';
    }
}
