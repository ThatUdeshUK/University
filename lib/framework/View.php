<?php

namespace framework;

class View
{
    public $data = []; // for passing "non-persistent" data

    public function load($view)
    {
        // sanitize data
        if (!empty($this->data)) {
            //extract(array_map(array('self', 'sanitize'), $this->data));
            $this->data = array_map(['self', 'sanitize'], $this->data);
        }

        // if not defined, set title based on view
        if (!isset($this->data['page_title'])) {
            $this->data['page_title'] = ucwords(str_replace(['_', '/'], ' ', $view));
        }
        $this->data['page_title'] .= ' | ' . SITE_TITLE;

        // output the page
        require('views/header.php');
        require("views/$view.php");
        require('views/footer.php');
        unset($view);

        // dump all vars for development
        if (DEVELOPMENT) {
            echo '<pre>';
            echo '<h3>explicit variables:</h3>';
            print_r(get_defined_vars());
            echo '<h3>view data:</h3>';
            var_dump($this->data);
            echo '<h3>session:</h3>';
            var_dump($_SESSION);
            echo '</pre>';
        }

        // end script execution time (starts in bootstrap)
        echo '<!-- ' . (microtime(TRUE) - EXE_TIME_START) . ' -->';
        exit;
    }

    // sanitize output
    public function sanitize($output)
    {
        if (is_array($output)) {
            return array_map(['self', 'sanitize'], $output);
        }
        if (get_magic_quotes_gpc()) {
            $output = stripslashes($output);
        }

        return htmlentities($output, ENT_QUOTES, 'UTF-8');
    }
}
