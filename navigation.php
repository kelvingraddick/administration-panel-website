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
            <li><a href="/setupshopz/admin/logout.php" style="color:#e74c3c;">Logout</a></li>
        </ul>
        <p class="menu-label">
            User Data
        </p>
        <ul class="menu-list">
            <li><a id="link_members" onclick="onNavigationClick('members', this);">Members</a></li>
            <li><a id="link_contacts" onclick="onNavigationClick('contacts', this);">Contacts</a></li>
            <!--<li><a id="link_posts" nclick="onNavigationClick('posts', this);">Posts</a></li>-->
            <!--<li><a id="link_orders" onclick="onNavigationClick('orders', this);">Orders</a></li>-->
            <!--<li><a id="link_appointments" onclick="onNavigationClick('appointments', this);">Appointments</a></li>-->
            <!--<li><a id="link_contracts" onclick="onNavigationClick('contracts', this);">Contracts</a></li>-->
        </ul>
        <p class="menu-label">
            Content
        </p>
        <ul class="menu-list">
            <li><a id="link_blog_posts" onclick="onNavigationClick('blog_posts', this);">Blog Posts</a></li>
            <li><a id="link_events" onclick="onNavigationClick('events', this);">Events</a></li>
            <li><a id="link_photo_albums" onclick="onNavigationClick('photo_albums', this);">Photo Albums</a></li>
            <!--<li><a id="link_products" onclick="onNavigationClick('products', this);">Products</a></li>-->
            <!--<li><a id="link_newsletters" onclick="onNavigationClick('newsletters', this);">Newsletters</a></li>-->
            <!--<li><a id="link_employees" onclick="onNavigationClick('employees', this);">Employees</a></li>-->
        </ul>
    </aside>
</div>