<?php
/**
 * The default template for the "roof"
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<ul class="menu simple roof-menu align-right">
	<li class="roof-padding"><a href="https://www.jhu.edu/admissions/visit/" target="_blank" rel="noopener">Visit</a></li>
	<li class="bar"></li>
	<li class="roof-padding"><a href="https://magazine.krieger.jhu.edu/" target="_blank" rel="noopener">A&S Magazine</a></li>
	<li><a class="button" href="#" aria-label="Explore JHU" data-toggle="offCanvasTop1">Explore JHU <span class="fa-solid fa-bars" aria-hidden="true"></span></a></li>
</ul>

<div class="off-canvas position-top" id="offCanvasTop1" data-off-canvas>
	<div id="global-links" class="grid-x grid-padding-x small-up-2 medium-up-3 large-up-3">
	<h1 class="show-for-sr">Explore JHU</h1>
		<div class="cell">
			<h2>Inside the Krieger School</h2>
			<ul class="vertical menu" role="menu">
				<li role="menuitem"><a href="https://krieger.jhu.edu/academics/departments-programs-and-centers/" onclick="ga('send', 'event', 'Offcanvas', 'Academics', 'Departments')">Departments, Programs, and Centers</a></li>
				<li role="menuitem"><a href="https://krieger.jhu.edu/people/faculty-directory/" onclick="ga('send', 'event', 'Offcanvas', 'Academics', 'Faculty')">Faculty Directory</a></li>
				<li role="menuitem"><a href="https://krieger.jhu.edu/academics/fields/" onclick="ga('send', 'event', 'Offcanvas', 'Academics', 'Fields of Study')">Fields of Study</a></li>
				<li role="menuitem"><a href="https://krieger.jhu.edu/academics/majors-minors/" onclick="ga('send', 'event', 'Offcanvas', 'Academics', 'Majors & Minors')">Majors & Minors</a></li>
			</ul>
		</div>
		<div class="cell">
			<h2>Student & Faculty Resources</h2>
			<ul class="vertical menu" role="menu">
				<li role="menuitem"><a href="https://e-catalogue.jhu.edu/" onclick="ga('send', 'event', 'Offcanvas', 'Resources', 'Academic Catalog')">Academic Catalog</a></li>
				<li role="menuitem"><a href="https://livejohnshopkins.sharepoint.com/sites/KSASFacultyHandbook" onclick="ga('send', 'event', 'Offcanvas', 'Resources', 'Faculty Handbook')">Faculty Handbook <span class="fa-solid fa-right-to-bracket"></span></a></li>
				<li role="menuitem"><a href="https://studentaffairs.jhu.edu/registrar/" onclick="ga('send', 'event', 'Offcanvas', 'Resources', 'Registrars')">Registrar's Office</a></li>
				<li role="menuitem"><a href="https://policies.jhu.edu/" onclick="ga('send', 'event', 'Offcanvas', 'Resources', 'Policy Library')">University Policies & Document Library <span class="fa-solid fa-right-to-bracket"></span></a></li>
			</ul>
		</div>
		<div class="cell">
			<h2>Across Campus</h2>
			<ul class="vertical menu" role="menu">
				<li role="menuitem"><a href="https://www.jhu.edu/admissions/" onclick="ga('send', 'event', 'Offcanvas', 'Campus', 'Admissions')">Admissions & Aid</a></li>
				<li role="menuitem"><a href="https://www.jhu.edu/" onclick="ga('send', 'event', 'Offcanvas', 'Campus', 'JHU Home')">Johns Hopkins University Website</a></li>
				<li role="menuitem"><a href="https://www.jhu.edu/maps-directions/" onclick="ga('send', 'event', 'Offcanvas', 'Campus', 'Maps/Directions')">Maps & Directions</a></li>
				<li role="menuitem"><a href="https://my.jh.edu/myJH/" onclick="ga('send', 'event', 'Offcanvas', 'Campus', 'myJHU')">myJHU</a></li>
			</ul>
		</div>
		<button class="close-button" aria-label="Close menu" type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>
