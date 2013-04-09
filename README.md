Pivotal Tracker stories overview and backup
===========================================

Checks all your projects in Pivotal Tracker and generates an overview of
unfinished stories in the current iteration of each project.

The overview is a simple HTML list which can be included in e.g. a dashboard page.

- Hovering over a project name reveals the current iteration dates
- The background is yellow-ish if the story is started.
- If there is a description or there are unfinished tasks, these
  are available by hovering over the task text. (Tasks are listed 
  with leading "- ")
- Stories not owned by me are in italics.
- Projects and Stories have links to Pivotal Tracker.

**Bonus:** The script can also store a local copy of the XML it receives from Pivotal 
Tracker, so you have a local backup of your data.

**Installation**

- Download or clone the code into some directory.

- Copy `config-sample.inc.php` to `config.inc.php`, and adapt it to specify
  your API key and your name (as known in Pivotal).
  
- If you set `$pivotal_backup_dir` to an existing directory, the script
  will store the retrieved XML results there.
  
- You can tweak what will be shown and the styling for it.

- Use for instance cron to regularly update the status output file:

<code>
*/10 * * * * /usr/bin/php <path>/getmystories.php > /var/www/tmp/pivotalstories.html
</code>

- Include the output in a web page, widget, dashboard.

**Thanks**

The script includes codazoda's API wrapper [PHP Pivotal Tracker Class](https://github.com/codazoda/PHP-Pivotal-Tracker-Class.git)

**License**

See the PHP Pivotal Tracker Class directory for its own (open source) license.

This script is available under AGPL: http://www.gnu.org/licenses/agpl.html

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.
 
You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

