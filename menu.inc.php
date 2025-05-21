<?php

function draw_headerhtml($title) {
    head($title);
    menu($title);
}

function draw_footerhtml() {
    echo "
    <footer>
    <p>&copy; 2025 CLAM Careers. Made with code and ambition. Powered by purpose.</p>
    </footer>
  ";
}
function head($title) {
    echo "
    <head>

    <meta charset=\"UTF-8\">
    <meta name=\"description\" content=\"COS10032 Computing Systems Project\">
    <meta name=\"keywords\" content=\"Computing Systems, Swinburne\">
    <meta name=\"author\" content=\"Mathew Calf\">
    <title>CLAM - $title</title>

    <link href=\"styles/style.css\" rel=\"stylesheet\">
    </head>
    ";
}



function menu($title) {
echo "
<header>
    <a href=\"index.php\">
        <img src=\"images/logo.png\" alt=\"CLAM Logo\" width=\"100\"> </a>
    <h1>$title</h1>
    <nav>
    <ul>
        <li> <a href=\"index.php\">Home</a>   </li>
            <li> <a href=\"jobs.php\">Jobs</a> </li>
                <li> <a href=\"apply.php\">Apply</a> </li>
                    <li> <a href=\"about.php\">About</a></li>
                        <li>  <a href=\"enhancements.php\">Enhancements</a></li>
                            <li> <a href=\"mailto:105907067@student.swin.edu.au\">Contact Us</a></li>
    </ul>
    </nav>
</header>
";
};



?>