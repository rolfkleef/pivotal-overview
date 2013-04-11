<?php
/* Your Pivotal API token */
$pivotal_token = '1234567890abcdef01234567890abcde';

/* Your name as known in Pivotal
   Used to identify tasks owned by you.
 */
$pivotal_user = 'Your Name';

/* Backup directory for Pivotal stories as XML
   (if set, will store the XML data from Pivotal to
   include in your own backups) -- must include trailing slash
 */
$pivotal_backup_dir = '';

/*
 * Include the story description
 */
$show_descriptions = true;

/*
 * Include open tasks in the story
*/
$show_tasks = true;

/*
 * Include projects without stories to report
*/
$show_emptyproject = true;

/*
 * Include tasks not owned by me
*/
$show_notowned = true;

/*
 * Styling
 */
$style = <<<STYLE
<STYLE type="text/css">
.pivotal_status .project {text-weight: bold}
.pivotal_status .iteration_end {float:right; color:#979797}
.pivotal_status .started {background-color: #F3F3D1}
.pivotal_status .delivered {background-color: #DAEBCF}
.pivotal_status .not_owned a {color: #888; font-style: italic}
</STYLE>
STYLE;

/*
 * Date format; used by PHP date()
 */
$date_format = 'D j M';

/*
 * Icons to use for a project: use the Pivotal project id as index,
 * to specify the location of an icon image
 */
$with_icons = false;
$default_icon = 'pivotal.png';
$icons[123456] = 'projectlogo.png';
?>
