UPDATE dyn_pages
SET html=""
WHERE view='home';

UPDATE dyn_pages
SET html="
<h2 style=\"text-align:left\">Welcome to CS Research Opportunities (ResOp)</h2>
<p>This website is an open posting of CS Research Opportunities 
for those in the Stanford community.  Faculty members may post projects
for pay or for credit, and students can apply for these positions.</p>
<p>Please login using your SUNet ID to learn more.</p>
<p class=\"b-red\" style=\"font-size:10px;\"> NOTE: this site is currently running as a beta.</p>"
WHERE view='landing';