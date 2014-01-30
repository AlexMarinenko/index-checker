# Index Checker
---

Gets the indexed pages from external search engines and stores the data.
The checker consists of two parts:

* checker.php console script retrieves information and stores it.
* graph.php web application that displays gathered statistics.

# Installation
---
<pre>git clone git@github.com:asmsoft/index-checker.git</pre>
Copy config file etc/checker.ini.dist to etc/checker.ini and edit it.
<pre>cp etc/checker.ini.dist etc/checker.ini</pre>
Add virtual host to your webserver pointing to your checker working copy folder.
Apache virtual host example:
<pre>
&lt;VirtualHost *:80&gt;
    DocumentRoot "/Path/To/Checker"
    ServerName your-virtual-host.net
    &lt;Directory "/Path/To/Checker"&gt;
        Options Indexes FollowSymlinks
        AllowOverride None
        Order allow,deny
        Allow from all
    &lt;/Directory&gt;
    ErrorLog "/Path/To/Checker/logs/error_log"
    CustomLog "/Path/To/Checker/logs/access_log" common
&lt;/VirtualHost&gt;
</pre>


# Usage
---

##Checker
---

Use the following command to start the checker:

<pre>php checker.php [file]</pre>

<pre> [file] - path to the input file that contains domains. All domains should be placed new line each.</pre>

##Graph
---
Just point your web browser at http://your-virtual-host.net/graph.php