<?php
	$url = $_ENV["PROTOCOL"].$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
<div class="navigation card">
    <a href="http://www.wavelinkllc.com"><img style="height:75px;" src="http://www.wavelinkllc.com/images/WaveLink_Logo.png" alt="Wave Link, LLC - High-Quality Mobile Apps, Websites, & Graphics" /></a>
    <h5 class="title is-5">Adminstration Panel</h5>
    <aside class="menu">
        <p class="menu-label">
            Account
        </p>
        <ul class="menu-list">
            <li><a id="link_admins" onclick="onNavigationClick('admins', this);">Admins</a></li>
            <li><a id="link_settings" onclick="onNavigationClick('settings', this);">Settings</a></li>
            <li><a id="link_seo" onclick="onNavigationClick('seo', this);">SEO</a></li>
            <li><a href="/admin/logout.php" style="color:#e74c3c;">Logout</a></li>
        </ul>
        <p class="menu-label">
            User Data
        </p>
        <ul class="menu-list">
            <li><a id="link_users" onclick="onNavigationClick('users', this);">Users</a></li>
            <li><a id="link_vendors" onclick="onNavigationClick('vendors', this);">Vendors</a></li>
        </ul>
        <p class="menu-label">
            Content
        </p>
        <ul class="menu-list">
        <li><a id="link_vendors" onclick="onNavigationClick('vendors/documents.php', this);">Vendor Documents</a></li>
        </ul>
    </aside>
</div>