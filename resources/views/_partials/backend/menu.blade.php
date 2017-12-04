<!-- Start: Sidebar Left Menu -->
<ul class="nav sidebar-menu no-print">
  <li class="sidebar-label pt20">Menu</li>
  <li class="active">
    <a href="{!! route('dashboard') !!}">
      <span class="glyphicon glyphicon-home"></span>
      <span class="sidebar-title">Dashboard</span>
    </a>
  </li>
  <li class="sidebar-label pt15">Administration</li>
  <li>
    <a href="{!! route('site_settings') !!}">
      <span class="fa fa-cog"></span>
      <span class="sidebar-title">Site Settings</span>
    </a>
  </li>
  <li>
    <a class="accordion-toggle" href="#">
      <span class="glyphicon glyphicon-user"></span>
      <span class="sidebar-title">User Management</span>
      <span class="caret"></span>
    </a>
    <ul class="nav sub-nav">
      <li>
        <a href="{!! route('gjadmin.users.index') !!}">
          <span class="glyphicon glyphicon-user"></span> Users </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.roles.index') !!}">
          <span class="glyphicon glyphicon-modal-window"></span> Roles </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.permission-categories.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Permission Categories </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.permissions.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Permission </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.subscribers.index') !!}">
          <span class="glyphicon glyphicon-users"></span> News Letter Subscribers </a>
      </li>
    </ul>
  </li>
  <li>
    <a class="accordion-toggle" href="#">
      <span class="glyphicon glyphicon-folder-open"></span>
      <span class="sidebar-title">Site Content</span>
      <span class="caret"></span>
    </a>
    <ul class="nav sub-nav">
      <li>
        <a href="{!! route('gjadmin.pages.index') !!}">
          <span class="glyphicon glyphicon-book"></span> CMS Pages </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.menus.index') !!}">
          <span class="glyphicon glyphicon-modal-window"></span> Menus </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.articles.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Articles </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.article-categories.index') !!}">
          <span class="glyphicon glyphicon-book"></span> Article Categories </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.brands.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Brands </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.news.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> News </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.faqs.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Faqs </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.faq-categories.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Faq Categories </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.competitions.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Competitions </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.quotes.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Quotes </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.slides.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Slides </a>
      </li>
    </ul>
  </li>

  <li>
    <a class="accordion-toggle" href="#">
      <span class="glyphicon glyphicon-shopping-cart"></span>
      <span class="sidebar-title">Shop</span>
      <span class="caret"></span>
    </a>
    <ul class="nav sub-nav">
      <li>
        <a href="{!! route('gjadmin.shop.getSettings') !!}">
          <span class="glyphicon glyphicon-book"></span> Shop Settings </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.shop.products.index') !!}">
          <span class="glyphicon glyphicon-modal-window"></span> Products </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.shop.productcategories.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Product Categories </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.shop.orders.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Orders </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.shop.orders.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Wholesale Orders </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.retailers.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Retailers </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.vouchers.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Loyalty Vouchers 
        </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.couriers.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Couriers 
        </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.postage-rates.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Postage Rates 
        </a>
      </li>
    </ul>
  </li>
  <li>
    <a class="accordion-toggle" href="#">
      <span class="fa fa-cogs"></span>
      <span class="sidebar-title">Options</span>
      <span class="caret"></span>
    </a>
    <ul class="nav sub-nav">
      <li>
        <a href="{!! route('gjadmin.email-templates.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Email Templates </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.tags.index') !!}">
          <span class="glyphicon glyphicon-modal-window"></span> Tags </a>
      </li>
      <li>
        <a href="{!! route('gjadmin.caches.index') !!}">
          <span class="glyphicon glyphicon-equalizer"></span> Caching </a>
      </li>
    </ul>
  </li>



  <!-- sidebar progress bars -->
  <li class="sidebar-label pt25 pb10">User Stats</li>
  <li class="sidebar-stat">
    <a href="#projectOne" class="fs11">
      <span class="fa fa-inbox text-info"></span>
      <span class="sidebar-title text-muted">Email Storage</span>
      <span class="pull-right mr20 text-muted">35%</span>
      <div class="progress progress-bar-xs mh20 mb10">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
          <span class="sr-only">35% Complete</span>
        </div>
      </div>
    </a>
  </li>
  <li class="sidebar-stat">
    <a href="#projectOne" class="fs11">
      <span class="fa fa-dropbox text-warning"></span>
      <span class="sidebar-title text-muted">Bandwidth</span>
      <span class="pull-right mr20 text-muted">58%</span>
      <div class="progress progress-bar-xs mh20">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 58%">
          <span class="sr-only">58% Complete</span>
        </div>
      </div>
    </a>
  </li>
</ul>
<!-- End: Sidebar Menu -->
           