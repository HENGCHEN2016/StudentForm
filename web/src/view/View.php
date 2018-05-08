<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 10:25 AM
 */

namespace studentform\view;

use studentform\exception\ConfirmException;

class View
{
    /**
     * @var string path to template being rendered
     */
    protected $template = null;

    /**
     * @var array data to be made available to the template
     */
    protected $data = array();

    public function __construct($template)
    {
        try {
            $file = APP_ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'webpage' . DIRECTORY_SEPARATOR . $template . '.phtml';

            if (file_exists($file)) {
                $this->template = $file;
            } else {
                throw new ConfirmException('Webpage ' . $template . ' not found!');
            }
        } catch (ConfirmExceptionException $ex) {
            echo $ex->getErrorMessage();
        }
    }

    /**
     * Adds a key/value pair to be available to phtml template
     *
     * @param string $key name of the data to be available
     * @param array $val value of the data to be available
     *
     * @return $this View
     */
    public function addData($key, $val)
    {
        $this->data[$key] = $val;
        return $this;
    }

    /**
     * Render the template, returning it's content.
     *
     * @return string The rendered template.
     */
    public function render()
    {
        extract($this->data);

        ob_start();
        include($this->template);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}