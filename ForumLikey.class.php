<?php
require 'bootstrap.php';

/**
 * @author  Till Glöggler <tgloeggl@uos.de>
 * @version 0.2
 */

class ForumLikey extends StudIPPlugin implements StandardPlugin
{

    public function __construct()
    {
        parent::__construct();

        if (Navigation::hasItem('/course/forum2')) {
            $nav = new Navigation(_('Beiträge, die mir gefallen'), PluginEngine::getURL($this, array(), 'show'));
            Navigation::addItem('/course/forum2/likes', $nav);
        }
    }

    public function initialize () {

    }

    public function getTabNavigation($course_id) {
        return array();
    }

    public function getNotificationObjects($course_id, $since, $user_id) {
        return array();
    }

    public function getIconNavigation($course_id, $last_visit, $user_id) {
        // ...
    }

    public function getInfoTemplate($course_id) {
        // ...
    }

    public function perform($unconsumed_path)
    {
        $dispatcher = new Trails_Dispatcher(
            $this->getPluginPath(),
            rtrim(PluginEngine::getLink($this, array(), null), '/'),
            'show'
        );
        $dispatcher->plugin = $this;
        $dispatcher->dispatch($unconsumed_path);
    }
}
