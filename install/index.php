<?php
    define('INSTALL', true);

    $base = '../';

    include($base.'gear/bootstrap.php');

    theme::addCSS('https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css');
    theme::addCSS('https://cdn.jsdelivr.net/jquery.ui/1.11.4/jquery-ui.structure.min.css');
    theme::addCSS(url::assets('css/style.css'));

    theme::addJS('https://cdn.jsdelivr.net/jquery/3.1.1/jquery.min.js');
    theme::addJS('https://cdn.jsdelivr.net/jquery.ui/1.11.4/jquery-ui.min.js');
    theme::addJS('https://cdn.jsdelivr.net/lodash/4.17.1/lodash.min.js');
    theme::addJS('https://cdn.jsdelivr.net/vue/2.0.6/vue.min.js');
    theme::addJS(url::assets('js/form.js'));
    theme::addJS(url::assets('js/session.js'));
    theme::addJS(url::assets('js/sortable.js'));
    theme::addJS(url::assets('js/app.js'));
    theme::addJS(url::assets('js/layout.js'));

    ob_start();

    new application('install');

    $content = ob_get_contents();

    ob_end_clean();

    config::add('content', $content);

    if(ajax::is()) {

        ajax::messages();
        ajax::setMenu();

        echo ajax::getReturn();

        exit();

    }

    echo config::get('content');

?>
