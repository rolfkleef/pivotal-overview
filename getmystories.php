<?php
chdir(__DIR__);
require 'config.inc.php';
require 'PHP-Pivotal-Tracker-Class/pivotal.php';

// check that the backup directory exists, otherwise ignore
if (!is_dir($pivotal_backup_dir)) $pivotal_backup_dir = '';

$pivotal_completed = array('delivered', 'accepted', 'finished');

$pivotal = new pivotal;
$pivotal->token = $pivotal_token;

$projects = $pivotal->getProjects();

// save a backup copy
if ($pivotal_backup_dir != '') {
    $projects->asXML($pivotal_backup_dir . 'projects.xml');
}

echo '<div class="pivotal_status">';
echo $style;

if (isset($projects->project)) {
    foreach ($projects->project as $project) {
        $stories = $pivotal->getIterations($project->id);

        // save a backup copy
        if ($pivotal_backup_dir != '') {
            $stories->asXML($pivotal_backup_dir . $project->id . '.xml');
        }

        $o_stories = '';
        $o_iteration_title = '';
        $o_iteration_end = '';

        if (isset($stories)
        && isset($stories->iteration)
        && isset($project->current_iteration_number)) {
            foreach($stories->iteration as $iteration) {
                if ((int) $project->current_iteration_number == (int) $iteration->id) {
                    foreach ($iteration->stories->story as $story) {

                        if (($show_notowned) || ($story->owned_by == $pivotal_user)) {
                            if (!in_array($story->current_state, $pivotal_completed)) {
                                $d = '';
                                if ($show_descriptions && strlen($story->description)>0) {
                                    $d = $story->description;
                                }

                                $t = '';
                                if ($show_tasks && isset($story->tasks)) {
                                    foreach ($story->tasks->task as $task) {
                                        if ($task->complete != 'true') $t .= "\n- " . $task->description;
                                    }
                                    if ($t!='') $t = "\n$t";
                                }

                                $l = '';
                                if ($show_labels && isset($story->labels)) {
                                    $l = "\n\n" . $story->labels;
                                }

                                $o = '';
                                $o_class = '';
                                if ($story->owned_by != $pivotal_user) {
                                    if ($story->owned_by != '') {
                                        $o = ' (' . $story->owned_by . ')';
                                    }
                                    $o_class = ' not_owned';
                                }

                                $alt = '';
                                if ($d.$t.$l != '') {
                                    $alt = "title=\"" . htmlentities($d.$t.$l) . "\"";
                                }

                                $o_stories .= "<li $alt class='{$story->current_state}{$o_class}'>" .
                                    "<a href='{$story->url}' target='_blank'>{$story->name}{$o}</a></li>\n";
                            }
                        }
                    }
                    if ($o_stories != '') $o_stories = "<ul>$o_stories</ul>\n";

                    $o_iteration_title = "title=\"Iteration {$iteration->id}: " . htmlentities(
                        date($date_format, strtotime($iteration->start)) . " - " .
                        date($date_format, strtotime($iteration->finish))) . "\"";
                    $o_iteration_end = "<span class='iteration_end'>" .
                        date($date_format, strtotime($iteration->finish)) . "</span>";
                }
            }
        }

        if ($show_emptyproject || $o_stories != '') {
            $icon = '';
            if ($with_icons) {
                $pid = (int) $project->id;
                if (isset($icons)
                && isset($icons[$pid])) {
                    $iconfile = $icons[$pid];
                } else {
                    $iconfile = $default_icon;
                }
                $icon = "<img src=\"{$iconfile}\"> ";
            }
            echo "<p $o_iteration_title>" . $icon .
                "<a href='https://www.pivotaltracker.com/projects/{$project->id}' target='_blank'>" .
                "<span class='project'>{$project->name}</span></a>{$o_iteration_end}</p>\n" .
                $o_stories;
        }
    }
}

echo '</div>';

?>
