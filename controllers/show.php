<?php
class ShowController extends StudipController {

    public function __construct($dispatcher)
    {
        parent::__construct($dispatcher);
        $this->plugin = $dispatcher->plugin;
    }

    public function index_action()
    {
        Navigation::activateItem('course/forum2/likes');

        $stmt = DBManager::get()->prepare("SELECT * FROM forum_likes
            LEFT JOIN forum_entries USING (topic_id)
            WHERE forum_likes.user_id = ?
                AND forum_entries.seminar_id = ?
            ORDER BY forum_entries.user_id");

        $stmt->execute(array($GLOBALS['user']->id, Request::get('cid')));

        $this->entries = $stmt->fetchAll();

        $stmt = DBManager::get()->prepare("SELECT *, COUNT(*) as ges FROM forum_likes
            LEFT JOIN forum_entries USING (topic_id)
            WHERE forum_likes.user_id = ?
                AND forum_entries.seminar_id = ?
            GROUP BY forum_entries.user_id");

        $stmt->execute(array($GLOBALS['user']->id, Request::get('cid')));

        $this->overview = $stmt->fetchAll();
    }

    // customized #url_for for plugins
    function url_for($to = '')
    {
        $args = func_get_args();

        # find params
        $params = array();
        if (is_array(end($args))) {
            $params = array_pop($args);
        }

        # urlencode all but the first argument
        $args = array_map('urlencode', $args);
        $args[0] = $to;

        return PluginEngine::getURL($this->dispatcher->plugin, $params, join('/', $args));
    }
}
